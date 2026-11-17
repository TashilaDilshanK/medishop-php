-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for medishop
CREATE DATABASE IF NOT EXISTS `medishop` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `medishop`;

-- Dumping structure for table medishop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.admin: ~1 rows (approximately)
INSERT INTO `admin` (`email`, `fname`, `lname`, `verification_code`) VALUES
	('admin@gmail.com', 'Tashila', 'Dilshan', '63c495e80bcb0');

-- Dumping structure for table medishop.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_category1_idx` (`category_id`),
  CONSTRAINT `fk_brand_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.brand: ~2 rows (approximately)
INSERT INTO `brand` (`id`, `name`, `category_id`) VALUES
	(38, 'KLODIC', 2),
	(39, 'XINC B', 2),
	(40, 'SILOCIN 4', 3),
	(41, 'AXCEL', 9),
	(42, 'DILZEM SR', 2),
	(43, 'SITALO  100', 2),
	(44, 'RIXUBIS', 8),
	(45, 'ROST 20', 2),
	(46, 'MIRTAZ 15', 2),
	(47, 'METRIS', 8),
	(48, 'TRANETA', 2),
	(49, 'SOLMUX FORTE', 13),
	(50, 'GLIVIC 40MG', 2),
	(51, 'ENCORATE', 2),
	(52, 'RINHEPA 25', 8),
	(53, 'TERBISIL CREAM', 9),
	(54, 'URIMAX 0.4 mg', 2),
	(55, 'AZA-500', 2),
	(56, 'GEFTIWEL 250', 2),
	(57, 'MATINIB 400', 2),
	(58, 'BSD', 1);

