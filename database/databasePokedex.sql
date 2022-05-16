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
  KEY `fk_parent__pokemon_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon`
--

LOCK TABLES `pokemon` WRITE;
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` VALUES (5,5,'./image/Charmander.webp','Charmeleon','Charmeleon es un Pokémon de tipo fuego introducido en la primera generación. Es la evolución de Charmander, uno de los Pokémon iniciales de los entrenadores que comienzan su aventura en la región de Kanto.',190,11,4),(6,6,'./image/Charizard.webp','Charizard','Charizard es un Pokémon de tipo fuego/volador, introducido en la primera generación. Es la evolución de Charmeleon y, a partir de la sexta generación, puede megaevolucionar en Mega-Charizard X o en Mega-Charizard Y.',905,17,5),(7,7,'image/Squirtle.webp','Squirtle','Agua',90,5,0),(8,8,'./image/Wartortle.webp','Wartortle','Agua',225,10,7),(42,1,'./image/default.png','prueba','cualquiera',0,0,0),(43,1,'./image/default.png','prueba','cualquiera',0,0,0),(49,10,'./image/Caterpie.webp','Caterpie','Caterpie es un Pokémon de tipo bicho introducido en la primera generación. Es la contraparte de Weedle.',39,3,NULL),(50,11,'./image/Metapod.webp','Metapod','Metapod es un Pokémon de tipo bicho introducido en la primera generación. Es la evolución de Caterpie. Es la contraparte de Kakuna..',99,7,10),(51,12,'./image/Butterfree.webp','Butterfree','Butterfree es un Pokémon tipo bicho/volador introducido en la primera generación. Es la evolución de Metapod. Es la contraparte de Beedrill.',320,11,11),(52,13,'./image/Weedle.webp','Weedle','Weedle es un Pokémon del tipo bicho/veneno introducido en la primera generación. Es la contraparte de Caterpie.',32,3,NULL),(53,14,'./image/Kakuna.webp','Kakuna','Kakuna es un Pokémon tipo bicho/veneno introducido en la primera generación. Es la evolución de Weedle. Es la contraparte de Metapod.',100,6,13),(54,15,'./image/Beedrill.webp','Beedrill','Beedrill es un Pokémon de tipo bicho/veneno introducido en la primera generación. Es la evolución de Kakuna. A partir de Pokémon Rubí Omega y Pokémon Zafiro Alfa puede megaevolucionar en Mega-Beedrill. Es la contraparte de Butterfree.',295,10,14),(55,16,'./image/Pidgey.webp','Pidgey','Pidgey es un Pokémon de tipo normal/volador introducido en la primera generación.',18,3,NULL),(56,17,'./image/Pidgeotto.webp','Pidgeotto','Pidgeotto es un Pokémon introducido en la primera generación. Es de tipo normal/volador. Es la forma evolucionada de Pidgey.',300,11,16),(57,18,'./image/Pidgeot.webp','Pidgeot','Pidgeot es un Pokémon del tipo normal/volador introducido en la primera generación. Es la forma evolucionada de Pidgeotto. A partir de Pokémon Rubí Omega y Pokémon Zafiro Alfa puede megaevolucionar en Mega-Pidgeot.',395,15,17);
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
INSERT INTO `pokemon__pokemon_type` VALUES (5,3),(6,3),(6,4),(7,5),(8,5),(49,6),(50,6),(51,6),(51,4),(52,6),(52,2),(53,6),(53,2),(54,6),(54,2),(55,7),(55,4),(56,7),(56,4),(57,6),(57,2);
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
INSERT INTO `pokemon_type` VALUES (1,'Planta','./image/type/Tipo_planta.webp'),(2,'Veneno','./image/type/Tipo_veneno.webp'),(3,'Fuego','./image/type/Tipo_fuego.webp'),(4,'Volador','./image/type/Tipo_volador.webp'),(5,'Agua','./image/type/Tipo_agua.webp'),(6,'Bicho','./image/type/Tipo_bicho.webp'),(7,'Normal','./image/type/Tipo_normal.webp'),(8,'Electrico','./image/type/Tipo_electrico.webp'),(9,'Hada','./image/type/Tipo_hada.webp'),(10,'Tierra','./image/type/Tipo_tierra.webp'),(11,'Lucha','./image/type/Tipo_lucha.webp'),(12,'Psiquico','./image/type/Tipo_psiquico.webp'),(13,'Roca','./image/type/Tipo_roca.webp'),(14,'Acero','./image/type/Tipo_acero.webp'),(15,'Hielo','./image/type/Tipo_hielo.webp'),(16,'Fantasma','./image/type/Tipo_fantasma.webp'),(17,'Dragon','./image/type/Tipo_dragon.webp');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Sullca','203784',1),(2,'Alumno','alumno',0),(3,'Hash','81dc9bdb52d04dc20036dbd8313ed055',1);
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

-- Dump completed on 2022-05-12  0:36:20

use pokedex;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_pokemon`(
                                   IN p_search     VARCHAR(255)
                               )
BEGIN
select
    p.image_path
     , type.image_path_type
     , p.name
     , type.description
     , p.order_number
     , p.id
     , p.description,
    p.weight,
    p.height,
    p.parent_id
from
    pokemon p
        join
    (
        select
            ppt.pokemon_id
             , GROUP_CONCAT(pt.description) as description
             , GROUP_CONCAT(pt.image_path)  as image_path_type
        from
            pokemon__pokemon_type ppt
                join
            pokemon_type pt
            on
                    pt.id = ppt.pokemon_type_id
        group by
            ppt.pokemon_id
    )
        as type
    on
            type.pokemon_id = p.id
WHERE
        UPPER(p.name) like CONCAT('%',UPPER(COALESCE(p_search,p.name)), '%') OR p.order_number=COALESCE(p_search,p.order_number) OR UPPER(type.description) like CONCAT('%',UPPER(COALESCE(p_search,type.description)), '%');
END$$
DELIMITER ;

