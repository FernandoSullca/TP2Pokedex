<?php
include_once ("MySqlDatabase.php");

// Analizar sin secciones
$array_ini = parse_ini_file("./configuracion/database.ini");
//print_r($array_ini);

$registrar= new MySqlDatabase( $array_ini["servername"] , $array_ini["username"], $array_ini["password"],$array_ini["dbname"]);

$sql="INSERT INTO `usuario` VALUES (null,'Hash',md5(1234),1);";
$resultado=$registrar->query($sql);
var_dump($resultado);

/*$sql= " select * from usuario";
$resultado=$registrar->query($sql);
var_dump($resultado);*/
exit(1);

