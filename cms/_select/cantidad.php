<?php
include("../_util/Datos.php");
$objMysql = new Mysql();
$sql = "SELECT * FROM ".DB_PREFIJO."_menumnt WHERE idcontenedor = '".$_POST['idmenu']."';"; 
$res= $objMysql->ejecutar($sql);
$i=1;

while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?> 
<option value="<?=$i?>"><?=$i?></option> 
<?php
$i=$i+1;
}?> 
<option value="<?=$i?>" selected > <?=$i?></option> 
