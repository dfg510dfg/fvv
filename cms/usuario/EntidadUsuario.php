<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadUsuario {
    private $idusuario;
    private $usuario;
    private $clave;
    private $correo;
    private $eliminado;
    private $idperfil;
    private $feccrea;
    private $fecmodif;

    function __construct() {
        
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getEliminado() {
        return $this->eliminado;
    }

    public function setEliminado($eliminado) {
        $this->eliminado = $eliminado;
    }

    public function getIdperfil() {
        return $this->idperfil;
    }

    public function setIdperfil($idperfil) {
        $this->idperfil = $idperfil;
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

    
}

?>
