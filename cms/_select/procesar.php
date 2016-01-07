<?php
include("../_util/Datos.php");
$objMysql = new Mysql();
$sql = "SELECT * FROM ".DB_PREFIJO."_menumnt WHERE nivel = '".$_POST['nivel']."';"; 
$res= $objMysql->ejecutar($sql);
?> 
<option value="0" selected>[--Selected--]</option> 
<?php 
while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?> 
<option value="<?=$row['idmenu']?>"><?=$row['campo']?></option> 
<?php }
?> 