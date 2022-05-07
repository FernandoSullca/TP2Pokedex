<?php
#session_start();

$usuario = isset( $_POST["user_name"])?$_POST["user_name"] : "";
$pass = isset( $_POST["user_password"])?$_POST["user_password"] : "";

if (validarUsuario($usuario, $pass)){
    #$_SESSION["usuario"] = $usuario;

    header("location:logueado.php");
} else {
    header("location:index.php");
}
exit(1);

function validarUsuario($usuario, $pass){

    $servername = "localhost";
    $username = "root";
    $dbname = "pokedex";
    $password = "20Sullca1";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuario 
        where nameU = '$usuario'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        #-------------------------
        #md5() crea/insert
        #password_verify(); verificar
        return $usuario == $row["nameU"] &&  md5($pass)==$row["passwordU"] ;
        #return $usuario == $row["nameU"] &&  password_verify($pass,$row["passwordU"]) ;
    }

    return false;

}