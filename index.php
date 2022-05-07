<?php
$servername = "localhost";
$username = "root";
$dbname = "pokedex";
$password = "20Sullca1";

// Create connection
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select p.image_path, type.image_path_type, p.name , type.description, p.order_number, p.id
from pokemon p
join (select ppt.pokemon_id, GROUP_CONCAT(pt.description) as description, GROUP_CONCAT(pt.image_path) as image_path_type
from pokemon__pokemon_type ppt 
join pokemon_type pt on pt.id = ppt.pokemon_type_id
group by ppt.pokemon_id)as type on type.pokemon_id = p.id";
$result = mysqli_query($conn, $sql);

$pokemones = Array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $pokemon = Array();
        $pokemon['image_path'] =  $row["image_path"];
        $pokemon['image_path_type'] =  $row["image_path_type"];
        $pokemon['description'] =  $row["description"];
        $pokemon['order_number'] =  $row["order_number"];
        $pokemon['name'] =  $row["name"];
        $pokemon['id'] =  $row["id"];
        $pokemones[] = $pokemon;
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TP Pokedex-index</title>
</head>
<body>
<header>
    <div class="w3-container w3-teal">
        <img src="./image/pokemon_logo.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon" style="float:left;width:42px;height:42px;">
        <h1 >Pokedex</h1></div>
    <form action="login.php" method="post" id="Ingreso">
        <!--<label for="name">Nombre</label>-->
        <input type="text" id="name" name="user_name" placeholder="Nombre">
        <!-- <label for="surname">Apellido</label>-->
        <input type="text" id="password" name="user_password" placeholder="Password">
        <button type="submit" name="ingresar" >ingresar</button>
    </form>
</header>
<form action="login.php" method="post" id="Busqueda">
    <!--<label for="name">Nombre</label>-->
    <input type="text" id="pokemon" name="pokemon_name" placeholder="Ingrese el Nombre, tipo o numero de pokémon">
    <button type="submit" name="BuscarPokemon" >¿Quine es este pokémon?</button>
</form>


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- The Band Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
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
               <tr>
                    <td><?php echo "<img src =". $pokemons['image_path'].">"; ?></td>
                   <td><?php
                       foreach (explode(',', $pokemons['image_path_type'])as $imagePathType)
                           echo "<img src =". $imagePathType.">" ; ?></td>
                    <td><?php echo $pokemons['order_number']; ?></td>
                    <td><?php echo $pokemons['name']; ?></td>
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