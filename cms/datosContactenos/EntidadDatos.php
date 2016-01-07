<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadDatos {
    private $iddatos;
    private $posicion;
    private $nombre;
    private $contenido;
    private $url;

    function __construct() {
        
    }
    
    public function getIddatos() {
        return $this->iddatos;
    }

    public function getPosicion() {
        return $this->posicion;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setIddatos($iddatos) {
        $this->iddatos = $iddatos;
    }

    public function setPosicion($posicion) {
        $this->posicion = $posicion;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function setUrl($url) {
        $this->url = $url;
    }


}

?>
