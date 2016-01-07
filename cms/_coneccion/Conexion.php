<?php

class Conexion {

    private $cn;
    private $db;
    private $server;
    private $user;
    private $password;
    private $dataBase;

    function __construct($server, $user, $password, $dataBase) {
        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->dataBase = $dataBase;
    }

    public function getConexion() {
        $this->cn = NULL;
        try {
            //$this->cn = @mysql_connect($this->server,$this->user,$this->password);
            $cn = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->dataBase . "", $this->user, $this->password);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->cn = $cn;
            //$this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (!$this->cn) {
                $this->cn = "<div class=\"error\"><b>Error de conecci&oacute;n :</b> " . mysql_error() . "</div>";
            }
            //else {
                //$this->db = @mysql_select_db($this->dataBase, $this->cn);
                //if (!$this->db) {
                 //   $this->cn = "<div class=\"error\"><b>Error de conecci&oacute;n : </b> " . mysql_error() . "</div>";
                //}
            //}
        } catch (PDOException $e) {
          echo  $this->cn = $e->__toString();
        }
        return $this->cn;
    }

}

?>
