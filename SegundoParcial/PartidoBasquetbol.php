<?php
class PartidoBasquetbol extends Partido{
    private $cantInfracciones;
    private $coef_penalizacion;
    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $cantInfracciones) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
        $this->coef_penalizacion = 0.75;
    }
    public function getCantInfracciones()
    {
        return $this->cantInfracciones;
    }
    public function setCantInfracciones($cantInfracciones)
    {
        $this->cantInfracciones = $cantInfracciones;
    }
    public function getCoefPenalizacion()
    {
        return $this->coef_penalizacion;
    }
    public function setCoefPenalizacion($coef_penalizacion)
    {
        $this->coef_penalizacion = $coef_penalizacion;
    }
    public function coeficientePartido() {
        $coef_base = parent::coeficientePartido();
        $coeficiente = $coef_base - ($this->getCoefPenalizacion() * $this->getCantInfracciones());
        return $coeficiente;
    }
    public function __toString() {
        $cadena = parent::__toString();
        $cadena .= "\nCantidad Infracciones: " . $this->getCantInfracciones() . 
                    "\nCoeficiente de Penalización: " . $this->getCoefPenalizacion();
            return $cadena;
    }
}