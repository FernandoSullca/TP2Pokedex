<?php
include_once("MySqlDatabase.php");
$database= new MySqlDatabase();
session_start();

$usuario = isset( $_POST["user_name"])?$_POST["user_name"] : "";
$pass = isset( $_POST["user_password"])?$_POST["user_password"] : "";
$hashpasss=md5($pass);
$result = $database->query("SELECT * FROM usuario 
where nameU = '$usuario' AND passwordU = '$hashpasss'");

if (!$result){
    header("location:index.php");
    exit();
} else {
    header("location:logueado.php");
    $_SESSION["usuario"] = $usuario;
}

?>