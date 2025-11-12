<?php
/**
 * Clase Database - Maneja la conexión a la base de datos
 * 
 * ¿Para qué sirve? 
 * - Conectarse a MySQL una sola vez
 * - Que todas las otras clases usen esta misma conexión
 */
class Database {
    // Variable privada que guarda la conexión PDO
    // "private" = solo se puede usar dentro de esta clase
    private $pdo;
    
    /**
     * Constructor - Se ejecuta automáticamente al hacer: new Database()
     * Aquí conectamos a la base de datos
     */
    public function __construct() {
        // Crear conexión PDO (como hacías antes con new PDO)
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=discografia;charset=utf8',  // Dónde está la BD
            'discografia',  // Usuario
            'discografia'   // Contraseña
        );
    }
    
    /**
     * Devuelve la conexión PDO para que otras clases la usen
     * 
     * Uso: $db = $database->getConexion();
     */
    public function getConexion() {
        return $this->pdo;
    }
}