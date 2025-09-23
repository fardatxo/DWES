<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>REGISTRO</title>
</head>
<body>  

<?php
if (isset($_GET['exito']) && $_GET['exito'] == '1') {
    echo "<p style='color:green; font-weight:bold;'>✅ Registro completado correctamente.</p>";
    // Mostrar vacío
    ?>
    <form action="" method="post">
      <label for="nombre">Nombre:</label><br>
      <input type="text" id="nombre" name="nombre" required><br><br>

      <label for="apellidos">Apellidos:</label><br>
      <input type="text" id="apellidos" name="apellidos" required><br><br>

      <label for="usuario">Usuario:</label><br>
      <input type="text" id="usuario" name="usuario" required><br><br>

      <label for="email">Correo electrónico:</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="contraseña">Contraseña:</label><br>
      <input type="password" id="contraseña" name="contraseña" required><br><br>

      <label for="contraseña2">Repite contraseña:</label><br>
      <input type="password" id="contraseña2" name="contraseña2" required><br><br>

      <label for="dia">Fecha de nacimiento:</label><br>
      <input type="date" name="dia" id="dia" required><br><br>

      <label for="genero">Género:</label><br>
      <select name="genero" id="genero" required>
        <option value="">--Selecciona--</option>
        <option value="Mujer">Mujer</option>
        <option value="Hombre">Hombre</option>
        <option value="No decir">Prefiero no decirlo</option>
      </select><br><br>

      <input type="checkbox" name="condiciones" id="condiciones">
      <label for="condiciones">Acepto las condiciones</label><br><br>

      <input type="checkbox" name="publicidad" id="publicidad">
      <label for="publicidad">Acepto el envío de publicidad</label><br><br>

      <button type="submit">Enviar</button>
      <button type="reset">Limpiar</button>
    </form>
    <?php
    include_footer();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recogemos los datos del formulario
    $nombre = $_POST["nombre"] ?? "";
    $apellidos = $_POST["apellidos"] ?? "";
    $usuario = $_POST["usuario"] ?? "";
    $email = $_POST["email"] ?? "";
    $contraseña = $_POST["contraseña"] ?? "";
    $contraseña2 = $_POST["contraseña2"] ?? "";
    $dia = $_POST["dia"] ?? "";
    $genero = $_POST["genero"] ?? "";
    $condiciones = $_POST["condiciones"] ?? "";

    // Variables para mensajes de error
    $error_nombre = "";
    $error_apellidos = "";
    $error_usuario = "";
    $error_email = "";
    $error_contraseña = "";
    $error_dia = "";
    $error_genero = "";
    $error_condiciones = "";


    $todo_correcto = true;
    // Validamos uno por uno: si está vacío o es inválido → vaciamos + error

    if ($nombre == "") {
        $nombre = ""; 
        $error_nombre = "El nombre es obligatorio.";
        $todo_correcto = false;
    }

    if ($apellidos == "") {
        $apellidos = "";
        $error_apellidos = "Los apellidos son obligatorios.";
        $todo_correcto = false;
    }

    if ($usuario == "") {
        $usuario = "";
        $error_usuario = "El usuario es obligatorio.";
        $todo_correcto = false;
    }

    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = ""; // Vaciamos si está vacío o es inválido
        $error_email = "El email no es válido.";
        $todo_correcto = false;
    }

    if ($contraseña == "" || $contraseña2 == "") {
        $contraseña = "";
        $contraseña2 = "";
        $error_contraseña = "La contraseña es obligatoria.";
        $todo_correcto = false;
    } elseif ($contraseña != $contraseña2) {
        $contraseña = "";
        $contraseña2 = "";
        $error_contraseña = "Las contraseñas no coinciden.";
        $todo_correcto = false;
    }

    if ($dia == "") {
        $dia = "";
        $error_dia = "La fecha de nacimiento es obligatoria.";
        $todo_correcto = false;
    }

    if ($genero == "") {
        $genero = "";
        $error_genero = "Debes seleccionar un género.";
        $todo_correcto = false;
    }

    if ($condiciones == "") {
        $condiciones = "";
        $error_condiciones = "Debes aceptar las condiciones.";
        $todo_correcto = false;
    }

    if ($todo_correcto) {
        header("Location: registro.php?exito=1");
        exit;
    }
}
?>