-- Dumping structure for table medishop.brand_has_model
CREATE TABLE IF NOT EXISTS `brand_has_model` (
  `brand_id` int NOT NULL,
  `model_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_brand_has_model_model1_idx` (`model_id`),
  KEY `fk_brand_has_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_brand_has_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_brand_has_model_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.brand_has_model: ~2 rows (approximately)
INSERT INTO `brand_has_model` (`brand_id`, `model_id`, `id`) VALUES
	(39, 32, 34),
	(38, 32, 35),
	(41, 32, 36),
	(40, 32, 37),
	(58, 32, 38);

-- Dumping structure for table medishop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.cart: ~1 rows (approximately)
INSERT INTO `cart` (`id`, `qty`, `product_id`, `user_email`) VALUES
	(46, 1, 49, 'tdk@gmail.com'),
	(48, 1, 47, 'tdk@gmail.com');

-- Dumping structure for table medishop.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.category: ~1 rows (approximately)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Liquid'),
	(2, 'Tablet'),
	(3, 'Capsules'),
	(4, 'Topical medicines'),
	(5, 'Suppositories'),
	(6, 'Drops'),
	(7, 'Inhalers'),
	(8, 'Injections'),
	(9, 'CREAM'),
	(13, 'ORAL SUSPENSION');

-- Dumping structure for table medishop.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` varchar(45) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.chat: ~0 rows (approximately)

-- Dumping structure for table medishop.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.city: ~1 rows (approximately)
INSERT INTO `city` (`id`, `name`, `district_id`) VALUES
	(6, 'Pugoda', 4);

-- Dumping structure for table medishop.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.condition: ~2 rows (approximately)
INSERT INTO `condition` (`id`, `name`) VALUES
	(3, 'Good'),
	(4, 'Local');

-- Dumping structure for table medishop.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.district: ~1 rows (approximately)
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
	(4, 'Jaffna', 1),
	(5, 'Kilinochchi', 1),
	(6, 'Mannar', 1),
	(7, 'Mullaitivu', 1),
	(8, 'Vavuniya', 1),
	(9, 'Puttalam', 2),
	(10, 'Kurunegala', 2),
	(11, 'Gampaha', 3),
	(12, 'Colombo', 3),
	(13, 'Kalutara', 3),
	(14, 'Anuradhapura', 4),
	(15, 'Polonnaruwa', 4),
	(16, 'Matale', 5),
	(17, 'Kandy', 5),
	(18, 'Nuwara Eliya', 5),
	(19, 'Kegalle', 6),
	(20, 'Ratnapura', 6),
	(21, 'Trincomalee', 7),
	(22, 'Batticaloa', 7),
	(23, 'Ampara', 7),
	(24, 'Badulla', 8),
	(25, 'Monaragala', 8),
	(26, 'Hambantota', 9),
	(27, 'Matara', 9),
	(28, 'Galle', 9);

-- Dumping structure for table medishop.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `feedback` text,
  `date` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.feedback: ~0 rows (approximately)

-- Dumping structure for table medishop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table medishop.images
CREATE TABLE IF NOT EXISTS `images` (
  `code` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.images: ~3 rows (approximately)
INSERT INTO `images` (`code`, `product_id`) VALUES
	('resource//productImages//pitem1.jpg', 44),
	('resource//productImages//pitem2.jpg', 45),
	('resource//productImages//pcap2.jpg', 46),
	('resource//productImages//Amoxicillin_0_63c4734696cfb.jpeg', 47),
	('resource//productImages//Vetamin E_0_63c474d636a63.jpeg', 48),
	('resource//productImages// 1 Al 10 MG Tablet_0_63c476e324bfc.jpeg', 49),
	('resource//productImages//Change Tablet_0_63c47ca479f77.jpeg', 51),
	('resource//productImages//Gaviscon Liquid 200ml_0_63c47ebd2a369.jpeg', 52);

-- Dumping structure for table medishop.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.invoice: ~0 rows (approximately)
INSERT INTO `invoice` (`id`, `order_id`, `date`, `total`, `qty`, `status`, `product_id`, `user_email`) VALUES
	(10, '63c4d051226f1', '2023-01-16 09:50:20', 2850, 1, 0, 49, 'tdk@gmail.com');

-- Dumping structure for table medishop.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.model: ~1 rows (approximately)
INSERT INTO `model` (`id`, `name`, `brand_id`) VALUES
	(32, 'njn ', 38);

-- Dumping structure for table medishop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `category_id` int NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `condition_id` int NOT NULL,
  `status_id` int NOT NULL,
  `brand_has_model_id` int NOT NULL,
  `delivery_cost_id` double DEFAULT NULL,
  `recycle_bin_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_brand_has_model1_idx` (`brand_has_model_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_recycle_bin1_idx` (`recycle_bin_id`),
  KEY `fk_product_admin1_idx` (`user_email`) USING BTREE,
  CONSTRAINT `fk_product_admin1` FOREIGN KEY (`user_email`) REFERENCES `admin` (`email`),
  CONSTRAINT `fk_product_brand_has_model1` FOREIGN KEY (`brand_has_model_id`) REFERENCES `brand_has_model` (`id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_recycle_bin1` FOREIGN KEY (`recycle_bin_id`) REFERENCES `recycle_bin` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.product: ~1 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `category_id`, `user_email`, `condition_id`, `status_id`, `brand_has_model_id`, `delivery_cost_id`, `recycle_bin_id`) VALUES
	(44, 200, 50, '250mg', 'ggr', '2023-01-14 18:27:40', 3, 'admin@gmail.com', 3, 1, 34, 2000, 1),
	(45, 150, 50, '50mg', 'Aropink', '2023-01-16 01:40:12', 2, 'admin@gmail.com', 3, 1, 35, 2000, 2),
	(46, 750, 80, '500mg', 'Amoxicillin 500', '2023-01-16 01:57:01', 3, 'admin@gmail.com', 3, 1, 34, 2000, 1),
	(47, 1500, 100, '250mg', 'Amoxicillin250', '2023-01-16 03:12:29', 3, 'admin@gmail.com', 3, 1, 37, 2000, 1),
	(48, 2500, 100, 'General\r\n\r\nQuantity - 20 Capsules\r\nType - Vitamin E\r\nMaximum Shelf Life - 18 Months\r\nFood Preference - Non-vegetarian\r\nServing Size - 2 No\r\nCountry of Origin - India', 'Vetamin E', '2023-01-16 03:19:09', 3, 'admin@gmail.com', 3, 1, 37, 2000, 2),
	(49, 850, 49, '1 Al 10 MG Tablet is an antihistamine medicine. It is used widely to relieve allergic symptoms like runny nose, sneezing, redness of your nose, watery eyes, itching, rash and hives (raised bumps on your skin). It stops the action of a natural substance called histamine produced in your body during an allergic reaction.\r\n\r\n1 Al 10 MG Tablet is generally safe to use. However, it may cause some side effects like drowsiness, dry mouth, headache, and tiredness. These symptoms are mild and subside with time.\r\n\r\nYou may take 1 Al 10 MG Tablet with or without food. It is preferably taken in the evening. The dose and duration will depend on the condition you are taking it for. Consult your doctor if there is no improvement in your symptoms after the treatment. Do not increase the dose or take this tablet more often than prescribed by your doctor. \r\n\r\nBefore taking 1 Al 10 MG Tablet, tell your doctor if you have/had any medical condition like liver, kidney or heart disease. Your doctor should also be aware of any other medications that you are taking since many of them may alter the efficacy of this medicine. If you are pregnant or are breastfeeding, you should consult your doctor before using this medication.', ' 1 Al 10 MG Tablet', '2023-01-16 03:27:54', 2, 'admin@gmail.com', 3, 1, 37, 2000, 1),
	(51, 1250, 50, 'Manufactured ByTORRENT PHARMACEUTICALS LTD\r\nContainsOfloxacin (200 mg) + Ornidazole (500 mg)', 'Change Tablet', '2023-01-16 03:52:28', 2, 'admin@gmail.com', 3, 1, 35, 2000, 1),
	(52, 1900, 25, 'GAVISCON® LIQUIDSGaviscon Peppermint Liquid Relief brings fast? soothing and long lasting relief from the pain and discomfort of heartburn and acid indigestion. It can be used to treat gastric reflux (a condition in which the stomach acid contents flow upwards into the food pipe) and flatulence caused by gastric reflux? it belongs to a group of medicines called reflux suppressantsUSESRelieves:HeartburnSour StomachAcid IndigestionUpset stomach associated with these symptomsDIRECTIONSShake well. Take 1-2 tablespoons 4x a day for Regular Strength? or as directed by a doctor.Take after meals or at bedtime. Dispense product only by spoon or another measuring device.', 'Gaviscon Liquid 200ml', '2023-01-16 04:01:24', 1, 'admin@gmail.com', 3, 1, 38, 2000, 1);

-- Dumping structure for table medishop.profile_image
CREATE TABLE IF NOT EXISTS `profile_image` (
  `path` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_image_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_image_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.profile_image: ~0 rows (approximately)

-- Dumping structure for table medishop.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.province: ~1 rows (approximately)
INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'Northern'),
	(2, 'NorthWestern'),
	(3, 'Western'),
	(4, 'NorthCentral'),
	(5, 'Central'),
	(6, 'Sabaragamuwa'),
	(7, 'Eastern'),
	(8, 'Uva'),
	(9, 'Southern	');

-- Dumping structure for table medishop.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.recent: ~9 rows (approximately)
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES
	(65, 44, 'tdk@gmail.com'),
	(66, 44, 'tdk@gmail.com'),
	(67, 44, 'tdk@gmail.com'),
	(68, 44, 'tdk@gmail.com'),
	(69, 44, 'tdk@gmail.com'),
	(70, 44, 'tdk@gmail.com'),
	(71, 44, 'tdk@gmail.com'),
	(72, 44, 'tdk@gmail.com'),
	(73, 44, 'tdk@gmail.com'),
	(74, 44, 'tdk@gmail.com'),
	(75, 47, 'tdk@gmail.com'),
	(76, 45, 'tdk@gmail.com');

-- Dumping structure for table medishop.recycle_bin
CREATE TABLE IF NOT EXISTS `recycle_bin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.recycle_bin: ~2 rows (approximately)
INSERT INTO `recycle_bin` (`id`, `name`) VALUES
	(1, 'stored'),
	(2, 'delete');

-- Dumping structure for table medishop.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.status: ~2 rows (approximately)
INSERT INTO `status` (`id`, `name`) VALUES
	(1, 'active'),
	(2, 'inactive');

-- Dumping structure for table medishop.user
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `adres1` varchar(45) DEFAULT NULL,
  `adres2` varchar(45) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.user: ~1 rows (approximately)
INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `mobile`, `adres1`, `adres2`, `joined_date`, `verification_code`, `status`, `gender_id`) VALUES
	('tdk@gmail.com', 'td', 'kumara', '123456', '0713573651', '65/2,', 'narangodawaththa', '2023-01-14 18:35:58', NULL, 1, 1);

-- Dumping structure for table medishop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `line1` text,
  `line2` text,
  `postal_code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_city_city1_idx` (`city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.user_has_address: ~1 rows (approximately)
INSERT INTO `user_has_address` (`user_email`, `city_id`, `id`, `line1`, `line2`, `postal_code`) VALUES
	('tdk@gmail.com', 6, 13, '65/2,', 'narangodawaththa', '11061');

-- Dumping structure for table medishop.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table medishop.watchlist: ~1 rows (approximately)
INSERT INTO `watchlist` (`id`, `user_email`, `product_id`) VALUES
	(151, 'tdk@gmail.com', 44),
	(152, 'tdk@gmail.com', 52),
	(153, 'tdk@gmail.com', 49);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
