<?php
// Crear una conexión PDO a la base de datos MySQL
// host=localhost -> servidor local
// dbname=discografia -> nombre de la base de datos
// charset=utf8 -> codificación de caracteres UTF-8
// 'discografia', 'discografia' -> usuario y contraseña de la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');
// Ejecutar una consulta SQL para obtener todos los álbumes
// Se seleccionan las columnas 'codigo' y 'titulo' de la tabla 'album'
$resultado = $pdo->query("SELECT codigo, titulo FROM album");
// Mostrar un título principal en HTML
echo "<h1>DISCOGRAFIA</h1>";
// Mostrar un enlace para agregar un nuevo disco
echo "<p><a href='disconuevo.php'>Agregar nuevo disco</a></p>";
// Comenzar una lista HTML para mostrar los discos
echo "<ul>";
// Recorrer los resultados de la consulta línea por línea
// fetch(PDO::FETCH_ASSOC) devuelve un array asociativo, es decir, con nombres de columna como claves
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    // Guardar el código del disco en una variable
    $codigo = $fila['codigo'];
    // Guardar el título del disco y evitar problemas de seguridad con caracteres especiales
    $titulo = htmlspecialchars($fila['titulo']);
    // Mostrar cada disco como un elemento de lista
    echo "<li>$titulo - ";
    // Enlaces para acciones relacionadas con el disco
    // Ver canciones del disco
    echo "<a href='disco.php?codigo=$codigo'>Ver canciones</a> | ";
    // Añadir una nueva canción al disco
    echo "<a href='cancionnueva.php?codigo=$codigo'>Añadir canción</a> | ";
    // Borrar el disco
    echo "<a href='borrardisco.php?codigo=$codigo'>Borrar disco</a>";
    echo "</li>"; // Cerrar el elemento de lista

}
// Cerrar la lista HTML
echo "</ul>";

echo "<p><a href='canciones.php'>Buscar canciones</a></p>";
?>
