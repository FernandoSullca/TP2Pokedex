<?php
include_once("MySqlDatabase.php");
// Analizar sin secciones

$database= new MySqlDatabase();
$pokemones = $database->callProcedure("sp_get_pokemon", array("p_search"=>""));

session_start();

if( isset($_SESSION["usuario"]) ){
    header("location:logueado.php"); 
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
    <title>TP Pokedex-index</title>
</head>
<body>
<header>

        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1 >Pokedex</h1>
        <form action="login.php" method="post" id="Ingreso">
            <!--<label for="name">Nombre</label>-->
            <input type="text" id="name" name="user_name" placeholder="Nombre">
            <!-- <label for="surname">Apellido</label>-->
            <input type="text" id="password" name="user_password" placeholder="Password">
            <button type="submit" name="ingresar" >ingresar</button>
        </form>


</header>
<form action="busqueda.php" method="GET" id="buscador">
    <!--<label for="name">Nombre</label>-->
    <input type="mixed" id="pokemon" name="pokemon_search" placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quién es este pokémon?</button>
</form>


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- The Pokemon-table Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="poke">
        <h2 class="w3-wide">Info Pokemones</h2>
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
               <tr id="pokeList">
                   <td class="imagenPokemon"><?php echo "<img src =". $pokemons['image_path']." >" ;?></td>
                   <td><?php
                       foreach (explode(',', $pokemons['image_path_type'])as $imagePathType)
                           echo "<img src =".$imagePathType.">" ; ?></td>
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