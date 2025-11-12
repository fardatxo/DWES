<?php
require_once 'Album.php';

// Obtener código del álbum de la URL: editarprecio.php?codigo=5
$codigo = $_GET['codigo'] ?? exit('Falta código');

$album = new Album();

// Obtener título del álbum para mostrarlo
$titulo = $album->obtenerTitulo($codigo);
$msg = '';

// Si enviaron el formulario
if ($_POST) {
    if ($album->actualizarPrecio($codigo, $_POST['precio'])) {
        
    $msg = "Precio actualizado";
}
}
?>

<h1>Editar precio de <?= $titulo ?></h1>

<?php if ($msg) echo "<p>$msg</p>"; ?>

<form method="post">
    <input type="number" step="0.01" name="precio" placeholder="Nuevo precio" required>
    <button>Actualizar</button>
</form>

<p><a href="index.php">Volver</a></p>