<?php
session_start();
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión PDO
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8','discografia','discografia');

// Si se envía el formulario
if ($_POST) {
    $t = "%{$_POST['texto']}%";       // Texto de búsqueda
    $c = $_POST['campo'] ?? 'ambos';  // Campo: título o álbum
    $g = $_POST['genero'] ?? '';      // Género

    // Consulta base con JOIN
    $sql = "SELECT c.titulo AS cancion, a.titulo AS album, c.genero
            FROM cancion c JOIN album a ON c.album=a.codigo WHERE 1";
    $p = []; // Array de parámetros

    // Filtros según campo elegido
    if ($c == 'titulo') { $sql .= " AND c.titulo LIKE ?"; $p = [$t]; }
    elseif ($c == 'album') { $sql .= " AND a.titulo LIKE ?"; $p = [$t]; }
    else { $sql .= " AND (c.titulo LIKE ? OR a.titulo LIKE ?)"; $p = [$t, $t]; }

    // Filtro por género
    if ($g) { $sql .= " AND c.genero=?"; $p[] = $g; }

    // Ejecutar consulta
    $r = $pdo->prepare($sql);
    $r->execute($p);
    $res = $r->fetchAll();
}
?>
<p> <?= $_SESSION['usuario'] ?> | <a href="login.php?logout=1">Cerrar sesión</a></p>

<h2>Buscar canciones</h2>

<!-- Formulario de búsqueda -->
<form method="post">
  Texto: <input name="texto"><br>
  Buscar en:
  <input type="radio" name="campo" value="titulo" checked> Canción
  <input type="radio" name="campo" value="album"> Álbum
  <input type="radio" name="campo" value="ambos"> Ambos<br>
  Género:
  <select name="genero">
    <option value="">Todos</option>
    <option>Pop</option>
    <option>Rock</option>
    <option>Jazz</option>
  </select><br><br>
  <button>Buscar</button>
</form>

<!-- Mostrar resultados -->
<?php if (!empty($res)): ?>
<ul>
  <?php foreach($res as $x): ?>
    <li><?= $x['cancion'] ?> — <?= $x['album'] ?> (<?= $x['genero'] ?>)</li>
  <?php endforeach; ?>
</ul>
<?php elseif($_POST): ?>
  <p>No se encontraron resultados.</p>
<?php endif; ?>

<a href="index.php">Volver</a>
