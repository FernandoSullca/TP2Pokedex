<?php
include_once("MySqlDatabase.php");

$database= new MySqlDatabase();
$pokemones = $database->callProcedure("sp_get_pokemon", array("p_search"=>""));
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
    <title>TP Pokedex-Usuario ADMIN logueado</title>
</head>
<body>
<header>

        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1 >Pokedex</h1></div>
        <h1 id="user_name" > <?php echo "Usuario Admin: ".$_SESSION["usuario"]?> </h1>
        <form action="logout.php" method="post" id="salir">
        <!-- <input type="text" id="name" name="user_name" placeholder="Nombre">
        <input type="text" id="surname" name="user_surname" placeholder="Apellido">-->
        <button type="submit" name="salir" >Salir</button>
        </form>

</header>
<form action="busqueda.php" method="get" id="Busqueda">
    <!--<label for="name">Nombre</label>-->
    <input type="text" id="pokemon" name="pokemon_search" required placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quine es este pokémon?</button>
</form>


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- The Pokemon-Table-opciones Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="poke">
        <h2 class="w3-wide">Info Pokemones</h2>
        <table class="w3-table">
            <tr>
                <th>Imagen</th>
                <th>tipo</th>
                <th>número</th>
                <th>nombre</th>
                <th>acciones</th>
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
                    <td><?php echo "<a href=".'./interno.php?pokemon='.$pokemons['id'].">".$pokemons['name']."</a>"; ?></td>
                    <td><form enctype="multipart/form-data" action="modifyPokemon.php" method="post">
                            <input type="hidden" name="pokemon" value=<?php  echo json_encode($pokemons); ?>>
                            <input type=submit name="modifyPokemon" value="Modificar">
                        </form>
                    </td>
                    <td><form enctype="multipart/form-data" action="deletePokemon.php" method="post">
                            <input type="hidden" name="pokemon" value=<?php  echo json_encode($pokemons); ?>>
                            <input type=submit name="deletePokemon" value="eliminar">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <form enctype="multipart/form-data" action="addPokemon.php" method="post">
            <input class="nuevoPokemon" type=submit value="Nuevo Pokemon">
        </form>
    </div>

    <!-- End Page Content -->
</div>
<footer>

</footer>
</body>
</html>
