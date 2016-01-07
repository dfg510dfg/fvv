<?
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
include("../_util/Mysql.php");
$objMysql = new Mysql();

$query="SELECT *,a.idmenu as 'codigo',
                            case a.nivel
                                when '1' then concat(cast(posicion as char(10)))
                                when '2' then concat(cast((select b.posicion from cms_menumnt b where b.idmenu=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                                when '3' then concat(cast((select c.posicion from cms_menumnt c where c.idmenu=(select b.idcontenedor from cms_menumnt b where b.idmenu=a.idcontenedor))as char(10)),'.',cast((select b.posicion from cms_menumnt b where b.idmenu=a.idcontenedor)as char(10)),'.',cast(a.posicion as char(10)))
                            end as lista,a.campo as 'nombre',IF(a.eliminado=0,'ACTIVO','ELIMINADO') AS 'estado' FROM cms_menumnt a 
                                                            where a.eliminado<>1   
                                                            order by lista;";
$datos = $objMysql->ejecutar($query);
$nivel=1;
$ruta="";
$abrir="";
$pos=0;
$html='<ul id="menu'.$nivel.'">';
while ($cant=$datos->fetch(PDO::FETCH_ASSOC)){
    $ruta="";
    $abrir="";
    if($nivel==$cant["nivel"]){
        $pos=$cant["posicion"];
    }else{
        if(($nivel+1)==$cant["nivel"]){
            $html.='<ul id="menu'.$cant["nivel"].$cant["lista"].'">';
            $nivel=$cant["nivel"];
        }else{
            if(($nivel-2)==$cant["nivel"]){
                $html.='</ul>';
            }
            $html.='</ul>';
            $nivel=$cant["nivel"];
        }
    }
    $html.='<li>';
    switch($cant["contenido"]){
        case 1 : $ruta="#";break;
        case 2 : $ruta='http://localhost/optisait.com.pe/optisait/'.$cant["idpaginaweb"].'/';break;
        case 3 : $ruta=$cant["ruta"];break;
    }
    switch($cant["abrir"]){
        case 1 :    $abrir=" target=\"_self\" ";break;
        case 2 :    $abrir=" target=\"_blank\" ";break;
        case 3 :    $ruta="javascript:void(0)\" onclick=\"window.open('".$ruta."','hola','height=500,width=800,"
                . "scrollbars=yes,resizable=yes,directories=yes,menubar=yes,toolbar=yes')";break;
    }
    $html.='<a '.$abrir.' href="'.$ruta.'">'.$cant["nombre"].' </a> </li>';
}
$html.='</ul>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MENU DE OPCIONES</title>
    </head>
    <body>
<!--        <ul>
            <li>
                <a href="javascript:window.open('".$ruta."','hola','height=500,width=800')"></a>
            </li>
            
        </ul>-->
        <?=$html?>    
    </body>
</html>