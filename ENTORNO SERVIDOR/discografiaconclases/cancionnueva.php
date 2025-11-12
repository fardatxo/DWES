<?php
/**
 * cancionnueva.php - Formulario para agregar una canción
 * 
 * ¿Qué hace?
 * - Recibe el código del álbum: cancionnueva.php?codigo=5
 * - Muestra formulario para agregar canción
 * - Al enviar, inserta la canción en ese álbum
 */

require_once 'Album.php';
require_once 'Cancion.php';

// Obtener código del álbum de la URL
$codigo = $_GET['codigo'] ?? exit('Falta código');

$album = new Album();
$cancion = new Cancion();

// Obtener título del álbum para mostrarlo
$titulo = $album->obtenerTitulo($codigo) ?? exit('Álbum no encontrado');
$msg = '';

// Si enviaron el formulario
if ($_POST) {
    // Añadir el código del álbum a los datos del formulario
    // $_POST ahora tendrá: ['titulo'=>'...', 'posicion'=>..., 'album'=>5]
    $_POST['album'] = $codigo;
    
    // Crear la canción
    if ($cancion->crear($_POST)) {
        $msg = "Canción '{$_POST['titulo']}' agregada";
    }
}
?>

<h1>Agregar canción a <?= $titulo ?></h1>

<?php if ($msg) echo "<p>$msg</p>"; ?>

<form method="post">
    <!-- name="titulo" porque así lo espera el método crear() -->
    <input name="titulo" placeholder="Título" required><br>
    <input type="number" name="posicion" placeholder="Posición"><br>
    
    <!-- type="time" muestra un selector de hora (00:04:20) -->
    <!-- step="1" permite seleccionar segundos -->
    <input type="time" name="duracion" step="1"><br>
    
    <select name="genero">
        <option>Pop</option>
        <option>Rock</option>
        <option>Jazz</option>
    </select><br>
    
    <button>Agregar</button>
</form>

<p><a href="disco.php?codigo=<?= $codigo ?>">Volver</a></p>