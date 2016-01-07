<?php

/*
 * @ comentario
 */

class Utilidades {

    public static function getEdad($fecha_nacimiento, $fecha_control) {
        # PARAMETROS:
        # $fecha_nacimiento - Fecha de nacimiento de una persona.
        #
        # $fecha_control - Fecha actual o fecha a consultar.
        #
        #
        # EJEMPLO:
        # tiempo_transcurrido('22/06/1977', '04/05/2009');
        #
        $fecha_actual = $fecha_control;
        $vFecha = explode("-", $fecha_nacimiento);
        $fecha_nacimiento = $vFecha[2] . "/" . $vFecha[1] . "/" . $vFecha[0];

        if (!strlen($fecha_actual)) {
            $fecha_actual = date('d/m/Y');
        }

        // separamos en partes las fechas
        $array_nacimiento = explode("/", $fecha_nacimiento);
        $array_actual = explode("/", $fecha_actual);

        $anos = $array_actual[2] - $array_nacimiento[2]; // calculamos años
        $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
        $dias = $array_actual[0] - $array_nacimiento[0]; // calculamos días
        //ajuste de posible negativo en $días
        if ($dias < 0) {
            --$meses;

            //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
            switch ($array_actual[1]) {
                case 1:
                    $dias_mes_anterior = 31;
                    break;
                case 2:
                    $dias_mes_anterior = 31;
                    break;
                case 3:

                    if (self::bisiesto($array_actual[2])) {
                        $dias_mes_anterior = 29;
                        break;
                    } else {
                        $dias_mes_anterior = 28;
                        break;
                    }
                case 4:
                    $dias_mes_anterior = 31;
                    break;
                case 5:
                    $dias_mes_anterior = 30;
                    break;
                case 6:
                    $dias_mes_anterior = 31;
                    break;
                case 7:
                    $dias_mes_anterior = 30;
                    break;
                case 8:
                    $dias_mes_anterior = 31;
                    break;
                case 9:
                    $dias_mes_anterior = 31;
                    break;
                case 10:
                    $dias_mes_anterior = 30;
                    break;
                case 11:
                    $dias_mes_anterior = 31;
                    break;
                case 12:
                    $dias_mes_anterior = 30;
                    break;
            }

            $dias = $dias + $dias_mes_anterior;

            if ($dias < 0) {
                --$meses;
                if ($dias == -1) {
                    $dias = 30;
                }
                if ($dias == -2) {
                    $dias = 29;
                }
            }
        }

        //ajuste de posible negativo en $meses
        if ($meses < 0) {
            --$anos;
            $meses = $meses + 12;
        }

        $tiempo[0] = $anos;
        $tiempo[1] = $meses;
        $tiempo[2] = $dias;

        return $tiempo[0] . " años y " . $tiempo[1] . " meses";
    }

    public static function bisiesto($anio_actual) {
        $bisiesto = false;
        //probamos si el mes de febrero del año actual tiene 29 días
        if (checkdate(2, 29, $anio_actual)) {
            $bisiesto = true;
        }
        return $bisiesto;
    }

    public static function getClaveCatpcha($minimo = 3, $maximo = 4) {
        $clave = "";
        $caracteres = "ABCDEFGHIJKLMNOPRSTUVWXYZ";

        for ($i = 0; $i < rand($minimo, $maximo); $i++) {
            $clave .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $clave;
    }

    public static function getFormatoNumero(array $Param) {
        $salida = NULL;
        if (!empty($Param)) {
            $numero = $Param[0];
            $nDecimal = $Param[1];
            $salida = number_format($numero, $nDecimal);
        }
        return $salida;
    }

    public static function getFormatosFecha(array $Param) {
        $salida = NULL;
        if (!empty($Param)) {

            $fecha = $Param[0];
            $vFecha = explode("-", $fecha);
            $salida = $vFecha[2] . "/" . $vFecha[1] . "/" . $vFecha[0];

            if (!strlen($salida)) {
                $salida = date('d/m/Y');
            }
        }
        return $salida;
    }
    
    public static function primeraLetraMayuc(array $Param) { /* convierte la primera letra de cada palabra a MAYUSC  */
        $sCadena = $Param[0];
        $salida = "";
        if(!empty($sCadena)){
            $salida = self::quitarTilde(array($sCadena));
            $salida = ucwords($salida); 
        }
        return $salida;
    }
    
    public static function quitarTilde(array $Param) { /* convierte la primera letra de cada palabra a MAYUSC  */
        $sCadena = $Param[0];
        $salida = "";
        if(!empty($sCadena)){
            $cadBuscar = array("á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú","Ñ","ñ"); 
            $cadPoner = array("a", "A", "e", "E", "i", "I", "o", "O", "u", "U","Ñ","ñ"); 
            $salida = str_replace($cadBuscar, $cadPoner, $sCadena);
        }
        return $salida;
    }
    
    public static function eliminarArchivos(array $Param) {
        $dir = $Param[0];
        if (is_dir($dir)) {
            if ($gd = opendir($dir)) {
                while ($archivo = readdir($gd)) {
                    if($archivo != "." && $archivo != ".."){
                        unlink($dir.$archivo);
                    }
                }
                closedir($gd);
            }
        }
    }

    public static function eliminarArchivo(array $Param) { /* FALTA PROGRAMAR  */
        $sArchivo = $Param[0];
        $sMsg = "";
        if(!empty($sArchivo)){
          if(is_file($sArchivo)){
            unlink($sArchivo);
            return TRUE;
          } else {
              $sMsg = "No es un archivo valido";
          }
        } else {
            $sMsg = "No se ha enviado ningún archivo";
        }
        print($sMsg);
    }
}

?>
