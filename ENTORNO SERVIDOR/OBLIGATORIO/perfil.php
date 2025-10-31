<?php
session_start();
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Obtener datos del usuario
$stmt = $pdo->prepare("SELECT usuario, imagen_big, imagen_small FROM tabla_usuarios WHERE usuario=?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch();

if (!$usuario) {
    header('Location: login.php');
    exit;
}
?>
<p>
<?php if ($usuario['imagen_small'] && file_exists($usuario['imagen_small'])): ?>
    <img src="<?= htmlspecialchars($usuario['imagen_small']) ?>" alt="Avatar">
<?php endif; ?>
<?= htmlspecialchars($_SESSION['usuario']) ?> | 
<a href="login.php?logout=1">Cerrar sesión</a>
</p>

<h1>Perfil de usuario</h1>

<p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>

<h3>Imagen de perfil</h3>
<?php if ($usuario['imagen_big'] && file_exists($usuario['imagen_big'])): ?>
    <img src="<?= htmlspecialchars($usuario['imagen_big']) ?>" alt="Imagen de perfil"><br>
<?php else: ?>
    <p>No has subido una imagen de perfil</p>
<?php endif; ?>

<p><a href="index.php">Ir a Discografía</a></p>