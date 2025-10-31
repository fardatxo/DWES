<?php
session_start();
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Código del álbum
$codigo = $_GET['codigo'] ?? exit('Falta código');

// Obtener título del álbum
$titulo = $pdo->query("SELECT titulo FROM album WHERE codigo=$codigo")->fetchColumn() ?: exit('Álbum no existe');

// Si se envía el formulario, insertar canción
if ($_POST) {
    $pdo->prepare("INSERT INTO cancion(titulo,album,posicion,duracion,genero) VALUES(?,?,?,?,?)")
        ->execute([$_POST['titulo'],$codigo,$_POST['posicion'],$_POST['duracion'],$_POST['genero']]);
    $msg="Canción agregada correctamente.";
}
?>
<p> <?= $_SESSION['usuario'] ?> | <a href="login.php?logout=1">Cerrar sesión</a></p>

<h2>Nueva canción en <?= htmlspecialchars($titulo) ?></h2>

<?= $msg ?? '' ?>

<!-- Formulario para agregar canción -->
<form method="post">
  Título: <input name="titulo"><br>
  Posición: <input type="number" name="posicion"><br>
  Duración: <input type="time" step="1" name="duracion"><br>
  Género:
  <select name="genero">
    <option>Pop</option>
    <option>Rock</option>
    <option>Jazz</option>
  </select><br><br>
  <button>Guardar</button>
</form>

<a href="disco.php?codigo=<?= $codigo ?>">Volver</a>
