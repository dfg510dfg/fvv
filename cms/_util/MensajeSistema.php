<?php

class MensajeSistema {
    

    public static function getMensajeSistema(array $param){
        $msg = NULL;
        if(count($param)>0){
            $codigo = $param[0]; // codigo del mensaje
            $datos = ($param[1])?$param[1]:"";
            switch($codigo){
                case 1: /* login */
                    $msg = "Por favor, vuelve a introducir tu contraseña.<br/><br/> La contraseña no es válida.";
                    break;
                case 2: /* login */
                    $msg = "Usted esta intentando acceder de forma ilegal.<br/>al sistema <br/><br/><br/> su IP será bloqueado al segundo intento..!!!.";
                    break;
                case 3: /* login */
                    $msg = "Usted esta intentando acceder de forma ilegal.<br/>al sistema <br/><br/><br/> su IP será bloqueado al segundo intento..!!!.";
                    break;
                case 4: /* */
                    $msg = "Los datos de acceso son incorrectos <br> el descuento no procede. <br><br> Vuelva a intentarlo";
                    break;
                case 5: /* */
                    $msg = "Ocurrió un problema al intentar <br> registrar los datos <br> Vuelva a intentarlo";
                    break;
                case 6: /* */
                    $msg = "Los datos se grabaron satisfactoriamente";
                    break;
            }
        }

        return $msg;
    }

}
?>
