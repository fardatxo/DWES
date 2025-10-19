<?php
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');
$codigo = $_GET['codigo'] ?? exit('Falta el código del disco');

try {
    $pdo->beginTransaction();
    $pdo->prepare("DELETE FROM cancion WHERE album = ?")->execute([$codigo]);
    $pdo->prepare("DELETE FROM album WHERE codigo = ?")->execute([$codigo]);
    $pdo->commit();
    header("Location: index.php?msg=Disco eliminado correctamente");
} catch (Exception $e) {
    $pdo->rollBack();
    header("Location: disco.php?codigo=$codigo&error=Error al borrar el disco: " . $e->getMessage());
}
?>
