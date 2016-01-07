<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadBanner{
    private $idbanner;
    private $titulo;
    private $descripcion;
    private $enlace;
    private $url;
    private $orden;
    private $foto;
    private $fotochico;
    private $eliminado;
    private $cargaurl;
    private $mostrar;
    private $feccrea;
    private $fecmodif;
    private $idcatempre;
    private $abrir;
    
    function __construct() {
        
    }
    
    public function getIdcatempre() {
        return $this->idcatempre;
    }

    public function setIdcatempre($idcatempre) {
        $this->idcatempre = $idcatempre;
    }
    
    public function getMostrar() {
        return $this->mostrar;
    }

    public function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
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
    
    public function getIdbanner() {
        return $this->idbanner;
    }

    public function setIdbanner($idbanner) {
        $this->idbanner = $idbanner;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getFotochico() {
        return $this->fotochico;
    }

    public function setFotochico($fotochico) {
        $this->fotochico = $fotochico;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }

    public function getCargaurl() {
        return $this->cargaurl;
    }

    public function setCargaurl($cargaurl) {
        $this->cargaurl = $cargaurl;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getEnlace() {
        return $this->enlace;
    }

    public function setEnlace($enlace) {
        $this->enlace = $enlace;
    }

    public function getAbrir() {
        return $this->abrir;
    }

    public function setAbrir($abrir) {
        $this->abrir = $abrir;
    }



}

?>
