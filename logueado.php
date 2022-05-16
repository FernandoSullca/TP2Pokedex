<?php
include_once("MySqlDatabase.php");

$database= new MySqlDatabase();

/*$pokemones = $database->callProcedure("sp_get_pokemon", array("p_search"=>""));*/

/*$pokemones = $database->query("select p.image_path, type.image_path_type, p.name , p.description, p.order_number, p.id, p.weight,p.height, p.parent_id
from pokemon p
join (select ppt.pokemon_id, GROUP_CONCAT(pt.description) as description, GROUP_CONCAT(pt.image_path) as image_path_type
from pokemon__pokemon_type ppt
join pokemon_type pt on pt.id = ppt.pokemon_type_id
group by ppt.pokemon_id)as type on type.pokemon_id = p.id");*/
/*********
Ninguna de las 2 soluciones anteriores funcionan, al parecr al querer eviar el json con la descripcion del pokemon tipo strgin de 250 caracteres el programa (json encode)no lo contiens
Por lo tanto se probo enviar solamente a la descricion del tipo de pokemen en su lugar tipo_pokemon ya que el indice,, es el mismo
 */

$pokemones = $database->query("select p.image_path, type.image_path_type, p.name , type.description, p.order_number, p.id, p.weight,p.height, p.parent_id
from pokemon p
join (select ppt.pokemon_id, GROUP_CONCAT(pt.description) as description, GROUP_CONCAT(pt.image_path) as image_path_type
from pokemon__pokemon_type ppt 
join pokemon_type pt on pt.id = ppt.pokemon_type_id
group by ppt.pokemon_id)as type on type.pokemon_id = p.id");

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
<<<<<<< HEAD
        <h1 >Pokedex</h1></div>
        <h1 > <?php echo $_SESSION["usuario"]?> </h1>
   <form action="logout.php" method="post" id="salir">
=======
        <h1 >Pokedex</h1>
        <h1 id="user_name" > <?php echo "Usuario Admin: ".$_SESSION["usuario"]?> </h1>
        <form action="logout.php" method="post" id="salir">
>>>>>>> 7a555b7a3468c44b87fbfe82fd7a5f51a4ecbf86
        <!-- <input type="text" id="name" name="user_name" placeholder="Nombre">
        <input type="text" id="surname" name="user_surname" placeholder="Apellido">-->
        <button type="submit" name="salir" >Salir</button>
        </form>

</header>
<form action="busqueda.php" method="get" id="Busqueda">
    <!--<label for="name">Nombre</label>-->
    <input type="text" id="pokemon" name="pokemon_search" required placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quien es este pokémon?</button>
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
<<<<<<< HEAD
                    <td><?php
=======
                    <td><?php /*  var_dump( $pokemons);*/
>>>>>>> 7a555b7a3468c44b87fbfe82fd7a5f51a4ecbf86
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
