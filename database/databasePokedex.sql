-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pokedex
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pokemon`
--

CREATE DATABASE pokedex;
USE pokedex;

DROP TABLE IF EXISTS `pokemon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pokemon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_number` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parent__pokemon_id` (`parent_id`),
  CONSTRAINT `fk_parent__pokemon_id` FOREIGN KEY (`parent_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon`
--

LOCK TABLES `pokemon` WRITE;
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` VALUES (1,1,'./image/Bulbasaur.png','Bulbasaur','Bulbasaur es un Pokémon de tipo planta/veneno introducido en la primera generación. Es uno de los Pokémon iniciales que pueden elegir los entrenadores que empiezan su aventura en la región Kanto, junto a Squirtle y Charmander (excepto en Pokémon Amarillo)',50,50,NULL),(2,2,'./image/Ivysaur.png','Ivysaur','Ivysaur es un Pokémon de tipo planta/veneno introducido en la primera generación. Es la evolución de Bulbasaur, uno de los Pokémon iniciales de Kanto.',130,10,1),(3,3,'./image/Venusaur.png','Venusaur','Venusaur es un Pokémon de tipo planta/veneno introducido en la primera generación. Es la evolución de Ivysaur y, a partir de la sexta generación, puede megaevolucionar en Mega-Venusaur.',1000,20,2),(4,4,'./image/Charmander.webp','Charmander','Charmander es un Pokémon de tipo fuego introducido en la primera generación. Es uno de los Pokémon iniciales que pueden elegir los entrenadores que empiezan su aventura en la región Kanto, junto a Bulbasaur y Squirtle',85,6,NULL),(5,5,'./image/Charmander.webp','Charmeleon','Charmeleon es un Pokémon de tipo fuego introducido en la primera generación. Es la evolución de Charmander, uno de los Pokémon iniciales de los entrenadores que comienzan su aventura en la región de Kanto.',190,11,4),(6,6,'./image/Charizard.webp','Charizard','Charizard es un Pokémon de tipo fuego/volador, introducido en la primera generación. Es la evolución de Charmeleon y, a partir de la sexta generación, puede megaevolucionar en Mega-Charizard X o en Mega-Charizard Y.',905,17,5),(7,7,'./image/Squirtle.webp','Squirtle','Squirtle es un Pokémon de tipo agua introducido en la primera generación. Es uno de los Pokémon iniciales que pueden elegir los entrenadores que empiezan su aventura en la región Kanto, junto a Bulbasaur y Charmander, excepto en Pokémon Amarillo.',90,5,NULL),(8,8,'./image/Wartortle.webp','Wartortle','Wartortle es un Pokémon de tipo agua introducido en la primera generación. Es la forma evolucionada de Squirtle, uno de los Pokémon iniciales de Kanto.',225,10,7),(9,9,'./image/Blastoise.webp','Blastoise','Blastoise es un Pokémon de tipo agua introducido en la primera generación. Es la evolución de Wartortle y, a partir de la sexta generación, puede megaevolucionar en Mega-Blastoise.',855,16,8);
/*!40000 ALTER TABLE `pokemon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pokemon__pokemon_type`
--

DROP TABLE IF EXISTS `pokemon__pokemon_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pokemon__pokemon_type` (
  `pokemon_id` int NOT NULL,
  `pokemon_type_id` int NOT NULL,
  KEY `fk_type__pokemon` (`pokemon_id`),
  KEY `fk_type__pokemon_type` (`pokemon_type_id`),
  CONSTRAINT `fk_type__pokemon` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_type__pokemon_type` FOREIGN KEY (`pokemon_type_id`) REFERENCES `pokemon_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon__pokemon_type`
--

LOCK TABLES `pokemon__pokemon_type` WRITE;
/*!40000 ALTER TABLE `pokemon__pokemon_type` DISABLE KEYS */;
INSERT INTO `pokemon__pokemon_type` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,3),(5,3),(6,3),(6,4),(7,5),(8,5),(9,5);
/*!40000 ALTER TABLE `pokemon__pokemon_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pokemon_type`
--

DROP TABLE IF EXISTS `pokemon_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pokemon_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon_type`
--

LOCK TABLES `pokemon_type` WRITE;
/*!40000 ALTER TABLE `pokemon_type` DISABLE KEYS */;
INSERT INTO `pokemon_type` VALUES (1,'Planta','https://static.wikia.nocookie.net/espokemon/images/d/d6/Tipo_planta.gif/revision/latest/scale-to-width-down/48?cb=20170114100444'),(2,'Veneno','https://static.wikia.nocookie.net/espokemon/images/1/10/Tipo_veneno.gif/revision/latest/scale-to-width-down/48?cb=20170114100535'),(3,'Fuego','https://static.wikia.nocookie.net/espokemon/images/c/ce/Tipo_fuego.gif/revision/latest/scale-to-width-down/48?cb=20170114100331'),(4,'Volador','https://static.wikia.nocookie.net/espokemon/images/1/10/Tipo_veneno.gif/revision/latest/scale-to-width-down/48?cb=20170114100535'),(5,'Agua','https://static.wikia.nocookie.net/espokemon/images/9/94/Tipo_agua.gif/revision/latest/scale-to-width-down/48?cb=20170114100152'),(6,'Bicho','https://static.wikia.nocookie.net/espokemon/images/f/fe/Tipo_bicho.gif/revision/latest/scale-to-width-down/48?cb=20170114100153'),(7,'Normal','https://static.wikia.nocookie.net/espokemon/images/3/32/Tipo_normal.gif/revision/latest/scale-to-width-down/48?cb=20170114100442'),(8,'Electrico','https://static.wikia.nocookie.net/espokemon/images/1/1b/Tipo_el%C3%A9ctrico.gif/revision/latest/scale-to-width-down/48?cb=20170114100155'),(9,'Hada','https://static.wikia.nocookie.net/espokemon/images/b/bc/Tipo_hada.gif/revision/latest/scale-to-width-down/48?cb=20170114100332'),(10,'Tierra','https://static.wikia.nocookie.net/espokemon/images/1/1d/Tipo_tierra.gif/revision/latest/scale-to-width-down/48?cb=20170114100533'),(11,'Lucha','https://static.wikia.nocookie.net/espokemon/images/b/b7/Tipo_lucha.gif/revision/latest/scale-to-width-down/48?cb=20170114100336'),(12,'Psiquico','https://static.wikia.nocookie.net/espokemon/images/1/15/Tipo_ps%C3%ADquico.gif/revision/latest/scale-to-width-down/48?cb=20170114100445'),(13,'Roca','https://static.wikia.nocookie.net/espokemon/images/e/e0/Tipo_roca.gif/revision/latest/scale-to-width-down/48?cb=20170114100446'),(14,'Acero','https://static.wikia.nocookie.net/espokemon/images/d/d9/Tipo_acero.gif/revision/latest/scale-to-width-down/48?cb=20170114100151'),(15,'Hielo','https://static.wikia.nocookie.net/espokemon/images/4/40/Tipo_hielo.gif/revision/latest/scale-to-width-down/48?cb=20170114100333'),(16,'Fantasma','https://static.wikia.nocookie.net/espokemon/images/4/47/Tipo_fantasma.gif/revision/latest/scale-to-width-down/48?cb=20170114100329'),(17,'Dragon','https://static.wikia.nocookie.net/espokemon/images/0/01/Tipo_drag%C3%B3n.gif/revision/latest/scale-to-width-down/48?cb=20170114100154');
/*!40000 ALTER TABLE `pokemon_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idUsuarios` int NOT NULL AUTO_INCREMENT,
  `nameU` varchar(45) NOT NULL,
  `passwordU` varchar(45) NOT NULL,
  `isAdminU` tinyint NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  UNIQUE KEY `idUsuarios_UNIQUE` (`idUsuarios`),
  UNIQUE KEY `nameU_UNIQUE` (`nameU`),
  UNIQUE KEY `passwordU_UNIQUE` (`passwordU`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Sullca','203784',1),(2,'Alumno','alumno',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-04 16:58:14
