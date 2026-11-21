
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
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Kitchen Appliances','kitchen-appliances',NULL,'2026-04-10 08:41:27','2026-05-30 21:24:25'),(2,'Cookware And Tools','cookware-and-tools',NULL,'2026-04-10 08:41:23','2026-05-30 21:25:08'),(3,'Electronics','electronics',NULL,'2026-04-10 08:41:05','2026-05-30 21:26:47'),(4,'Smart Home','smart-home',NULL,'2026-04-10 08:41:42','2026-05-30 21:28:44'),(5,'Accessories','accessories',NULL,'2026-04-10 08:42:03','2026-05-30 21:29:13');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'bằng','<p>is that true ?</p>',17,'2026-03-28 04:56:50','2026-06-11 08:42:14'),(2,'trường','good new post',2,NULL,'2026-04-08 10:58:50'),(3,'minh tuấn ','excellent news',2,NULL,'2026-04-02 15:51:27'),(4,'lap trinh ','123',2,'2026-04-02 10:03:13',NULL),(10,'huy','123',6,'2026-04-03 00:43:27',NULL),(11,'ok','1234',NULL,'2026-04-09 01:46:28','2026-04-09 02:00:32'),(12,'trang','cần chi tiết hơn',6,'2026-04-14 06:50:02',NULL),(13,'thành','<p>good</p>',7,'2026-06-11 08:16:26',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `discount_price` int DEFAULT NULL,
  `discount_type` int DEFAULT '1',
  `status` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `expired` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (2,'Graduation','ECOM-1XEII',10,1,1,'2026-07-03 02:55:23',NULL,'2026-07-18'),(3,'winter','ECOM-L2JW9',5,1,0,'2026-07-03 03:10:25',NULL,'2026-07-30'),(4,'1','ECOM-DAQCJ',8,1,0,'2026-07-03 03:11:33',NULL,'2026-07-25'),(5,'10','ECOM-X7HG6',5,1,0,'2026-07-03 03:41:58',NULL,'2026-08-18'),(6,'15','ECOM-ovjZh',10,2,1,'2026-07-03 04:13:02',NULL,'2026-07-29');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_order_id` int DEFAULT '1',
  `quantity` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,5,1,1,130,'2026-06-15 09:02:06'),(2,4,1,3,70,'2026-06-15 09:02:06'),(3,3,2,3,100,'2026-07-17 02:24:55'),(4,4,2,1,70,'2026-07-17 02:24:55');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tags` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int NOT NULL,
  `minutes_read` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shares` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (6,'Bài viết số 2','ngừng bắn 2 tuần tại trung đông','39',1,'23','67514','233','4667','2026-04-10 16:13:32','2026-04-10 16:13:32'),(7,'bài viết số 3','giải quyết vấn đề unf tắc đường giao thồn tại giờ cao điểm ở một số khu vực','435',1,'435','7655','23','54','2026-04-10 16:13:23','2026-04-10 16:13:23'),(11,'bài viết số 4','bánh mì thịt heo được đánh giá là mon ăn ngon thứ 2 tại Đông Nam Á ','432',1,'42','659','32','34','2026-04-10 16:13:18','2026-04-10 16:13:18'),(12,'bài viết sô 5','chiến sự tại trung đông','2332',1,'32422','42','44534','435','2026-04-10 16:13:15','2026-04-10 16:13:15'),(13,'bài viết sô 6','giá xăng biến động','3423245546',1,'566543','375','635','664','2026-04-10 16:13:10','2026-04-10 16:13:10'),(14,'bài viết sô 7','di cư dân số ra ngoại thành','755',1,'456','648','6543','75656','2026-04-10 16:13:04','2026-04-10 16:13:06'),(15,'bài viết số 8','kỉ nguyên AI','4555',4,'564','23466','655','33','2026-04-10 16:13:02','2026-04-10 16:13:02'),(16,'bài viết sô 9','có thể sẽ tăng thuê','56234',4,'4356','124','575','345','2026-04-10 16:12:55','2026-04-10 16:12:59'),(17,'bài viết sô 10','giá vàng lao dốc','356',5,'4356','4680','33','466','2026-04-10 16:12:57','2026-04-10 16:12:53'),(18,'bài viết sô 11','Việt Nam bị ảnh hưởng gì với tình hình hiện tại','45',5,'634322','4635634','6554','563','2026-04-10 16:12:50','2026-04-10 16:12:50'),(19,'bài viết số 1','kết quả 2 lượt trận còn lại tại Champions Luague: diễn biến bất ngờ',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rating` tinyint DEFAULT '5',
  `discount_price` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `available` int DEFAULT NULL,
  `sold` int DEFAULT NULL,
  `is_status` tinyint(1) DEFAULT '0',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_wishlist` tinyint(1) DEFAULT '0' COMMENT '1: prodcut_wishlist',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Non-stick pan',2,'&#60;p&#62;It serves the purpose of non-stick coating, preventing food from sticking to the pan, and making it easy for users to clean.123&#60;/p&#62;',5,15,2,20,42,336,1,NULL,NULL,NULL,NULL,'2026-04-21 09:39:19','2026-06-09 05:01:31',0,NULL),(2,'Griller',1,'For the purpose of grilling food, safe, and easy to control food quality.',5,85,NULL,100,456,4343,1,NULL,NULL,NULL,NULL,'2026-04-21 09:39:22','2026-05-31 09:56:50',0,NULL),(3,'Induction cooker',1,'Safe kitchen appliances, easy temperature control, and a variety of features make cooking more versatile.',5,100,NULL,120,662,4326,1,NULL,NULL,NULL,NULL,'2026-04-21 09:39:25','2026-07-17 09:24:55',0,NULL),(4,'15-piece kitchen utensil set',2,'Includes modern, complete equipment from A to Z for every dish.',5,70,NULL,80,638,128,1,NULL,NULL,NULL,NULL,'2026-04-21 09:39:27','2026-07-17 09:24:55',0,NULL),(5,'Dish sterilizer',1,'It helps kill bacteria on dishes after washing, ensuring cleanliness and safety.',5,130,NULL,150,7543,4896,1,NULL,NULL,NULL,NULL,'2026-04-21 09:39:30','2026-06-15 16:02:06',0,NULL),(6,'Hood',1,'It helps to absorb odors and minimize the impact of smells on the kitchen.',5,200,NULL,230,244,5842,1,NULL,NULL,NULL,NULL,'2026-04-21 09:58:52','2026-05-31 09:56:56',1,NULL),(7,'Dishwasher',1,'Convenient, automatically handles dirty dishes.',5,275,NULL,300,497,9594,1,NULL,NULL,NULL,NULL,'2026-04-21 10:09:08','2026-06-15 16:00:13',0,NULL),(8,'Coffee maker',1,'Just add the ingredients and you\'ll have a quality cup of coffee.',5,610,NULL,650,343,5849,1,NULL,NULL,NULL,NULL,'2026-04-21 10:09:10','2026-05-31 09:57:01',0,NULL),(9,'Blender',1,'Used for making juices or grinding food.',5,8,NULL,10,54,5493,1,NULL,NULL,NULL,NULL,'2026-04-21 10:09:12','2026-05-31 09:57:06',0,NULL),(10,'Knife set',2,'Sharp, suitable for all types of food.',5,55,NULL,70,542,9694,1,NULL,NULL,NULL,NULL,'2026-04-21 10:09:15','2026-05-31 09:57:26',0,NULL),(11,'Iphone 17 ProMax',3,'Released with improved quality compared to the iPhone 16, it utilizes technology that captures two separate screens.',5,1375,NULL,1500,426,330,1,NULL,NULL,NULL,NULL,'2026-04-21 10:11:21','2026-06-11 16:13:14',0,NULL),(12,'AirPods Pro 3 ',3,'The product offers super smooth sound quality, preserves the original audio, and connects to a wide range of devices.',5,215,NULL,230,122,1234,1,NULL,NULL,NULL,NULL,'2026-04-21 10:11:36','2026-06-11 16:13:14',0,NULL),(13,'Earphones',3,'The sound quality is excellent, with no background noise.',5,40,NULL,50,145,427,1,NULL,NULL,NULL,NULL,'2026-04-21 10:11:40','2026-05-30 21:30:44',0,NULL),(14,'PC gaming',3,'This PC is specifically designed for gaming, with good specifications, low heat generation, and smooth performance across various game genres.',5,1425,NULL,1500,64,436,1,NULL,NULL,NULL,NULL,'2026-04-21 10:11:41','2026-05-30 21:30:44',0,NULL),(15,'Wireless mouse',3,'Using Bluetooth connection avoids discomfort, allows for smooth movement, and produces a pleasant clicking sound.',5,25,NULL,30,6,948,1,NULL,NULL,NULL,NULL,'2026-04-21 10:11:44','2026-05-30 21:30:44',0,NULL),(16,'Keycap',4,'The sound is pleasant, it connects wirelessly, and is convenient to use.',5,20,NULL,30,765,876,1,NULL,NULL,NULL,NULL,'2026-04-21 10:11:58','2026-05-31 09:57:34',0,NULL),(17,'PC secondary monitor',5,'It helps to divide websites or apps, making them easier to view and handle at work.',5,115,NULL,150,96,343,1,NULL,NULL,NULL,NULL,'2026-04-21 10:12:01','2026-06-11 16:13:14',0,NULL),(18,'Gaming chair',5,'Made of leather, it\'s very comfortable to sit on, and has a footrest to prevent fatigue.',5,30,NULL,40,787,866,1,NULL,NULL,NULL,NULL,'2026-04-21 10:12:02','2026-06-11 16:13:14',0,NULL),(19,'Desk',5,'It is a beneficial place for learning and working.',5,45,NULL,50,654,1266,1,NULL,NULL,NULL,NULL,'2026-04-21 10:12:04','2026-06-11 16:13:13',0,NULL),(25,'content 2',5,'&#60;p&#62;&#60;strong&#62;ok&#60;/strong&#62;&#60;/p&#62;',5,NULL,NULL,20,NULL,NULL,0,NULL,NULL,NULL,NULL,'2026-06-08 10:16:33','2026-06-08 17:16:33',0,NULL),(26,'Non-stick pan',1,'&#60;p&#62;ok&#60;/p&#62;',5,NULL,NULL,20,NULL,NULL,0,NULL,NULL,NULL,NULL,'2026-06-09 02:43:50','2026-06-09 09:43:50',0,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int NOT NULL,
  `is_status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (2,'content1',NULL,'<p>oke</p>',4,1,'2026-06-11 02:34:18','2026-06-11 06:53:15');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` int DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users_orders` WRITE;
