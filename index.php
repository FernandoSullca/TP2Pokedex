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

$sql = "SELECT * FROM pokemon";
$result = mysqli_query($conn, $sql);

$pokemones = Array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $pokemon = Array();
        $pokemon['image_path'] =  $row["image_path"];
        $pokemon['id'] =  $row["id"];
        $pokemon['order_number'] =  $row["order_number"];
        $pokemon['name'] =  $row["name"];
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
        <img src="/image/pokemon-ge1bca3c56_1280.png" id="logoPokemonHeader" class="w3-margin-right" alt="logo pokemon">
        <h1 >Pokedex</h1></div>
    <form action="" method="post" id="Ingreso">
        <!--<label for="name">Nombre</label>-->
        <input type="text" id="name" name="user_name" placeholder="Nombre">
        <!-- <label for="surname">Apellido</label>-->
        <input type="text" id="surname" name="user_surname" placeholder="Apellido">
        <button type="submit" name="ingresar" >ingresar</button>
    </form>
</header>
<form action="" method="post" id="Busqueda">
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
                echo   "<tr> 
                               
                                <td>  <img src=". $pokemons['image_path'] . "> </td>
                                <td>" . $pokemons['id'] . "</td>
                                <td>" . $pokemons['order_number'] . "</td>
                                <td>" . $pokemons['name'] . "</td>
                             
                            </tr>";
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