<?php
class juego extends soporte{

    public $idiomas;
    private $minNumJugadores;
    private $maxNumJugadores;
    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores) 
    {

        parent::__construct($titulo, $numero, $precio);

        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraJugadoresDisponibles() {
        if($this->maxNumJugadores > 1){
            return 'Desde ' . $this->minNumJugadores . ' - ' . $this->maxNumJugadores . ' jugadores.';
        }else{
            return 'Para un jugador';
        }
    }

    public function muestraResumen()
    {
        echo '<br>' . $this->titulo .'<br>' . $this->getPrecio() . '€ (IVA no includo) <br>' . $this->muestraJugadoresDisponibles();
    }

}
?>