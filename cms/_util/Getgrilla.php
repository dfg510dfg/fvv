<?php

if(isset($_GET["grid"])) $grid=$_GET["grid"];else $grid=0;
if(isset($_GET["val"])) $val=$_GET["val"]; else $val="";
if(isset($_GET["val2"])) $val2=$_GET["val2"]; else $val2="";
if(isset($_GET["val3"])) $val3=$_GET["val3"]; else $val3="";
$tablaHTML = "";
include("Datos.php");

switch ($grid) {
    case 'horario':
            $tablaHTML = Datos::getGrillaHorario(array($val,$val2,$val3,4));            
        break;

    default:
        break;
}

print($tablaHTML);

?>
<script>
    /*
    $(document).ready(function(){
        var Tabla = document.getElementById("tblHorario");
        var filas = Tabla.rows.length - 1;
        var columnas = Tabla.rows[0].cells.length - 1;
        for(var f=1; f<=filas; f++){
            for(var c=0; c<columnas; c++){
                $("#btnCheck_"+f+"_"+c+"").toggle(
                function () {
                    $(this).css({"background-image":"url(../_img/Checked.png)","cursor":"pointer"});
                },
                function () {
                    $(this).css({"background-image":"url(../_img/Unchecked.png)","cursor":"pointer"});
                }
            );

            }
        }

    });
    */
</script>