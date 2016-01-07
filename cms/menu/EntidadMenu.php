<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadMenu {
    private $idmenu;
    private $nombre;
    private $nivel;
    private $posicion;
    private $contenido;
    private $idpagina;
    private $ruta;
    private $idcontenedor;
    private $abrir;
    private $eliminado;
    private $mostrar;
    
    public function getMostrar() {
        return $this->mostrar;
    }

    public function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }

        function __construct() {
        
    }
    
    public function getIdmenu() {
        return $this->idmenu;
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getAbrir() {
        return $this->abrir;
    }

    public function setAbrir($abrir) {
        $this->abrir = $abrir;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }

        public function getNivel() {
        return $this->nivel;
    }

    public function getPosicion() {
        return $this->posicion;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function getRuta() {
        return $this->ruta;
    }

    public function getIdcontenedor() {
        return $this->idcontenedor;
    }

    public function setIdmenu($idmenu) {
        $this->idmenu = $idmenu;
    }
    public function getIdpagina() {
        return $this->idpagina;
    }

    public function setIdpagina($idpagina) {
        $this->idpagina = $idpagina;
    }

        public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function setPosicion($posicion) {
        $this->posicion = $posicion;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    public function setIdcontenedor($idcontenedor) {
        $this->idcontenedor = $idcontenedor;
    }
    
}

?>
