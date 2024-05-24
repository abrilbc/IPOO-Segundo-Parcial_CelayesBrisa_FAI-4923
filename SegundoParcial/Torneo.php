<?php
class Torneo{
    private $colPartidos;
    private $importePremio;
    public function __construct($importePremio) {
        $this->colPartidos = [];
        $this->importePremio = $importePremio;
    }
    public function getColPartidos()
    {
        return $this->colPartidos;
    }
    public function setColPartidos($colPartidos)
    {
        $this->colPartidos = $colPartidos;
    }
    public function getImportePremio()
    {
        return $this->importePremio;
    }
    public function setImportePremio($importePremio)
    {
        $this->importePremio = $importePremio;
    }
    public function mostrarColeccion($coleccion) {
        $cadena = "";
        foreach ($coleccion as $objetoColeccion) {
            $cadena .= $objetoColeccion . "\n";
        }
        return $cadena;
    }
    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipoPartido) {
        $colPartidos = $this->getColPartidos();
        $idPartido = count($colPartidos) + 1;
        $cantJugadoresE1 = $objEquipo1->getCantJugadores();
        $cantJugadoresE2 = $objEquipo2->getCantJugadores();
        $partido = null;
        if ($cantJugadoresE1 == $cantJugadoresE2) {
            if ($tipoPartido = "Futbol" || $tipoPartido == "futbol") {
                $categoriaE1 = $objEquipo1->getObjCategoria();
                $categoriaE2 = $objEquipo2->getObjCategoria();
                if ($categoriaE1 == $categoriaE2) {
                $partido = new PartidoFutbol($idPartido, $fecha, $objEquipo1, 0, $objEquipo2, 0);
                array_push($colPartidos, $partido);
                $this->setColPartidos($colPartidos);
                }
            }
            if ($tipoPartido == "Basquet" || $tipoPartido == "basquet") {
                $partido = new PartidoBasquetbol($idPartido, $fecha, $objEquipo1, 0, $objEquipo2, 0, 0);
                array_push($colPartidos, $partido);
                $this->setColPartidos($colPartidos);  
            }
        }
        return $partido;
    }
    public function darColGanadores($deporte) {
        $colPartidos = $this->getColPartidos();
        $colGanadores = [];
        foreach ($colPartidos as $partido) {
            if ($deporte == "Futbol" || $deporte == "futbol") {
                if ($partido instanceof PartidoFutbol) {
                    $equipoGanador = $partido->darEquipoGanador();
                    if (!is_array($equipoGanador)) {
                        $colGanadores[] = $equipoGanador;
                    } else {
                        array_merge($colGanadores, $equipoGanador);
                    }
                }
            }
            if ($deporte == "Basquet" || $deporte == "basquet") {
                if ($partido instanceof PartidoBasquetbol) {
                    $equipoGanador = $partido->darEquipoGanador();
                    if (!is_array($equipoGanador)) {
                        $colGanadores[] = $equipoGanador;
                    } else {
                        array_merge($colGanadores, $equipoGanador);
                    }
                }
            }
        }
        return $colGanadores;
    }
    public function calcularPremioPartido($objPartido) {
        $equipoGanador = $objPartido->darEquipoGanador();
        $arrayPremios = [];
        $coeficiente = $objPartido->coeficientePartido();
        $premioPartido = $coeficiente + $this->getImportePremio();
        if (!is_array($equipoGanador)) {
            $arrayPremios = ["equipoGanador" => $equipoGanador, "premioPartido" => $premioPartido];
        }
        return $arrayPremios;
    }
    public function __toString() {
        $copiaColPartidos = $this->getColPartidos();
        $cadena = "\nPartidos: \n" . $this->mostrarColeccion($copiaColPartidos);
        $cadena .= "\nImporte del Premio: " . $this->getImportePremio();
        return $cadena; 
    }
}