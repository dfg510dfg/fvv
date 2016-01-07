<?php

$tablaHTML = "";


switch ($grid) {
    case 'horario':
        
            $tablaHTML = Datos::getGrillaHorario(array($val,$val2,$val3,4));
            
        break;

    default:
        break;
}
//
print($tablaHTML);

?>
