<?php
class PartidoFutbol extends Partido {
    private $coef_Menores;
    private $coef_Juveniles;
    private $coef_Mayores;
    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->coef_Menores = 0.13;
        $this->coef_Juveniles = 0.19;
        $this->coef_Mayores = 0.27;
    }
    public function getCoefMenores()
    {
        return $this->coef_Menores;
    }
    public function setCoefMenores($coef_Menores)
    {
        $this->coef_Menores = $coef_Menores;
    }
    public function getCoefJuveniles()
    {
        return $this->coef_Juveniles;
    }
    public function setCoefJuveniles($coef_Juveniles)
    {
        $this->coef_Juveniles = $coef_Juveniles;
    }
    public function getCoefMayores()
    {
        return $this->coef_Mayores;
    }
    public function setCoefMayores($coef_Mayores)
    {
        $this->coef_Mayores = $coef_Mayores;
    }
    public function coeficientePartido() {
        $equipo1 = $this->getObjEquipo1();
        $equipo2 = $this->getObjEquipo2();
        $cantGolesTotales = ($this->getCantGolesE1()) + ($this->getCantGolesE2());
        $cantJugadoresTotales = ($equipo1->getCantJugadores()) + ($equipo2->getCantJugadores());
        $objCategoria = $equipo1->getObjCategoria();
        $categoria = $objCategoria->getDescripcion();
        if ($categoria == "Menores") {
            $coeficiente = $this->getCoefMenores() * $cantGolesTotales * $cantJugadoresTotales;
        }
        if ($categoria == "Juveniles") {
            $coeficiente = $this->getCoefJuveniles() * $cantGolesTotales * $cantJugadoresTotales;
        }
        if ($categoria == "Mayores") {
            $coeficiente = $this->getCoefMenores() * $cantGolesTotales * $cantJugadoresTotales;
        }
        return $coeficiente;
    }
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena;
    }
}