<?php


//Clase de excepción personalizada para errores en operaciones matemáticas.

class MathException extends Exception {
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        // Mensaje personalizado
        $message = "¡Error matemático! " . $message;
        parent::__construct($message, $code, $previous);
    }
}


//Función que divide dos números.
//Valida que ambos sean números y que el divisor no sea cero.
//@param mixed $dividend Dividendo
//@param mixed $divisor Divisor
//@return float Resultado de la división
//@throws MathException Si los parámetros no son válidos

function divideNumbers($dividend, $divisor) {
    if (!is_numeric($dividend) || !is_numeric($divisor)) {
        throw new MathException("Ambos parámetros deben ser números.");
    }
    if ($divisor == 0) {
        throw new MathException("El divisor no puede ser cero.");
    }
    return $dividend / $divisor;
}

// Programa principal
try {
    $result = divideNumbers(10, 2);
    echo "Resultado de la división: " . $result . PHP_EOL;

    // Esto lanzará una excepción por división por cero
    $result = divideNumbers(10, 0);
    echo "Resultado de la división: " . $result . PHP_EOL;
} catch (MathException $e) {
    echo $e->getMessage() . PHP_EOL;
}

// Otra prueba con parámetros no numéricos
try {
    $result = divideNumbers("hola", 2);
    echo "Resultado de la división: " . $result . PHP_EOL;
} catch (MathException $e) {
    echo $e->getMessage() . PHP_EOL;
}
