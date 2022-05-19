<?php
include_once 'PokemonModel.php';
include_once("MySqlDatabase.php");


if (isset($_POST['pokemon_id'])) {

    try{
        // Create connextion Logueado->Eliminar
        $database = new MySqlDatabase();
        $queryType = "select * from pokemon_type type";
        $types =  $database->query($queryType);
        $pokemonID = isset($_POST["pokemon_id"]) ? ($_POST["pokemon_id"]) : "";
        $pokemonElegido = $database->uniqueResult(sprintf(
            "select p.image_path, p.name , type.type_id, p.order_number, p.id,p.description,
                p.weight,p.height,p.parent_id
        from pokemon p 
        join (select ppt.pokemon_id, GROUP_CONCAT(pt.id) as type_id
        from pokemon__pokemon_type ppt 
        join pokemon_type pt on pt.id = ppt.pokemon_type_id
        group by ppt.pokemon_id)as type on type.pokemon_id = p.id
        WHERE p.id = $pokemonID"));
    } catch (Exception $e)
    {
        die($e->getMessage());
    }
}

if (isset($_POST['delete'])) {
    try{
// Create connection
        $array_ini = parse_ini_file("./configuracion/database.ini");
        $conn = mysqli_connect($array_ini["servername"] , $array_ini["username"], $array_ini["password"],$array_ini["dbname"]);
// Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

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
        header("location:logueado.php");
    } catch (Exception $e)
    {
        die($e->getMessage());
    }
}

if (isset($_POST['cancelar'])) {

    try{
        header("location:logueado.php");
        /*mysqli_close($conn);*/

    } catch (Exception $e)
    {
        die($e->getMessage());
    }
}

session_start();
if( !isset($_SESSION["usuario"]) ){
    header("location:index.php");
    exit();
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
    <title>TP Pokedex- Eliminar Pokemon Selecionado</title>
</head>
<body>
<header>

        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1 >Pokedex</h1>
    <h1 id="user_name">Usuario: <?php echo $_SESSION["usuario"]?> </h1>
</header>

<form action="busqueda.php" method="post" id="buscador">
    <!--<label for="name">Nombre</label>-->
    <input type="text" id="pokemon" name="pokemon_name" placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quien es este pokémon?</button>
</form>

<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="form-add">
    <h2>Esta en la seccion de Eliminacion</h2>
    <h3>Esta Seguro de eliminar al siguiente pokemon?</h3>
<form  enctype="multipart/form-data"  method="post" class="deleteform">

    <input type="hidden" name="pokemon_id" value="<?php echo $pokemonElegido['id']; ?>">

    <label for="pokemon_number">Numero</label>
    <input type="text" id="pokemon_number" name="pokemon_number" value="<?php echo $pokemonElegido['order_number']; ?>"><br><br>

    <label for="pokemon_name">Nombre</label>
    <input type="text" id="pokemon_name" name="pokemon_name" value="<?php echo $pokemonElegido['name']; ?>"><br><br>

    <?php
    $pokeTypes= array();
    if (count($types)>0)
    {   $index=0;
        foreach (explode(',', $pokemonElegido['type_id'])as $typeID) {
            $index=$index+1;
            $name= "pokemon_type_".$index;
            $pokeTypes[$name]=$typeID;
        }
        echo 'Tipo 1: <select name="pokemon_type_1">
        <option value=" " selected="selected">Seleccionar</option>';
        foreach($types as $selection)
        {
            $selected1= ($pokeTypes['pokemon_type_1'] == $selection['id']) ? "selected" : "";
            echo '<option ' . $selected1 . ' value="' . $selection['id']. '">' . $selection['description'] . '</option>';
        }
        echo '</select><br><br>';
        echo 'Tipo 2: <select name="pokemon_type_2">
        <option value=" " selected="selected">Seleccionar</option>';
        foreach($types as $selection)
        {
            $selected2 = ($pokeTypes['pokemon_type_2'] == $selection['id']) ? "selected" : "";
            echo '<option ' . $selected2 . ' value="' . $selection['id']. '">' . $selection['description'] . '</option>';
        }
        echo '</select><br><br>';

    }
    ?>
    <label for="imagePath">Imagen</label>
    <img src ="<?php echo $pokemonElegido['image_path']; ?>" width="50px"><br>
    <input type="text" id="pokemon_image" accept="image/*" name="pokemon_image" value="<?php echo $pokemonElegido['image_path']; ?>"><br><br>

    <label for="pokemon_description">Descripcion</label>
    <input type="text" id="pokemon_description" name="pokemon_description" value="<?php echo $pokemonElegido['description']; ?>"><br><br>

    <label for="pokemon_weight">Peso</label>
    <input type="number" id="pokemon_weight" name="pokemon_weight" value="<?php echo $pokemonElegido['weight']; ?>"><br><br>

    <label for="pokemon_height">Altura</label>
    <input type="number" id="pokemon_height" name="pokemon_height" value="<?php echo $pokemonElegido['height']; ?>"><br><br>

    <label for="pokemon_parent">Origen</label>
    <input type="text" id="pokemon_parent" name="pokemon_parent" value="<?php echo $pokemonElegido['parent_id']; ?>"><br><br>

    <input  type="submit" name="delete"  id="delete" value="delete">
    <input  type="submit" name="cancelar"  id="cancelar" value="Cancelar">
</form>
</div>

</body>

<footer>

</footer>

</html>