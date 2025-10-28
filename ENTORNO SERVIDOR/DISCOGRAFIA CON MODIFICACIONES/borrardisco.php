<?php
session_start();
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Código del disco a borrar
$codigo = $_GET['codigo'] ?? exit('Falta código');

// Iniciar transacción
$pdo->beginTransaction();
try {
    // Borrar canciones del disco
    $pdo->prepare("DELETE FROM cancion WHERE album=?")->execute([$codigo]);
    // Borrar el disco
    $pdo->prepare("DELETE FROM album WHERE codigo=?")->execute([$codigo]);
    $pdo->commit(); // Confirmar cambios
} catch (Exception $e) {
    $pdo->rollBack(); // Revertir si hay error
}
header('Location: index.php');
