<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadProyecto{
    private $idproyecto;
    private $descripcion;
    private $foto;
    private $contenido;
    private $url;
    private $abrir;
    private $mostrar;
    
    function __construct() {
        
    }
    
    public function getIdproyecto() {
        return $this->idproyecto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getMostrar() {
        return $this->mostrar;
    }

    public function setIdproyecto($idproyecto) {
        $this->idproyecto = $idproyecto;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getAbrir() {
        return $this->abrir;
    }

    public function setAbrir($abrir) {
        $this->abrir = $abrir;
    }


    
}

?>
