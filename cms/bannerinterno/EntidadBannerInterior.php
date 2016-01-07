<?php
class EntidadBannerInterior{
    private $idbannerinterior;
    private $descripcion;    
    private $foto;
    private $fotochico;
    private $eliminado;
    private $feccrea;
    private $fecmodif;
    private $url;
    
    function __construct() {
        
    }
    
    public function getIdbannerinterior() {
        return $this->idbannerinterior;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getFotochico() {
        return $this->fotochico;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function getFeccrea() {
        return $this->feccrea;
    }

    public function getFecmodif() {
        return $this->fecmodif;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setIdbannerinterior($idbannerinterior) {
        $this->idbannerinterior = $idbannerinterior;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setFotochico($fotochico) {
        $this->fotochico = $fotochico;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }

    public function setFeccrea($feccrea) {
        $this->feccrea = $feccrea;
    }

    public function setFecmodif($fecmodif) {
        $this->fecmodif = $fecmodif;
    }

    public function setUrl($url) {
        $this->url = $url;
    }



}

?>
