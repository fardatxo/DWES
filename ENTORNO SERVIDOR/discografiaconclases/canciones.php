<?php
/**
 * canciones.php - Buscador de canciones
 * 
 * ¿Qué hace?
 * - Muestra un formulario de búsqueda
 * - Permite buscar por título, álbum o ambos
 * - Permite filtrar por género
 * - Muestra los resultados
 */

require_once 'Cancion.php';

$cancion = new Cancion();
$res = [];  // Array vacío para guardar resultados

// Si enviaron el formulario (hay datos en $_POST)
if ($_POST) {
    // Obtener datos del formulario
    $texto = $_POST['texto'];                    // Lo que escribió el usuario
    $campo = $_POST['campo'] ?? 'ambos';         // Dónde buscar
    $genero = $_POST['genero'] ?? '';            // Género (puede estar vacío)
    
    // Llamar al método buscar() con los 3 parámetros
    $res = $cancion->buscar($texto, $campo, $genero);
    // $res = [ ['cancion'=>'Come Together', 'album'=>'Abbey Road', 'genero'=>'Rock'], ... ]
}
?>

<h1>Buscar canciones</h1>

<form method="post">
    <!-- Campo de texto para escribir lo que buscar -->
    Texto: <input name="texto"><br>
    
    <!-- Radio buttons para elegir dónde buscar -->
    <!-- Solo se puede seleccionar UNO porque tienen el mismo "name" -->
    Buscar en:
    <input type="radio" name="campo" value="titulo" checked> Canción
    <input type="radio" name="campo" value="album"> Álbum
    <input type="radio" name="campo" value="ambos"> Ambos<br>
    
    <!-- Select para elegir género -->
    <!-- value="" = vacío = todos los géneros -->
    Género:
    <select name="genero">
        <option value="">Todos</option>
        <option>Pop</option>
        <option>Rock</option>
        <option>Jazz</option>
    </select><br>
    
    <button>Buscar</button>
</form>

<!-- MOSTRAR RESULTADOS -->

<!-- Si hay resultados (el array NO está vacío) -->
<?php if (!empty($res)): ?>
    <ul>
    <?php foreach($res as $r): ?>
        <!-- $r = ['cancion'=>'Come Together', 'album'=>'Abbey Road', 'genero'=>'Rock'] -->
        <li><?= $r['cancion'] ?> — <?= $r['album'] ?> (<?= $r['genero'] ?>)</li>
    <?php endforeach; ?>
    </ul>

<!-- Si NO hay resultados PERO sí enviaron el formulario -->
<?php elseif($_POST): ?>
    <p>No se encontraron canciones.</p>
<?php endif; ?>

<p><a href="index.php">Volver</a></p>