<?php
/**
 * disconuevo.php - Formulario para agregar un disco
 * 
 * ¿Qué hace?
 * 1. Muestra un formulario
 * 2. Si envían el formulario, crea el disco
 */

require_once 'Album.php';

// Crear objeto
$album = new Album();
$msg = '';

// ¿Se envió el formulario? (¿hay datos en $_POST?)
if ($_POST) {
    // $_POST contiene: ['titulo'=>'...', 'discografica'=>'...', etc]
    
    // Llamar al método crear() pasándole todos los datos del formulario
    if ($album->crear($_POST)) {
        $msg = "Disco '{$_POST['titulo']}' agregado";
    }
}
?>

<h1>Agregar disco</h1>

<!-- Si hay mensaje, mostrarlo -->
<?php if ($msg) echo "<p>$msg</p>"; ?>

<!-- Formulario - Al enviarlo, recargará esta página con method="post" -->
<form method="post">
    <!-- Los "name" deben coincidir con los nombres de la clase Album -->
    <input name="titulo" placeholder="Título" required><br>
    <input name="discografica" placeholder="Discográfica" required><br>
    
    <!-- Los valores del select son los que se guardarán en la BD -->
    <select name="formato">
        <option>vinilo</option>
        <option>cd</option>
        <option>dvd</option>
        <option>mp3</option>
    </select><br>
    
    <input type="date" name="fechaLanzamiento"><br>
    <input type="date" name="fechaCompra"><br>
    <input type="number" step="0.01" name="precio" placeholder="Precio"><br>
    
    <button>Agregar</button>
</form>

<p><a href="index.php">Volver</a></p>