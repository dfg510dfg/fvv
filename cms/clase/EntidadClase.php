<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadClase {
    private $idclase;
    private $nombre;
    private $feccrea;
    private $fecmodif;
    private $eliminado;

    function __construct() {
        
    }
    public function getIdclase() {
        return $this->idclase;
    }

    public function setIdclase($idclase) {
        $this->idclase = $idclase;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getFeccrea() {
        return $this->feccrea;
    }

    public function setFeccrea($feccrea) {
        $this->feccrea = $feccrea;
    }

    public function getFecmodif() {
        return $this->fecmodif;
    }

    public function setFecmodif($fecmodif) {
        $this->fecmodif = $fecmodif;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }

    
}

?>
