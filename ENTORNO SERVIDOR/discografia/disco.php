<?php
// Crear conexión PDO a la base de datos 'discografia'
$conexion = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');
// Obtener el código del álbum desde la URL mediante GET
$album = $_GET['codigo'];
// Preparar la consulta para obtener los títulos de las canciones de ese álbum
// Idealmente, se debería usar un marcador de posición con prepare() y execute().
$consulta = $conexion->prepare("SELECT titulo FROM cancion WHERE album = '$album'");
// Ejecutar la consulta
$consulta->execute();
// Mostrar un título en HTML con el código del álbum (sanitizado para evitar problemas con caracteres especiales)
echo "<h1>CANCIONES de " . htmlspecialchars($album) . "</h1>";
// Comenzar una lista HTML para mostrar las canciones
echo "<ul>";
// Recorrer cada fila de resultados de la consulta
while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
    // Mostrar el título de cada canción dentro de un <li>, protegido con htmlspecialchars()
    echo "<li>" . htmlspecialchars($fila['titulo']) . "</li>";
}
// Cerrar la lista HTML
echo "</ul>";
// Enlace para agregar una nueva canción al álbum
echo "<p><a href='cancionnueva.php?codigo=$album'>Añadir canción</a></p>";
// Enlace para borrar el álbum
echo "<p><a href='borrardisco.php?codigo=$album'>Borrar álbum</a></p>";
// Enlace para volver a la página principal de la discografía
echo "<p><a href='index.php'>VOLVER</a></p>";
?>
