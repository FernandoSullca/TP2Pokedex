<?php
include_once 'PokemonModel.php';
session_start();
if( !isset($_SESSION["usuario"]) ){
    header("location:index.php");
    exit();
}
// Create connection
$array_ini = parse_ini_file("./configuracion/database.ini");

$conn = mysqli_connect($array_ini["servername"] , $array_ini["username"], $array_ini["password"],$array_ini["dbname"]);
$query = "select * from pokemon_type type";
$result = mysqli_query($conn, $query);
$types =  mysqli_fetch_all($result, MYSQLI_ASSOC);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add'])) {
    try{
        $orderNumber = isset( $_POST["pokemon_number"])?$_POST["pokemon_number"] : null;
        $name = isset( $_POST["pokemon_name"])?$_POST["pokemon_name"] : "";
        $imagePath = isset( $_POST["pokemon_image"])?$_POST["pokemon_image"] : "";
        $description = isset( $_POST["pokemon_description"])?$_POST["pokemon_description"] : "";
        $weight = isset( $_POST["pokemon_weight"])?$_POST["pokemon_weight"] : null;
        $height = isset( $_POST["pokemon_height"])?$_POST["pokemon_height"] : null;
        $parent = isset( $_POST["pokemon_parent"])?$_POST["pokemon_parent"] : null;
        $typeList=array();
        $typeList[]   = isset( $_POST["pokemon_type_1"])?$_POST["pokemon_type_1"] : null;
        $typeList[]   = isset( $_POST["pokemon_type_2"])?$_POST["pokemon_type_2"] : null;
        /**Magia para subir la imagen**/
        $fileOrig=isset( $_FILES["pokemon_image"]["tmp_name"])?$_FILES["pokemon_image"]["tmp_name"]:null;

        if($fileOrig!=null) {
            $filePath = "./image/" . $_FILES["pokemon_image"]["name"];
            $imagePath = $filePath;

            move_uploaded_file($fileOrig, $filePath);
        }
        else
        {
            $imagePath="./image/default.png";
        }
        $pokemon = new PokemonModel(null, $orderNumber,$name,$imagePath, $description, $weight, $height, $parent, $typeList);
        $pokemon->add($conn);
        mysqli_close($conn);
        header("location:logueado.php");
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
}
if (isset($_POST['modify'])) {
    try{
        $id = isset( $_POST["pokemon_id"])?$_POST["pokemon_id"] : null;
        $orderNumber = isset( $_POST["pokemon_number"])?$_POST["pokemon_number"] : null;
        $name = isset( $_POST["pokemon_name"])?$_POST["pokemon_name"] : "";
        $imagePath = isset( $_POST["pokemon_image"])?$_POST["pokemon_image"] : "";
        $description = isset( $_POST["pokemon_description"])?$_POST["pokemon_description"] : "";
        $weight = isset( $_POST["pokemon_weight"])?$_POST["pokemon_weight"] : null;
        $height = isset( $_POST["pokemon_height"])?$_POST["pokemon_height"] : null;
        $parent = isset( $_POST["pokemon_parent"])?$_POST["pokemon_parent"] : null;
        $pokemon = new PokemonModel($id, $orderNumber,$name,$imagePath, $description, $weight, $height, $parent, 1);
        $pokemon->modify($conn);
        mysqli_close($conn);
    } catch (Exception $e)
    {
        die($e->getMessage());
    }
}

if (isset($_POST['delete'])) {
    try{
        $id = isset( $_POST["pokemon_id"])?$_POST["pokemon_id"] : null;
        $orderNumber = isset( $_POST["pokemon_number"])?$_POST["pokemon_number"] : null;
        $name = isset( $_POST["pokemon_name"])?$_POST["pokemon_name"] : "";
        $imagePath = isset( $_POST["pokemon_image"])?$_POST["pokemon_image"] : "";
        $description = isset( $_POST["pokemon_description"])?$_POST["pokemon_description"] : "";
        $weight = isset( $_POST["pokemon_weight"])?$_POST["pokemon_weight"] : null;
        $height = isset( $_POST["pokemon_height"])?$_POST["pokemon_height"] : null;
        $parent = isset( $_POST["pokemon_parent"])?$_POST["pokemon_parent"] : null;
        $pokemon = new PokemonModel($id, $orderNumber,$name,$imagePath, $description, $weight, $height, $parent, 1);
        $pokemon->delete($conn);
        mysqli_close($conn);
    } catch (Exception $e)
    {
        die($e->getMessage());
    }
}

if (isset($_POST['cancelar'])) {

    try{
        header("location:logueado.php");
        mysqli_close($conn);

    } catch (Exception $e)
    {
        die($e->getMessage());
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/style-master.css">
    <title>TP Pokedex-Agregar Pokemon</title>

</head>
<body>
<header>
    <!--<div class="w3-container w3-teal">-->
        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1 >Pokedex</h1>
    <!--</div>-->
    <h1 id="user_name">Usuario: <?php echo $_SESSION["usuario"]?> </h1>

</header>

<form action="login.php" method="post" id="buscador">
    <!--<label for="name">Nombre</label>-->
    <input type="text" id="pokemon" name="pokemon_name" placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quien es este pokémon?</button>
</form>

<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="form-add">
<form enctype="multipart/form-data" method="post" class="addform">

    <label for="pokemon_number">Numero</label>
    <input type="text" id="pokemon_number" name="pokemon_number"><br><br>

    <?php
    if (count($types)>0)
    {
    echo 'Tipo 1: <select name="pokemon_type_1">
        <option value=" " selected="selected">Seleccionar</option>';
        foreach($types as $type)
        {
        echo '<option value="'.$type['id'].'">'.$type['description'].'</option>';
        }
        echo '</select><br><br>';
    echo 'Tipo 2: <select name="pokemon_type_2">
        <option value=" " selected="selected">Seleccionar</option>';
        foreach($types as $type)
        {
        echo '<option value="'.$type['id'].'">'.$type['description'].'</option>';
        }
        echo '</select>';
    }
    ?>
    <br><br><label for="pokemon_name">Nombre</label>
    <input type="text" id="pokemon_name" name="pokemon_name"><br><br>

    <label for="imagePath">Imagen</label>
    <input type="FILE" id="pokemon_image" accept="image/*" name="pokemon_image"><br><br>

    <label for="pokemon_description">Descripcion</label>
    <input type="text" id="pokemon_description" name="pokemon_description"><br><br>

    <label for="pokemon_weight">Peso</label>
    <input type="number" id="pokemon_weight" name="pokemon_weight"><br><br>

    <label for="pokemon_height">Altura</label>
    <input type="number" id="pokemon_height" name="pokemon_height"><br><br>

    <label for="pokemon_parent">Origen</label>
    <input type="text" id="pokemon_parent" name="pokemon_parent"><br><br>

    <input  type="submit" name="add"  id="add" value="Agregar">
    <input  type="submit" name="cancelar"  id="cancelar" value="Cancelar">
</form>
</div>

</body>

<footer>

</footer>

</html>