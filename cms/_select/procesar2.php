<?php
include("../_util/Datos.php");
$objMysql = new Mysql();
$sql = "SELECT * FROM ".DB_PREFIJO."_directorio WHERE nivel = '".$_POST['nivel']."';"; 
$res= $objMysql->ejecutar($sql);
if($_POST['nivel']<1){?> 
    <option value="0">[--Selected--]</option> 
<?php }
while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?> 
<option value="<?=$row['iddirectorio']?>"><?=$row['campo']?></option> 
<?php }
?> 