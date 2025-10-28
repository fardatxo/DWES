<?php
session_start(); // Verifica que haya sesión activa
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Obtener todos los discos
$albums = $pdo->query("SELECT codigo, titulo FROM album ORDER BY titulo")->fetchAll();
?>
<!-- Mostrar usuario y enlace para cerrar sesión a la izquierda -->
<p> <?= htmlspecialchars($_SESSION['usuario']) ?> |
<a href="login.php?logout=1">Cerrar sesión</a></p>

<h1>Discografía</h1>

<!-- Enlaces principales -->
<p>
  <a href="disconuevo.php"> Nuevo disco</a> |
  <a href="canciones.php"> Buscar canciones</a>
</p>

<!-- Lista de discos -->
<ul>
<?php foreach ($albums as $a): ?>
  <li>
    <?= htmlspecialchars($a['titulo']) ?>
    — <a href="disco.php?codigo=<?= $a['codigo'] ?>">Ver</a>
    | <a href="cancionnueva.php?codigo=<?= $a['codigo'] ?>">Añadir canción</a>
    | <a href="borrardisco.php?codigo=<?= $a['codigo'] ?>">Borrar</a>
  </li>
<?php endforeach; ?>
</ul>
