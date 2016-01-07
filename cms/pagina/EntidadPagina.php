<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadPagina {
    private $idpagweb;
    private $idusuario;
    private $titulo;
    private $tag;
    private $script;
    private $contenido;
    private $direcimag;
    private $tipo;
    private $imagen;
    private $desc;
    private $idclase;

    function __construct() {
        
    }
    public function getIdclase() {
        return $this->idclase;
    }
	
    public function getIdpagweb() {
        return $this->idpagweb;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTag() {
        return $this->tag;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function setIdclase($idclase) {
        $this->idclase = $idclase;
    }
	
    public function setIdpagweb($idpagweb) {
        $this->idpagweb = $idpagweb;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }
    public function getScript() {
        return $this->script;
    }

    public function setScript($script) {
        $this->script = $script;
    }

    public function getDirecimag() {
        return $this->direcimag;
    }

    public function setDirecimag($direcimag) {
        $this->direcimag = $direcimag;
    }


}

?>
