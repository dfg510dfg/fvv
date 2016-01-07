<?php
        include("../_util/Sesion.php");
        $objSesion=new Sesion();
        $username = $objSesion->getVariableSession("username");
        $userid = $objSesion->getVariableSession("userid");
	if ( !isset($username) && !isset($userid) ){
                include("../_util/Mysql.php");
                $objMysql=new Mysql();
                try {
                    $sql = "SELECT usuario,clave,idusuario FROM ".DB_PREFIJO."_usuarios WHERE usuario='".$_POST['login_username']."' && clave='".md5($_POST['login_userpass'])."' LIMIT 0,1";
                            $rs = $objMysql->ejecutar($sql);
                            $num_rows = $rs->rowCount();
                                if ($num_rows==1){
                                        $user = $rs->fetch(PDO::FETCH_ASSOC);
                                        $objSesion->setVariableSession("username", $user['usuario']);
                                        $objSesion->setVariableSession("userid", $user['idusuario']);
                                        echo 1;
                                }
                                else
                                        echo 0;
                } catch (PDOException $exc) {
                    print($exc->__toString());
                    echo 0;
                }		
	}else{
		echo 0;
	}
?>