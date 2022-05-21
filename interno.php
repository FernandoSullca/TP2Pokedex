<?php

include_once("MySqlDatabase.php");

$pokeid = isset( $_GET["pokemon"])?$_GET["pokemon"] : "";

$database = new MySqlDatabase();

$pokemones = $database->query("select p.image_path, type.image_path_type, p.name , type.description, p.order_number, p.id,p.description
from pokemon p 
join (select ppt.pokemon_id, GROUP_CONCAT(pt.description) as description, GROUP_CONCAT(pt.image_path) as image_path_type
from pokemon__pokemon_type ppt 
join pokemon_type pt on pt.id = ppt.pokemon_type_id
group by ppt.pokemon_id)as type on type.pokemon_id = p.id 
where p.id=".$pokeid);

/*#var_dump($pokemones);
$fila = mysqli_fetch_row($pokemones);
var_dump($fila);
#$pokemons = mysqli_fetch_array($pokemones);*/
session_start();

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
    <title>TP Pokedex-Resultado de la busqueda(informacion espesifica)</title>
</head>
<body>
<header>

        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1>Pokedex</h1>


</header>
    <div class="contenedor_pokemon">
        <?php
        foreach ( $pokemones as $pokemons){
        ?>
        <tr>
            <td class="imagenPokemon"><?php echo "<img src =". $pokemons['image_path'].">"; ?></td>
            <td><?php
                foreach (explode(',', $pokemons['image_path_type'])as $imagePathType)
                    echo "<img class=nombre-tipo-pokemon src =". $imagePathType.">" ; ?></td>
            <td ><?php echo $pokemons['order_number']; ?></td>
            <td ><p class="descripcion-pokemon"><?php echo $pokemons['description']; ?></p></td>
            <td ><p class="nombre-pokemon"><?php echo $pokemons['name']; ?></p></td>

            <?php
            }
            ?>
        <div class="Imagen-pokemon"  >

        </div>
        <div class="nombre-tipo-pokemon" ></div>
        <div class="descripcion-pokemon"></div>


    </div>
    


<footer>
<form action="index.php" method="post" id="salir">

        <button type="submit" name="salir" >Volver</button>
    </form>
</footer>
</body>
</html>