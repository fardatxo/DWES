<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count</title>
</head>
<body>
    <?php include 'cabecera.inc.php'; 

    for($x = 1; $x <= 30; $x++) {
        echo $x . " ";
    }
    echo '<br>';
    echo '!5 = ';
    $total = 5;
    $resultado = 1;
    for($y = 5; $y >= 1; $y--) {
        

        if ($y != 1)
        echo $y . " x ";
    
        else {
        echo $y . " = ";
    }
}
    for ($n = $total; $n >= 1; $n--) {
        $resultado = $resultado*$n;
    }
    echo $resultado;

    ?>
</body>

<?php include 'footer.inc.php'; ?>

</html>