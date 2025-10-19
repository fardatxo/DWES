<?php
// Crear conexión a la base de datos 'discografia' usando PDO
// host=localhost → servidor local
// dbname=discografia → nombre de la base de datos
// charset=utf8 → codificación de caracteres UTF-8
// 'discografia', 'discografia' → usuario y contraseña de la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8','discografia','discografia');

// Comprobar si el formulario fue enviado (método POST)
if ($_POST) {
    // Guardar los datos del formulario
    // El texto se envuelve con % para usarlo en la búsqueda con LIKE
    $texto = "%{$_POST['texto']}%";
    // Campo de búsqueda: título, álbum o ambos
    $campo = $_POST['campo'] ?? 'ambos';
    // Género musical seleccionado (puede estar vacío)
    $genero = $_POST['genero'] ?? '';

    // Crear la consulta base que une las tablas 'cancion' y 'album'
    $sql = "SELECT c.titulo AS cancion, a.titulo AS album, c.genero
            FROM cancion c JOIN album a ON c.album = a.codigo WHERE 1";

    // Array donde se almacenarán los valores para sustituir los ? de la consulta
    $params = [];

    // Añadir condición según el campo de búsqueda elegido
    if ($campo == 'titulo') {
        // Buscar solo en el título de las canciones
        $sql .= " AND c.titulo LIKE ?";
        $params = [$texto];
    } elseif ($campo == 'album') {
        // Buscar solo en el nombre del álbum
        $sql .= " AND a.titulo LIKE ?";
        $params = [$texto];
    } else {
        // Buscar tanto en títulos de canción como en nombres de álbum
        $sql .= " AND (c.titulo LIKE ? OR a.titulo LIKE ?)";
        $params = [$texto, $texto];
    }

    // Si el usuario seleccionó un género específico, se añade a la condición
    if ($genero) {
        $sql .= " AND c.genero = ?";
        $params[] = $genero;
    }

    // Preparar la consulta SQL (previene inyección SQL)
    $stmt = $pdo->prepare($sql);
    // Ejecutar la consulta pasando los parámetros almacenados en $params
    $stmt->execute($params);
    // Obtener los resultados en un array asociativo
    $res = $stmt->fetchAll();
}
?>

<!-- Título principal de la página -->
<h1>Buscar canciones</h1>

<!-- Formulario que envía los datos a esta misma página -->
<form method="post">
    <!-- Campo de texto para escribir lo que se desea buscar -->
    Texto: <input name="texto">

    <!-- Opciones para definir en qué campo buscar -->
    <br>Buscar en:
    <input type="radio" name="campo" value="titulo" checked> Canción
    <input type="radio" name="campo" value="album"> Álbum
    <input type="radio" name="campo" value="ambos"> Ambos

    <!-- Menú desplegable para filtrar por género musical -->
    <br>Género:
    <select name="genero">
        <option value="">Todos</option>
        <option>Pop</option>
        <option>Rock</option>
        <option>Jazz</option>
    </select>

    <!-- Botón para ejecutar la búsqueda -->
    <button>Buscar</button>
</form>

<!-- Mostrar resultados solo si la variable $res contiene datos -->
<?php if (!empty($res)): ?>
    <!-- Lista con las canciones encontradas -->
    <ul>
    <?php foreach($res as $r): ?>
        <!-- Mostrar título de canción, álbum y género -->
        <li><?= htmlspecialchars($r['cancion']) ?> — <?= htmlspecialchars($r['album']) ?> (<?= htmlspecialchars($r['genero']) ?>)</li>
    <?php endforeach; ?>
    </ul>

<!-- Si se ha enviado el formulario pero no hay resultados -->
<?php elseif($_POST): ?>
    <p>No se encontraron canciones.</p>
<?php endif; ?>

<!-- Enlace para volver a la página principal de la discografía -->
<p><a href="index.php">Volver</a></p>
