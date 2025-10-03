<?php

class Soporte {
    
    public $titulo;         
    protected $numero;      
    private $precio;        

    
    private const VAT = 0.21;

    
    public function __construct($titulo, $numero, $precio) {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function __set($propiedad, $valor) {
        $this->$propiedad = $valor;
    }
    public function getPrecio() {
        return $this->precio;
    }

    
    public function getPrecioConIva() {
        return $this->precio + ($this->precio * self::VAT);
    }

    public function getNumero() {
        return $this->numero;
    }
    public function muestraResumen()
    {
        echo '<br>' .$this->titulo . '<br>' . $this->getPrecio() . '€ (IVA no incluido)';
    }
}
?>
