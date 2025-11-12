<?php
require_once 'Database.php';

/**
 * Clase Cancion - Gestiona las canciones
 * 
 * ¿Para qué sirve?
 * - Obtener canciones de un álbum
 * - Crear nuevas canciones
 * - Buscar canciones con filtros
 */
class Cancion {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConexion();
    }
    
    /**
     * Obtener todas las canciones de un álbum
     * 
     * Uso:
     * $cancion = new Cancion();
     * $lista = $cancion->obtenerPorAlbum(5);
     * // Devuelve: [ ['titulo'=>'Come Together', 'duracion'=>'00:04:20', ...], ... ]
     */
    public function obtenerPorAlbum($codigoAlbum) {
        $stmt = $this->db->prepare("SELECT * FROM cancion WHERE album = ?");
        $stmt->execute([$codigoAlbum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Crear una nueva canción
     * 
     * Uso:
     * $cancion = new Cancion();
     * $datos = [
     *     'titulo' => 'Come Together',
     *     'album' => 5,
     *     'posicion' => 1,
     *     'duracion' => '00:04:20',
     *     'genero' => 'Rock'
     * ];
     * $cancion->crear($datos);
     */
    public function crear($datos) {
        $stmt = $this->db->prepare(
            "INSERT INTO cancion (titulo, album, posicion, duracion, genero) 
             VALUES (?, ?, ?, ?, ?)"
        );
        
        return $stmt->execute([
            $datos['titulo'],
            $datos['album'],
            $datos['posicion'],
            $datos['duracion'],
            $datos['genero']
        ]);
    }
    
    /**
     * Buscar canciones con filtros
     * 
     * ¿Qué hace este método complicado?
     * - Construye una consulta SQL dinámica según los filtros
     * - Puede buscar en título de canción, álbum o ambos
     * - Puede filtrar por género
     * 
     * Uso:
     * $cancion = new Cancion();
     * $resultados = $cancion->buscar('love', 'titulo', 'Rock');
     * // Busca canciones con "love" en el título, que sean de Rock
     * 
     * @param string $texto     El texto a buscar
     * @param string $campo     Dónde buscar: 'titulo', 'album' o 'ambos'
     * @param string $genero    Género musical (vacío = todos)
     */
    public function buscar($texto, $campo, $genero) {
        // Añadir % antes y después para usar LIKE
        // "love" se convierte en "%love%"
        // LIKE "%love%" encuentra: "Love me do", "All you need is love", etc.
        $textoBusqueda = "%$texto%";
        
        // Consulta base que UNE (JOIN) las tablas cancion y album
        // "WHERE 1" es un truco para poder añadir AND fácilmente después
        $sql = "SELECT c.titulo AS cancion, a.titulo AS album, c.genero
                FROM cancion c 
                JOIN album a ON c.album = a.codigo 
                WHERE 1";
        
        // Array vacío para guardar los valores que sustituirán los ?
        $params = [];
        
        // CONSTRUIR LA CONSULTA SEGÚN EL CAMPO
        if ($campo == 'titulo') {
            // Buscar solo en el título de la canción
            $sql .= " AND c.titulo LIKE ?";
            $params[] = $textoBusqueda;  // Añadir al array de parámetros
            
        } elseif ($campo == 'album') {
            // Buscar solo en el nombre del álbum
            $sql .= " AND a.titulo LIKE ?";
            $params[] = $textoBusqueda;
            
        } else {
            // Buscar en AMBOS (título de canción OR nombre de álbum)
            $sql .= " AND (c.titulo LIKE ? OR a.titulo LIKE ?)";
            $params[] = $textoBusqueda;  // Para el primer LIKE
            $params[] = $textoBusqueda;  // Para el segundo LIKE
        }
        
        // Si seleccionaron un género específico, añadir filtro
        if ($genero) {
            $sql .= " AND c.genero = ?";
            $params[] = $genero;
        }
        
        // Ejecutar la consulta con todos los parámetros
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}