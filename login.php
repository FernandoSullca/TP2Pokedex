<?php
#session_start();

$usuario = isset( $_POST["user_name"])?$_POST["user_name"] : "";
$pass = isset( $_POST["user_password"])?$_POST["user_password"] : "";

if ( validarUsuario($usuario, $pass) == TRUE){
    #$_SESSION["usuario"] = $usuario;
    header("location:logueado.php");
    exit();
} else {
    header("location:index.php");
    exit();
}

function validarUsuario($usuario, $pass){
    return $usuario == "administrador" && $pass == "1234";
}