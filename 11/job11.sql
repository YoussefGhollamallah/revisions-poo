-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: draft_shop
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Animaux','Catégorie pour les produits liés aux animaux','2024-09-01 23:06:54','2024-09-01 23:06:54'),(2,'Électronique','Catégorie pour les produits électroniques','2024-09-01 23:06:54','2024-09-01 23:06:54'),(3,'fruits','Catégorie pour les produits liés aux fruits','2024-09-01 21:14:55','2024-09-01 21:14:55'),(4,'Legumes','Catégorie pour les produits légume','2024-09-01 21:14:55','2024-09-01 21:14:55');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clothing`
--

DROP TABLE IF EXISTS `clothing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clothing` (
  `product_id` int NOT NULL,
  `size` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `material_fee` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  CONSTRAINT `clothing_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clothing`
--

LOCK TABLES `clothing` WRITE;
/*!40000 ALTER TABLE `clothing` DISABLE KEYS */;
/*!40000 ALTER TABLE `clothing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `electronic`
--

DROP TABLE IF EXISTS `electronic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `electronic` (
  `product_id` int NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warranty_fee` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  CONSTRAINT `electronic_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `electronic`
--

LOCK TABLES `electronic` WRITE;
/*!40000 ALTER TABLE `electronic` DISABLE KEYS */;
/*!40000 ALTER TABLE `electronic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photos` text COLLATE utf8mb4_general_ci,
  `price` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `quantity` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Chien','[\"https://picsum.photos/200/300\"]',1250,'Bébé Labrador',3,'2024-09-01 23:06:54','2024-09-01 23:06:54',1),(2,'Ordinateur','[\"https://picsum.photos/200/300\"]',999,'Ordinateur portable haute performance',5,'2024-09-01 23:06:54','2024-09-01 23:06:54',2),(3,'Fraise','[\"https:\\/\\/picsum.photos\\/200\\/300\"]',1250,'fraise d\'espagne',3,'2024-09-01 21:14:55','2024-09-01 21:14:55',3),(4,'Patate','[\"https:\\/\\/picsum.photos\\/200\\/300\"]',999,'Patate du Maroc',5,'2024-09-01 21:14:55','2024-09-01 21:14:55',4),(5,'poire','[\"https:\\/\\/picsum.photos\\/200\\/300?random=1\"]',2,'a',2,'2024-09-02 11:42:15','2024-09-02 11:42:15',3),(6,'banane','[\"<link href=\\\"https:\\/\\/cdn.jsdelivr.net\\/npm\\/bootstrap@5.0.2\\/dist\\/css\\/bootstrap.min.css\\\" rel=\\\"stylesheet\\\" integrity=\\\"sha384-EVSTQN3\\/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC\\\" crossorigin=\\\"anonymous\\\">\"]',3,'provenance brazil',5,'2024-09-02 12:07:00','2024-09-02 12:07:00',3),(7,'poireau','[\"https:\\/\\/picsum.photos\\/200\\/300?random=1\"]',20,'Le poireau est un légume au goût doux et légèrement sucré, composé d\'une base blanche tendre et de longues feuilles vertes. Il est souvent utilisé en cuisine pour les soupes, les quiches, et les plats braisés.',20,'2024-09-02 14:28:49','2024-09-02 14:28:49',4),(8,'poireau','[\"https:\\/\\/picsum.photos\\/200\\/300?random=1\"]',20,'Le poireau est un légume au goût doux et légèrement sucré, composé d\'une base blanche tendre et de longues feuilles vertes. Il est souvent utilisé en cuisine pour les soupes, les quiches, et les plats braisés.',20,'2024-09-02 14:29:59','2024-09-02 14:29:59',4),(9,'souris','[\"https:\\/\\/picsum.photos\\/200\\/300?random=1\"]',15,'permet de déplacer le curseur sur un desktop',12,'2024-09-02 14:31:00','2024-09-02 14:31:00',2);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-04 11:20:21
