<?php
session_start(); // Requiere login
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Obtener código de álbum
$codigo = $_GET['codigo'] ?? exit('Falta código');

// Buscar álbum
$album = $pdo->prepare("SELECT titulo FROM album WHERE codigo=?");
$album->execute([$codigo]);
if (!$a = $album->fetch()) exit('Álbum no encontrado');

// Buscar canciones del álbum
$canciones = $pdo->prepare("SELECT * FROM cancion WHERE album=? ORDER BY posicion");
$canciones->execute([$codigo]);
?>
<p> <?= $_SESSION['usuario'] ?> | <a href="login.php?logout=1">Cerrar sesión</a></p>

<h2><?= htmlspecialchars($a['titulo']) ?></h2>

<!-- Lista de canciones -->
<ul>
<?php foreach($canciones as $c): ?>
  <li><?= $c['posicion'] ?>. <?= htmlspecialchars($c['titulo']) ?> (<?= $c['genero'] ?>)</li>
<?php endforeach; ?>
</ul>

<!-- Enlaces -->
<p>
  <a href="cancionnueva.php?codigo=<?= $codigo ?>">Añadir canción</a> |
  <a href="borrardisco.php?codigo=<?= $codigo ?>">Borrar disco</a> |
  <a href="index.php">Volver</a>
</p>
