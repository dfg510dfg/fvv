<?php
// aqui falta validar preguntando si la seccion esta activa ************

class EntidadPopup{
   private $idpopup;
   private $nom;
   private $img;
   private $ancho;
   private $alto;
   private $resizable;
   private $position;
   private $swactivo;
   private $enlace;
   private $url;
   private $abrir;
   
   function __construct() {
       
   }

   public function getEnlace() {
       return $this->enlace;
   }

   public function getUrl() {
       return $this->url;
   }

   public function getAbrir() {
       return $this->abrir;
   }

   public function setEnlace($enlace) {
       $this->enlace = $enlace;
   }

   public function setUrl($url) {
       $this->url = $url;
   }

   public function setAbrir($abrir) {
       $this->abrir = $abrir;
   }

   public function getIdpopup() {
       return $this->idpopup;
   }

   public function getNom() {
       return $this->nom;
   }

   public function getImg() {
       return $this->img;
   }

   public function getAncho() {
       return $this->ancho;
   }

   public function getAlto() {
       return $this->alto;
   }

   public function getResizable() {
       return $this->resizable;
   }

   public function getPosition() {
       return $this->position;
   }

   public function getSwactivo() {
       return $this->swactivo;
   }

   public function setIdpopup($idpopup) {
       $this->idpopup = $idpopup;
   }

   public function setNom($nom) {
       $this->nom = $nom;
   }

   public function setImg($img) {
       $this->img = $img;
   }

   public function setAncho($ancho) {
       $this->ancho = $ancho;
   }

   public function setAlto($alto) {
       $this->alto = $alto;
   }

   public function setResizable($resizable) {
       $this->resizable = $resizable;
   }

   public function setPosition($position) {
       $this->position = $position;
   }

   public function setSwactivo($swactivo) {
       $this->swactivo = $swactivo;
   }


    
  }

?>
