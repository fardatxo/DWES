<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Si se envió el formulario
if ($_POST) {
    $u = $_POST['user'];       // Usuario nuevo
    $p = $_POST['password'];   // Contraseña nueva

    // Comprobar si ya existe el usuario
    $q = $pdo->prepare("SELECT 1 FROM tabla_usuarios WHERE usuario=?");
    $q->execute([$u]);

    if ($q->fetch()) {
        $msg = "El usuario ya existe.";
    } else {
        // Insertar usuario nuevo con contraseña cifrada
        $pdo->prepare("INSERT INTO tabla_usuarios VALUES(?,?)")
            ->execute([$u, password_hash($p, PASSWORD_DEFAULT)]);
        $msg = "Usuario creado correctamente. <a href='login.php'>Iniciar sesión</a>";
    }
}
?>
<h2>Crear usuario</h2>

<!-- Formulario para registrar usuario -->
<form method="post">
  Usuario: <input name="user"><br>
  Contraseña: <input type="password" name="password"><br><br>
  <button>Registrar</button>
</form>

<!-- Mensaje de éxito o error -->
<?= $msg ?? '' ?>
