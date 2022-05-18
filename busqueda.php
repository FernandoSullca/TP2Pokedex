<?php
include_once("MySqlDatabase.php");


$pokebusqueda = isset( $_GET["pokemon_search"])?$_GET["pokemon_search"] : "";

$database = new MySqlDatabase();

$pokemones = $database->query(sprintf("select p.image_path, type.image_path_type, p.name , type.description, p.order_number, p.id,p.description
from pokemon p 
join (select ppt.pokemon_id, GROUP_CONCAT(pt.description) as description, GROUP_CONCAT(pt.image_path) as image_path_type
from pokemon__pokemon_type ppt 
join pokemon_type pt on pt.id = ppt.pokemon_type_id
group by ppt.pokemon_id)as type on type.pokemon_id = p.id
WHERE UPPER(p.name) like CONCAT('%%$pokebusqueda%%') or p.order_number='$pokebusqueda'  or UPPER(type.description) like CONCAT('%%$pokebusqueda%%')"));
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
    <title>TP Pokedex-Busqueda</title>
</head>
<body>
<header>

        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1 >Pokedex</h1>
    <div class="ingresado-salir">
        <?php  if( isset($_SESSION["usuario"]) ){
            echo"<h1 id='user_name'>Usuario: ".$_SESSION["usuario"]."</h1>";

            if (isset($_SESSION["usuario"])) {
                echo "<form action='logout.php' method='post' id='salir'>
 
                <button type='submit' name='salir' >Salir</button>
                </form>";
            }
        }?>
    </div>

        <?php
        if( !isset($_SESSION["usuario"]) ){
    echo " <form action='login.php' method='post' id='Ingreso'>
    
    <input type='text' id='name' name='user_name' placeholder='Nombre'>
    
    <input type='text' id='password' name='user_password' placeholder='Password'>
    <button type='submit' name='ingresar' >ingresar</button>
</form>";
   
}?>
</header>

<form action="#" method="get" id="buscador">
    <input type="text" id="pokemon" name="pokemon_search" placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quién es este pokémon?</button>
</form>        


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- The Pokemon-table-Busqueda Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
        <h2 class="w3-wide">Info Pokemones</h2>
        <?php
        if($pokemones==null){
            echo "<h3>No se encontraron pokemones</h3> ";
            $pokemones = $database->query(sprintf("select p.image_path, type.image_path_type, p.name , type.description, p.order_number, p.id,p.description
from pokemon p 
join (select ppt.pokemon_id, GROUP_CONCAT(pt.description) as description, GROUP_CONCAT(pt.image_path) as image_path_type
from pokemon__pokemon_type ppt 
join pokemon_type pt on pt.id = ppt.pokemon_type_id
group by ppt.pokemon_id)as type on type.pokemon_id = p.id"));
        }
        ?>
        <table class="w3-table">
            <tr>
                <th>Imagen</th>
                <th>tipo</th>
                <th>número</th>
                <th>nombre</th>
            </tr>

            <?php
            foreach ( $pokemones as $pokemons){
            ?>
               <tr>
                    <td class="imagenPokemon"><?php echo "<img src =". $pokemons['image_path'].">"; ?></td>
                   <td><?php
                       foreach (explode(',', $pokemons['image_path_type'])as $imagePathType)
                           echo "<img src =". $imagePathType.">" ; ?></td>
                    <td><?php echo $pokemons['order_number']; ?></td>
                    <td><?php echo "<a href=".'./interno.php?pokemon='.$pokemons['order_number'].">".$pokemons['name']."</a>"; ?></td>
               </tr>
           <?php
            }
            ?>
        </table>
    </div>

    <!-- End Page Content -->
</div>

<footer>

</footer>
</body>
</html>





