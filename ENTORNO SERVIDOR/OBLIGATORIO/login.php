<?php
session_start(); // Inicia la sesión para poder guardar el usuario logueado

// Conexión a la base de datos 'discografia'
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

// Si se recibe ?logout=1 en la URL, cerrar sesión y volver al login
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Si se envió el formulario
if ($_POST) {
    $u = $_POST['user'];       // Usuario introducido
    $p = $_POST['password'];   // Contraseña introducida

    // Buscar al usuario en la base de datos
    $q = $pdo->prepare("SELECT password FROM tabla_usuarios WHERE usuario=?");
    $q->execute([$u]);

    // Si existe y la contraseña coincide
    if ($r = $q->fetch() and password_verify($p, $r['password'])) {
        $_SESSION['usuario'] = $u; // Guardar nombre en sesión
        header('Location: index.php'); // Ir a página principal
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<h2>Iniciar sesión</h2>

<!-- Formulario simple de login -->
<form method="post">
  Usuario: <input name="user"><br>
  Contraseña: <input type="password" name="password"><br><br>
  <button>Entrar</button>
</form>

<!-- Mostrar error si existe -->
<?= $error ?? '' ?>

<p><a href="crearlogin.php">Crear usuario</a></p>
