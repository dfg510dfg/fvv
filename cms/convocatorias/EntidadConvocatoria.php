<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadConvocatoria{
    private $idconvocatoria;
    private $descripcion;
    private $fec_ini;
    private $fec_fin;
    private $doc_conv;
    private $doc_res;
    private $resultado;
    private $mostrar;
    
    public function getMostrar() {
        return $this->mostrar;
    }

    public function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }
    
    function __construct() {
        
    }
    public function getIdconvocatoria() {
        return $this->idconvocatoria;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFec_ini() {
        return $this->fec_ini;
    }

    public function getFec_fin() {
        return $this->fec_fin;
    }

    public function getDoc_conv() {
        return $this->doc_conv;
    }

    public function getDoc_res() {
        return $this->doc_res;
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function setIdconvocatoria($idconvocatoria) {
        $this->idconvocatoria = $idconvocatoria;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFec_ini($fec_ini) {
        $this->fec_ini = $fec_ini;
    }

    public function setFec_fin($fec_fin) {
        $this->fec_fin = $fec_fin;
    }

    public function setDoc_conv($doc_conv) {
        $this->doc_conv = $doc_conv;
    }

    public function setDoc_res($doc_res) {
        $this->doc_res = $doc_res;
    }

    public function setResultado($resultado) {
        $this->resultado = $resultado;
    }




}

?>
