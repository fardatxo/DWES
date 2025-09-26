<?php


//Función que suma dos números.
//Lanza una excepción si alguno de los parámetros no es numérico.
//@param mixed $a Primer número
//@param mixed $b Segundo número
//@return float|int Resultado de la suma
//@throws Exception Si alguno de los parámetros no es un número

function addNumbers($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Ambos parámetros deben ser números.");
    }
    return $a + $b;
}

// Programa principal
try {
    $result = addNumbers(5, 10);
    echo "Resultado de la suma: " . $result . PHP_EOL;

    // Esto lanzará una excepción
    $result = addNumbers(5, "hola");
    echo "Resultado de la suma: " . $result . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
