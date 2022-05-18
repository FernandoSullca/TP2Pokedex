<?php
include_once ("MySqlDatabase.php");

$database= new MySqlDatabase();

$sql="INSERT INTO `usuario` VALUES (null,'Hash',md5(1234),1);";
$database->query($sql);
//$resultado=$database->query($sql);
//var_dump($resultado);

/*$sql= " select * from usuario";
$resultado=$database->query($sql);
var_dump($resultado);*/
exit(1);

