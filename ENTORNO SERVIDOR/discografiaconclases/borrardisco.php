<?php
/**
 * borrardisco.php - Elimina un álbum
 * 
 * ¿Qué hace?
 * - Recibe código: borrardisco.php?codigo=5
 * - Borra el álbum y sus canciones
 * - Redirige a index.php con mensaje
 * 
 * IMPORTANTE: Este archivo NO muestra nada, solo borra y redirige
 */

require_once 'Album.php';

$codigo = $_GET['codigo'] ?? exit('Falta código');

$album = new Album();

// try-catch = intentar algo y capturar errores
try {
    // Intentar eliminar
    $album->eliminar($codigo);
    
    // Si funcionó, redirigir a index con mensaje de éxito
    // header() = enviar encabezado HTTP para redirigir
    header("Location: index.php?msg=Disco eliminado");
    
} catch (Exception $e) {
    // Si hubo error, redirigir a disco.php con el mensaje de error
    // $e->getMessage() = obtiene el texto del error
    header("Location: disco.php?codigo=$codigo&error=" . $e->getMessage());
}