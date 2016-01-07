<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadProducto {
    private $idproducto;
    private $codigo;
    private $nombre;
    private $idcategoria;
    private $foto1;
    private $foto2;
    private $foto3;
    private $potencia;
    private $voltaje;
    private $feccrea;
    private $fecmodif;
    private $eliminado;
    private $destacado;
    private $descripcion;
    private $edades;
    private $idgenero;
    private $caracter;
    private $documento;
    
    function __construct() {
        
    }
    public function getCaracter() {
        return $this->caracter;
    }

    public function setCaracter($caracter) {
        $this->caracter = $caracter;
    }

    public function getIdproducto() {
        return $this->idproducto;
    }

    public function setIdproducto($idproducto) {
        $this->idproducto = $idproducto;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getIdcategoria() {
        return $this->idcategoria;
    }

    public function setIdcategoria($idcategoria) {
        $this->idcategoria = $idcategoria;
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

    public function getDestacado() {
        return $this->destacado;
    }

    public function setDestacado($destacado) {
        $this->destacado = $destacado;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getEdades() {
        return $this->edades;
    }

    public function setEdades($edades) {
        $this->edades = $edades;
    }

    public function getIdgenero() {
        return $this->idgenero;
    }

    public function setIdgenero($idgenero) {
        $this->idgenero = $idgenero;
    }
    public function getFoto1() {
        return $this->foto1;
    }

    public function getFoto2() {
        return $this->foto2;
    }

    public function getFoto3() {
        return $this->foto3;
    }

    public function getPotencia() {
        return $this->potencia;
    }

    public function getVoltaje() {
        return $this->voltaje;
    }

    public function setFoto1($foto1) {
        $this->foto1 = $foto1;
    }

    public function setFoto2($foto2) {
        $this->foto2 = $foto2;
    }

    public function setFoto3($foto3) {
        $this->foto3 = $foto3;
    }

    public function setPotencia($potencia) {
        $this->potencia = $potencia;
    }

    public function setVoltaje($voltaje) {
        $this->voltaje = $voltaje;
    }
    
    public function getDocumento() {
        return $this->documento;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }



}

?>
