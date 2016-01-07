<?

if(isset($_GET["cmb"])) $cmb=$_GET["cmb"];else $cmb=0;
if(isset($_GET["val"])) $val=$_GET["val"]; else $val="";
if(isset($_GET["val2"])) $val2=$_GET["val2"]; else $val2="";
if(isset($_GET["val3"])) $val3=$_GET["val3"]; else $val3="";
/* valor pre-seleccionado */
$valorPorDefecto = $val3;
include("Datos.php");
$html = "";
    switch($cmb){
         case 'provincia':
                $html .= "<select name=\"cmbProvincia\" id=\"cmbProvincia\" title=\"Seleccionar Provincia\" onchange=\"getCombo('../_util/Getcombo.php','distrito',document.getElementById('cmbDepartamento').value,this.value,0,'comboAjaxDistrito')\">";
                $html .= "<option value=\"vacio\" selected>[--Seleccionar--]</option>";
                $html .= Datos::getCombo("provincia",array($val,''),$valorPorDefecto);
                $html .= "</select>";
             break;

         case 'distrito':
                $html .= "<select name=\"cmbDistrito\" id=\"cmbDistrito\" title=\"Seleccionar Distrito\">";
                $html .= "<option value=\"vacio\" selected>[--Seleccionar--]</option>";
                $html .= Datos::getCombo("distrito",array($val,$val2),$valorPorDefecto);
                $html .= "</select>";
             break;
         case 'programa':
                $html .= "<select name=\"cmbPrograma\" id=\"cmbPrograma\" onchange=\"retirarError(this); getCombo('../_util/Getcombo.php','nsesiones',this.value,0,0,'comboAjaxNsesiones'); getCombo('../_util/Getcombo.php','horario',this.value,0,0,'comboAjaxHorario');\" title=\"Seleccionar Programa\">";
                $html .= "<option value=\"vacio\" selected>[--Seleccionar--]</option>";
                $html .= Datos::getCombo("programa",array($val,$val2),$valorPorDefecto);
                $html .= "</select>";
             break;
         case 'nsesiones':
                $html .= "<select name=\"cmbNsesiones\" id=\"cmbNsesiones\" onchange=\"retirarError(this); getCombo('../_util/Getcombo.php','costoSesion',this.value,0,0,'datoAjaxCosto');\" title=\"Seleccionar número de sesiones\">";
                $html .= "<option value=\"vacio\" selected>[--Seleccionar--]</option>";
                $html .= Datos::getCombo("nsesiones",array($val,$val2),$valorPorDefecto);
                $html .= "</select>";
             break;
         case 'horario':
                $html .= "<select name=\"cmbHorario\" id=\"cmbHorario\" title=\"Seleccionar horario\" onchange=\"retirarError(this); getContenido('../_util/Getgrilla.php','horario',this.value,0,0,'grillaAjaxHorario');\">";
                $html .= "<option value=\"vacio\" selected>[--Seleccionar--]</option>";
                $html .= Datos::getCombo("horario",array($val,$val2),$valorPorDefecto);
                $html .= "</select>";
             break;
         case "costoSesion":
                $vFila = Datos::getCombo("costoSesion",array($val,$val2),$valorPorDefecto);
                $html .= $vFila[0];
             break;
         

         

         

    }

print($html);


?>