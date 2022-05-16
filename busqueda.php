<?php
include_once("MySqlDatabase.php");

$invalid_pokemon=false;
$search = is_null ( $_GET["pokemon_search"])?"":$_GET["pokemon_search"];
$database = new MySqlDatabase();
$pokemones = $database->callProcedure("sp_get_pokemon", array("p_search"=>$search));
session_start();
if(!$pokemones)
{
    $database = new MySqlDatabase();
    $pokemones = $database->callProcedure("sp_get_pokemon", array("p_search"=>""));
    $invalid_pokemon=true;
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
    <title>TP Pokedex-Busqueda</title>
</head>
<body>
<header>
    <div class="w3-container w3-teal contenedor">
        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1>Pokedex</h1>
       <?php  if( isset($_SESSION["usuario"]) ){
            echo   "<h1 > Usuario Admin: ".$_SESSION["usuario"]."</h1>
                    <form action='logout.php' method='post' id='salir'>
                    <button type='submit' name='salir' >Salir</button>
                    </form>";}?>
        <?php
        if( !isset($_SESSION["usuario"]) ){
    echo " <form action='login.php' method='post' id='Ingreso'>
    
    <input type='text' id='name' name='user_name' placeholder='Nombre'>
    
    <input type='text' id='password' name='user_password' placeholder='Password'>
    <button type='submit' name='ingresar' >ingresar</button>
</form>";
}?></div>

</header>

<form action="#" method="get" id="Busqueda">
    <!--<label for="name">Nombre</label>-->
    <input type="mixed" id="pokemon" name="pokemon_search" placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quién es este pokémon?</button>
</form>        


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- The Pokemon-table-Busqueda Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
        <h2 class="w3-wide">Info Pokemones</h2>
        <?php
        if($invalid_pokemon){
            echo "<h3>Pokemon no encontrado</h3> ";
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
            foreach ($pokemones as $pokemons){
            ?>
               <tr>
                    <td><?php echo "<img src =". $pokemons['image_path'].">"; ?></td>
                   <td><?php
                       foreach (explode(',', $pokemons['image_path_type'])as $imagePathType)
                           echo "<img src =". $imagePathType.">" ; ?></td>
                    <td><?php echo $pokemons['order_number']; ?></td>
                    <td><?php echo "<a href=".'./interno.php?pokemon='.$pokemons['id'].">".$pokemons['name']."</a>"; ?></td>
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





