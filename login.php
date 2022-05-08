<?php
include_once("MySqlDatabase.php");
// Analizar sin secciones
$array_ini = parse_ini_file("./configuracion/database.ini");
//print_r($array_ini);
$database= new MySqlDatabase( $array_ini["servername"] , $array_ini["username"], $array_ini["password"],$array_ini["dbname"]);

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


#function validarUsuario($usuario, $pass){

  
/*   $servername = "localhost";
    $username = "root";
    $dbname = "pokedex";
    $password = "Ariel3009";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
   $sql = "SELECT * FROM usuario 
        where nameU = '$usuario'";*/
    
    
   /* if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);

        */
        #-------------------------
        #md5() crea/insert
        #password_verify(); verificar
        #return $usuario == $row["nameU"] &&  md5($pass)==$row["passwordU"] ;
        #return $usuario == $row["nameU"] &&  password_verify($pass,$row["passwordU"]) ;
    #}

    #return false;

#}