/*!40000 ALTER TABLE `users_orders` DISABLE KEYS */;
INSERT INTO `users_orders` VALUES (1,1,'Demo','User','demo@example.com','0123456789','123 Demo Street','Yên Hòa','Hà Nội',NULL,340.00,0,NULL,'2026-06-15 09:02:06'),(2,1,'Demo','User','demo@example.com','0123456789','123 Demo Street','Yên Hòa','Hà Nội',NULL,370.00,0,NULL,'2026-07-17 02:24:55');
/*!40000 ALTER TABLE `users_orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users_wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_wishlist` (
  `product_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  UNIQUE KEY `product_id` (`product_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users_wishlist` WRITE;
/*!40000 ALTER TABLE `users_wishlist` DISABLE KEYS */;
INSERT INTO `users_wishlist` VALUES (3,1);
/*!40000 ALTER TABLE `users_wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


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
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `avartar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `forgot_token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active_token` varchar(500) DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '1:đã kích hoạt 0:chưa kích hoạt',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `token_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `token_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Tai khoan demo: demo@example.com / 123456
INSERT INTO `users` (`id`,`fullname`,`email`,`phone`,`password`,`status`,`created_at`) VALUES (81,'Demo User','demo@example.com','0123456789','$2y$10$hkoq6SXp3rBGGNKSM5Mdne9FVS3WPee5URgpi.4bZh3g6f9W0pnHS',1,NOW());
