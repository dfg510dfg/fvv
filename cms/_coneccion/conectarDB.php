<?php
function conectarDB(){
	include("../_config/Configuracion.php");
	include("Conexion.php");
        
            $objCn = new Conexion(SERVIDOR,USUARIO_BD,CLAVE_BD,BASE_DATOS); //local
            $cn = $objCn->getConexion();
            return $cn;
        
}

?>