<?php if (!isset($todo_correcto) || !$todo_correcto): ?>


    <form action="" method="post">
      
      <label for="nombre">Nombre:</label><br>
      <input type="text" id="nombre" name="nombre" value="<?php if (isset($nombre)) { echo $nombre; } ?>" required><br>
      <?php if (isset($error_nombre) && $error_nombre != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_nombre; ?></p>
      <?php } else { echo "<br>"; } ?>

      <label for="apellidos">Apellidos:</label><br>
      <input type="text" id="apellidos" name="apellidos" value="<?php if (isset($apellidos)) { echo $apellidos; } ?>" required><br>
      <?php if (isset($error_apellidos) && $error_apellidos != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_apellidos; ?></p>
      <?php } else { echo "<br>"; } ?>

      <label for="usuario">Usuario:</label><br>
      <input type="text" id="usuario" name="usuario" value="<?php if (isset($usuario)) { echo $usuario; } ?>" required><br>
      <?php if (isset($error_usuario) && $error_usuario != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_usuario; ?></p>
      <?php } else { echo "<br>"; } ?>

      <label for="email">Correo electrónico:</label><br>
      <input type="email" id="email" name="email" value="<?php if (isset($email)) { echo $email; } ?>" required><br>
      <?php if (isset($error_email) && $error_email != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_email; ?></p>
      <?php } else { echo "<br>"; } ?>

      <label for="contraseña">Contraseña:</label><br>
      <input type="password" id="contraseña" name="contraseña" value="<?php if (isset($contraseña)) { echo $contraseña; } ?>" required><br>
      <?php if (isset($error_contraseña) && $error_contraseña != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_contraseña; ?></p>
      <?php } else { echo "<br>"; } ?>

      <label for="contraseña2">Repite contraseña:</label><br>
      <input type="password" id="contraseña2" name="contraseña2" value="<?php if (isset($contraseña2)) { echo $contraseña2; } ?>" required><br><br>

      <label for="dia">Fecha de nacimiento:</label><br>
      <input type="date" name="dia" id="dia" value="<?php if (isset($dia)) { echo $dia; } ?>" required><br>
      <?php if (isset($error_dia) && $error_dia != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_dia; ?></p>
      <?php } else { echo "<br>"; } ?>

      <label for="genero">Género:</label><br>
      <select name="genero" id="genero" required>
        <option value="">--Selecciona--</option>
        <option value="Mujer" <?php if (isset($genero) && $genero == "Mujer") echo "selected"; ?>>Mujer</option>
        <option value="Hombre" <?php if (isset($genero) && $genero == "Hombre") echo "selected"; ?>>Hombre</option>
        <option value="No decir" <?php if (isset($genero) && $genero == "No decir") echo "selected"; ?>>Prefiero no decirlo</option>
      </select><br>
      <?php if (isset($error_genero) && $error_genero != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_genero; ?></p>
      <?php } else { echo "<br>"; } ?>

      <input type="checkbox" name="condiciones" id="condiciones" <?php if (isset($condiciones) && $condiciones != "") echo "checked"; ?>>
      <label for="condiciones">Acepto las condiciones</label><br>
      <?php if (isset($error_condiciones) && $error_condiciones != "") { ?>
          <p style="color:red; margin: 5px 0 15px 0;"><?php echo $error_condiciones; ?></p>
      <?php } else { echo "<br>"; } ?>

      <input type="checkbox" name="publicidad" id="publicidad">
      <label for="publicidad">Acepto el envío de publicidad</label><br><br>

      <button type="submit">Enviar</button>
      <button type="reset">Limpiar</button>
    </form>

<?php endif; ?>

<?php include 'footer.inc.php'; ?>

</body>
</html>