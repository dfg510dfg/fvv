<?php
class Sesion {
    
    public function __construct() {
       session_start();
    }

    public function setVariableSession($nombreSession, $valorSession) {
        $_SESSION["" . $nombreSession . ""] = $valorSession;
    }

    public function getVariableSession($nombreSession) {
        return $_SESSION["" . $nombreSession . ""];
    }

    public function destruirSession() {
        session_destroy();
    }

    public function liberarVariableSession($nombreSession){
        unset($_SESSION["" . $nombreSession . ""]);
    }

    public function getSesionID(){
        return session_id();
    }

}
?>
