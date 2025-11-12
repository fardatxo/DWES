<?php
require_once 'Database.php';  // Incluir el archivo Database.php (solo una vez)

/**
 * Clase Album - Gestiona todo lo relacionado con álbumes
 * 
 * ¿Para qué sirve?
 * - Obtener álbumes de la BD
 * - Crear nuevos álbumes
 * - Eliminar álbumes
 * 
 * ¿Cómo se usa?
 * $album = new Album();           // Crear objeto
 * $lista = $album->obtenerTodos(); // Usar método
 */
class Album {
    // Variable que guarda la conexión a la BD
    private $db;
    
    /**
     * Constructor - Se ejecuta al hacer: new Album()
     * Aquí obtenemos la conexión a la base de datos
     */
    public function __construct() {
        $database = new Database();              // Crear objeto Database
        $this->db = $database->getConexion();    // Guardar la conexión PDO
    }
    
    /**
     * Obtener todos los álbumes
     * 
     * ¿Qué hace?
     * - SELECT codigo, titulo FROM album
     * - Devuelve un array con todos los discos
     * 
     * Uso:
     * $album = new Album();
     * $discos = $album->obtenerTodos();
     * // $discos = [ ['codigo'=>1, 'titulo'=>'Abbey Road'], ... ]
     */
    public function obtenerTodos() {
        // query() = ejecutar consulta simple sin parámetros
        $stmt = $this->db->query("SELECT codigo, titulo FROM album");
        
        // fetchAll() = traer todos los resultados
        // FETCH_ASSOC = como array asociativo ['codigo'=>1, 'titulo'=>'...']
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Obtener el título de un álbum específico
     * 
     * ¿Qué hace?
     * - SELECT titulo WHERE codigo = ?
     * - Devuelve solo el título o null si no existe
     * 
     * Uso:
     * $album = new Album();
     * $titulo = $album->obtenerTitulo(5);
     * // $titulo = "Abbey Road" o null
     */
    public function obtenerTitulo($codigo) {
        // prepare() = preparar consulta con ? (para evitar SQL injection)
        $stmt = $this->db->prepare("SELECT titulo FROM album WHERE codigo = ?");
        
        // execute() = ejecutar y sustituir el ? por $codigo
        $stmt->execute([$codigo]);
        
        // fetch() = traer UNA fila (no todas como fetchAll)
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si encontró algo, devolver el título. Si no, devolver null
        // Operador ternario: condición ? si_true : si_false
        return $resultado ? $resultado['titulo'] : null;
    }
    
    /**
     * Crear un nuevo álbum
     * 
     * ¿Qué hace?
     * - INSERT INTO album VALUES (...)
     * - Devuelve true si funcionó, false si falló
     * 
     * Uso:
     * $album = new Album();
     * $datos = [
     *     'titulo' => 'Abbey Road',
     *     'discografica' => 'Apple',
     *     'formato' => 'vinilo',
     *     'fechaLanzamiento' => '1969-09-26',
     *     'fechaCompra' => '2024-01-15',
     *     'precio' => 29.99
     * ];
     * $album->crear($datos);
     */
    public function crear($datos) {
        // Preparar INSERT con 6 signos de interrogación (uno por cada valor)
        $stmt = $this->db->prepare(
            "INSERT INTO album (titulo, discografica, formato, fechaLanzamiento, fechaCompra, precio) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        
        // Ejecutar sustituyendo los ? por los valores del array $datos
        // Los ? se sustituyen EN ORDEN: primer ? = $datos['titulo'], etc.
        return $stmt->execute([
            $datos['titulo'],
            $datos['discografica'],
            $datos['formato'],
            $datos['fechaLanzamiento'],
            $datos['fechaCompra'],
            $datos['precio']
        ]);
    }
    
    /**
     * Eliminar un álbum y todas sus canciones
     * 
     * ¿Qué hace?
     * - Borra primero las canciones del álbum
     * - Luego borra el álbum
     * - Usa TRANSACCIÓN para que si falla algo, no se borre nada
     * 
     * ¿Qué es una transacción?
     * - beginTransaction() = "empezar, pero no guardar todavía"
     * - commit() = "ahora sí, guardar todo"
     * - rollBack() = "cancelar todo, volver atrás"
     * 
     * Uso:
     * $album = new Album();
     * try {
     *     $album->eliminar(5);
     *     echo "Borrado!";
     * } catch (Exception $e) {
     *     echo "Error: " . $e->getMessage();
     * }
     */
    public function eliminar($codigo) {
        // Iniciar transacción
        $this->db->beginTransaction();
        
        try {
            // 1. Borrar canciones del álbum
            $this->db->prepare("DELETE FROM cancion WHERE album = ?")->execute([$codigo]);
            
            // 2. Borrar el álbum
            $this->db->prepare("DELETE FROM album WHERE codigo = ?")->execute([$codigo]);
            
            // Si todo fue bien, confirmar cambios
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            // Si hubo error, cancelar TODO (volver atrás)
            $this->db->rollBack();
            
            // Lanzar el error para que lo capture quien llamó a este método
            throw $e;
        }
    }
    /**
 * Actualizar el precio de un álbum
 * 
 * @param int $codigo El código del álbum
 * @param float $nuevoPrecio El nuevo precio
 */
public function actualizarPrecio($codigo, $nuevoPrecio) {
    // TODO: Hacer UPDATE album SET precio = ? WHERE codigo = ?
    $stmt = $this->db->prepare("UPDATE album SET precio = ? WHERE codigo = ?");
    // Usar prepare() y execute()
    return $stmt->execute([
        $nuevoPrecio,
        $codigo
    ]);
}
}