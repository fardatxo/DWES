<?php
/**
 * disco.php - Ver las canciones de un álbum
 * 
 * ¿Qué hace?
 * - Recibe el código del álbum por la URL: disco.php?codigo=5
 * - Muestra el título del álbum
 * - Lista todas sus canciones
 */

require_once 'Album.php';
require_once 'Cancion.php';

// Obtener código de la URL. Si no existe, terminar con mensaje
// $_GET['codigo'] viene de: disco.php?codigo=5
// ?? = "operador de fusión de null": si no existe, usar el valor de la derecha
$codigo = $_GET['codigo'] ?? exit('Falta código');

// Crear objetos
$album = new Album();
$cancion = new Cancion();

// Obtener el título del álbum
// Si no existe (devuelve null), terminar con mensaje
$titulo = $album->obtenerTitulo($codigo) ?? exit('Álbum no encontrado');

// Obtener todas las canciones de este álbum
// $canciones = [ ['titulo'=>'Come Together', 'duracion'=>'...'], ... ]
$canciones = $cancion->obtenerPorAlbum($codigo);
?>

<h1>CANCIONES de <?= $titulo ?></h1>

<!-- Lista de canciones -->
<ul>
<?php foreach ($canciones as $c): ?>
    <!-- $c = ['titulo'=>'Come Together', 'duracion'=>'00:04:20', 'genero'=>'Rock'] -->
    <li>
        <?= $c['titulo'] ?> - <?= $c['duracion'] ?> (<?= $c['genero'] ?>)
    </li>
<?php endforeach; ?>
</ul>

<!-- Enlaces para añadir o borrar -->
<p><a href="cancionnueva.php?codigo=<?= $codigo ?>">Añadir canción</a></p>
<p><a href="borrardisco.php?codigo=<?= $codigo ?>">Borrar álbum</a></p>
<p><a href="index.php">VOLVER</a></p>