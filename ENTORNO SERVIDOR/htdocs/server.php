<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVER</title>
</head>
<style>
    table,
    td {
        border-collapse : collapse;

    }
    td {
        border: 1px solid black;
        width: 40px;
    }   
</style>
<body>
<?php include('cabecera.inc.php'); ?>
    <table>
    <?php
        echo "<tr>";
        echo "<td><strong>CLAVE</strong></td>";
        echo "<td><strong>VALOR</strong></td>";
        echo "</tr>";
    foreach ($_SERVER as $clave => $valor) {
        echo "<tr>";
        echo "<td>".$clave."</td>";
        echo "<td>".$valor."</td>";
        echo "</tr>";
    }

    ?>
    </table>
</body>
<?php include 'footer.inc.php'; ?>
</html>