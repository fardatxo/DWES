<?php
/**
 * index.php - Página principal
 * 
 * ¿Qué hace?
 * - Muestra todos los álbumes
 * - Enlaces para ver, añadir y borrar
 */

// 1. Incluir la clase Album
require_once 'Album.php';

// 2. Crear un objeto de la clase Album
$album = new Album();

// 3. Llamar al método obtenerTodos() para traer todos los discos
// $albumes será un array: [ ['codigo'=>1, 'titulo'=>'...'], ['codigo'=>2, ...], ... ]
$albumes = $album->obtenerTodos();
?>

<h1>DISCOGRAFÍA</h1>

<!-- Mostrar mensaje si viene en la URL: index.php?msg=Disco eliminado -->
<?php if (isset($_GET['msg'])): ?>
    <p style="color: green;"><?= $_GET['msg'] ?></p>
<?php endif; ?>

<!-- Enlace para agregar nuevo disco -->
<p><a href="disconuevo.php">Agregar nuevo disco</a></p>

<!-- Lista de álbumes -->
<ul>
<?php foreach ($albumes as $disco): ?>
    <!-- $disco = ['codigo'=>1, 'titulo'=>'Abbey Road'] -->
    <li>
        <?= $disco['titulo'] ?> - 
        <a href="disco.php?codigo=<?= $disco['codigo'] ?>">Ver canciones</a> | 
        <a href="cancionnueva.php?codigo=<?= $disco['codigo'] ?>">Añadir canción</a> | 
        <a href="borrardisco.php?codigo=<?= $disco['codigo'] ?>">Borrar</a>
        <a href="editarprecio.php?codigo=<?= $disco['codigo'] ?>">Editar precio</a>
    </li>
<?php endforeach; ?>
</ul>

<!-- Enlace al buscador -->
<p><a href="canciones.php">Buscar canciones</a></p>