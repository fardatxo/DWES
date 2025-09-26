<?php
echo "=== EJERCICIO 1: Suma de dos valores numéricos ===\n";

function sumar($num1, $num2) {
    // Verificamos que ambos parámetros sean números válidos
    if (!is_numeric($num1) || !is_numeric($num2)) {
        throw new Exception("Error: Ambos argumentos deben ser valores numéricos");
    }
    
    return $num1 + $num2;
}

// Prueba con números válidos
try {
    $resultado = sumar(5, 3);
    echo "La suma es: $resultado\n";
} catch (Exception $error) {
    echo "Se ha producido un error: " . $error->getMessage() . "\n";
}

// Prueba con un valor no numérico
try {
    $resultado = sumar("abc", 5);
    echo "La suma es: $resultado\n";
} catch (Exception $error) {
    echo "Se ha producido un error: " . $error->getMessage() . "\n";
}

echo "\n";

echo "=== EJERCICIO 2: División con manejo de errores personalizado ===\n";

// Clase de excepción personalizada
class ExcepcionDeDivision extends Exception {
    public function obtenerMensajeAmigable() {
        return "⚠️ Advertencia: " . $this->getMessage();
    }
}

function dividir($numerador, $denominador) {
    // Validamos que ambos parámetros sean números
    if (!is_numeric($numerador) || !is_numeric($denominador)) {
        throw new ExcepcionDeDivision("Ambos valores deben ser números");
    }

    // Evitamos la división por cero
    if ($denominador == 0) {
        throw new ExcepcionDeDivision("División por cero no permitida");
    }
    
    return $numerador / $denominador;
}

// División normal
try {
    $resultado = dividir(10, 2);
    echo "El cociente es: $resultado\n";
} catch (ExcepcionDeDivision $e) {
    echo $e->obtenerMensajeAmigable() . "\n";
}

// División por cero
try {
    $resultado = dividir(10, 0);
    echo "El cociente es: $resultado\n";
} catch (ExcepcionDeDivision $e) {
    echo $e->obtenerMensajeAmigable() . "\n";
}

// Valores no numéricos
try {
    $resultado = dividir("hola", "mundo");
    echo "El cociente es: $resultado\n";
} catch (ExcepcionDeDivision $e) {
    echo $e->obtenerMensajeAmigable() . "\n";
}

echo "\n=== Ejercicios completados ===\n";
?>
