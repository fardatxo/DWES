<?php
// Crear conexión PDO a la base de datos 'discografia'
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8','discografia','discografia');
// Obtener el código del álbum desde la URL. Si no existe, terminar el script con un mensaje de error
$codigo = $_GET['codigo'] ?? exit('Falta el código');
// Preparar una consulta para obtener el título del álbum con el código proporcionado
$album = $pdo->prepare("SELECT titulo FROM album WHERE codigo=?");
// Ejecutar la consulta pasando el código como parámetro (protege contra SQL Injection)
$album->execute([$codigo]);
// Obtener el título del álbum. Si no se encuentra, terminar el script con un mensaje de error
$titulo = $album->fetch(PDO::FETCH_ASSOC)['titulo'] ?? exit('Álbum no encontrado');
// Inicializar mensaje vacío que se mostrará después de agregar la canción
$msg = '';
// Comprobar si el formulario se ha enviado mediante POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    // Preparar e insertar la nueva canción en la tabla 'cancion'
    $pdo->prepare("INSERT INTO cancion (titulo, album, posicion, duracion, genero) VALUES (?,?,?,?,?)")
        ->execute([
            $_POST['tituloCancion'], // Título de la canción
            $codigo,                 // Código del álbum al que pertenece
            $_POST['posicion'],      // Posición de la canción en el álbum
            $_POST['duracion'],      // Duración de la canción
            $_POST['genero']         // Género musical
        ]);

    // Guardar mensaje de confirmación
    $msg = "Canción '{$_POST['tituloCancion']}' agregada";
}
?>
<!-- Mostrar título principal con el nombre del álbum -->
<h1>Agregar canción a <?php echo htmlspecialchars($titulo); ?></h1>
<!-- Mostrar mensaje de confirmación si existe -->
<?php if($msg) echo "<p>$msg</p>"; ?>
<!-- Formulario para agregar nueva canción -->
<form method="post">
    <!-- Campo para el título de la canción (obligatorio) -->
    <input name="tituloCancion" placeholder="Título" required>
    <!-- Posición de la canción en el álbum -->
    <input type="number" name="posicion" placeholder="Posición">
    <!-- Duración de la canción en formato de tiempo -->
    <input type="time" name="duracion" step="1">
    <!-- Selección del género de la canción -->
    <select name="genero">
        <option>Acustica</option><option>BSO</option><option>Blues</option>
        <option>Folk</option><option>Jazz</option><option>New age</option>
        <option>Pop</option><option>Rock</option><option>Electronica</option>
    </select>
    <!-- Botón para enviar el formulario -->
    <button type="submit">Agregar</button>
</form>
<!-- Enlace para volver a la página del álbum -->
<p><a href="disco.php?codigo=<?php echo $codigo; ?>">Volver</a></p>
