<!DOCTYPE html>
<html lang="es"></html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<title>CONSULTA</title>
<body>  
<?php
    echo 'El alumno ';
    echo '<strong>'.''.$_GET['nombre'] .' '. $_GET['apellidos'].'</strong>';
    echo '<br>Se encuentra cursando el ciclo: ';
    echo $_GET['ciclo'];
    echo '<br>Su email es: '.$_GET['email']. '';
    echo '<br><br>Mensaje: '.$_GET['mensaje']. '';
    echo '<br><br>Fecha de nacimiento: '.$_GET['consulta']. '';
?>
</body>
<?php include 'footer.inc.php'; ?>
</html>

