<?php
session_start(); // Requiere usuario logueado
if (!isset($_SESSION['usuario'])) header('Location: login.php');

// Conexión PDO
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Si se envía el formulario, insertar disco
if ($_POST) {
    $pdo->prepare("INSERT INTO album(titulo,discografica,formato,fechaLanzamiento,fechaCompra,precio)
                   VALUES(?,?,?,?,?,?)")
        ->execute([
            $_POST['titulo'], $_POST['discografica'], $_POST['formato'],
            $_POST['fechaLanzamiento'], $_POST['fechaCompra'], $_POST['precio']
        ]);
    $msg = "Disco agregado correctamente.";
}
?>
<p> <?= $_SESSION['usuario'] ?> | <a href="login.php?logout=1">Cerrar sesión</a></p>

<h2>Nuevo disco</h2>

<!-- Mostrar mensaje si se insertó -->
<?= $msg ?? '' ?>

<!-- Formulario para crear disco -->
<form method="post">
  Título: <input name="titulo"><br>
  Discográfica: <input name="discografica"><br>
  Formato:
  <select name="formato">
    <option>CD</option>
    <option>Vinilo</option>
  </select><br>
  Fecha lanzamiento: <input type="date" name="fechaLanzamiento"><br>
  Fecha compra: <input type="date" name="fechaCompra"><br>
  Precio: <input type="number" step="0.01" name="precio"><br><br>
  <button>Guardar</button>
</form>

<a href="index.php">Volver</a>
