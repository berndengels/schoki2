# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.5.8-MariaDB)
# Datenbank: schokoladen2
# Erstellt am: 2020-12-10 16:44:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle model_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Export von Tabelle model_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES
	(1,'App\\Models\\AdminUser',1),
	(2,'App\\Models\\AdminUser',1),
	(2,'App\\Models\\AdminUser',12),
	(2,'App\\Models\\AdminUser',20),
	(2,'App\\Models\\AdminUser',45),
	(2,'App\\Models\\AdminUser',47),
	(2,'App\\Models\\AdminUser',55),
	(2,'App\\Models\\AdminUser',60),
	(2,'App\\Models\\AdminUser',90),
	(2,'App\\Models\\AdminUser',91),
	(2,'App\\Models\\AdminUser',94),
	(2,'App\\Models\\AdminUser',97),
	(2,'App\\Models\\AdminUser',101),
	(2,'App\\Models\\AdminUser',104),
	(2,'App\\Models\\AdminUser',105),
	(2,'App\\Models\\AdminUser',106),
	(3,'App\\Models\\AdminUser',1),
	(3,'App\\Models\\AdminUser',12),
	(3,'App\\Models\\AdminUser',20),
	(3,'App\\Models\\AdminUser',47),
	(3,'App\\Models\\AdminUser',55),
	(3,'App\\Models\\AdminUser',60),
	(3,'App\\Models\\AdminUser',91),
	(3,'App\\Models\\AdminUser',94),
	(3,'App\\Models\\AdminUser',97),
	(3,'App\\Models\\AdminUser',101),
	(3,'App\\Models\\AdminUser',106);

/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(1,'admin','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(2,'translation.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(3,'translation.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(4,'translation.rescan','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(5,'admin-user.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(6,'admin-user.create','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(7,'admin-user.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(8,'admin-user.delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(9,'upload','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(10,'admin-user.impersonal-login','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(11,'category','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(12,'category.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(13,'category.create','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(14,'category.show','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(15,'category.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(16,'category.delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(17,'category.bulk-delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(18,'theme','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(19,'theme.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(20,'theme.create','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(21,'theme.show','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(22,'theme.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(23,'theme.delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(24,'theme.bulk-delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(25,'event-template','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(26,'event-template.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(27,'event-template.create','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(28,'event-template.show','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(29,'event-template.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(30,'event-template.delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(31,'event-template.bulk-delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(32,'event-periodic','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(33,'event-periodic.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(34,'event-periodic.create','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(35,'event-periodic.show','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(36,'event-periodic.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(37,'event-periodic.delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(38,'event-periodic.bulk-delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(39,'page','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(40,'page.index','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(41,'page.create','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(42,'page.show','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(43,'page.edit','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(44,'page.delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(45,'page.bulk-delete','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(46,'event','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(47,'event.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(48,'event.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(49,'event.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(50,'event.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(51,'event.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(52,'event.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(53,'role','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(54,'role.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(55,'role.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(56,'role.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(57,'role.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(58,'role.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(59,'role.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(60,'permission','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(61,'permission.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(62,'permission.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(63,'permission.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(64,'permission.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(65,'permission.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(66,'permission.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(67,'customer','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(68,'customer.index','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(69,'customer.create','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(70,'customer.show','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(71,'customer.edit','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(72,'customer.delete','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(73,'customer.bulk-delete','web','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(74,'address-category','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(75,'address-category.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(76,'address-category.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(77,'address-category.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(78,'address-category.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(79,'address-category.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(80,'address-category.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(81,'address','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(82,'address.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(83,'address.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(84,'address.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(85,'address.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(86,'address.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(87,'address.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(88,'music-style','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(89,'music-style.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(90,'music-style.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(91,'music-style.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(92,'music-style.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(93,'music-style.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(94,'music-style.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(95,'message','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(96,'message.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(97,'message.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(98,'message.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(99,'message.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(100,'message.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(101,'message.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(102,'news','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(103,'news.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(104,'news.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(105,'news.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(106,'news.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(107,'news.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(108,'news.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(109,'menu','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(110,'menu.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(111,'menu.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(112,'menu.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(113,'menu.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(114,'menu.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(115,'menu.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(116,'newsletter-status','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(117,'newsletter-status.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(118,'newsletter-status.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(119,'newsletter-status.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(120,'newsletter-status.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(121,'newsletter-status.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(122,'newsletter-status.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(123,'newsletter','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(124,'newsletter.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(125,'newsletter.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(126,'newsletter.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(127,'newsletter.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(128,'newsletter.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(129,'newsletter.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(130,'product','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(131,'product.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(132,'product.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(133,'product.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(134,'product.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(135,'product.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(136,'product.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(137,'order','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(138,'order.index','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(139,'order.create','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(140,'order.show','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(141,'order.edit','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(142,'order.delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(143,'order.bulk-delete','admin','2020-12-02 00:41:46','2020-12-02 00:41:46'),
	(144,'viewTelescope','admin','2020-12-06 23:01:16','2020-12-06 23:01:16'),
	(145,'shipping','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(146,'shipping.index','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(147,'shipping.create','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(148,'shipping.show','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(149,'shipping.edit','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(150,'shipping.delete','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(151,'shipping.bulk-delete','admin','2020-12-10 15:18:49','2020-12-10 15:18:49'),
	(152,'country','admin','2020-12-10 17:40:38','2020-12-10 17:40:38'),
	(153,'country.index','admin','2020-12-10 17:40:38','2020-12-10 17:40:38'),
	(154,'country.create','admin','2020-12-10 17:40:38','2020-12-10 17:40:38'),
	(155,'country.show','admin','2020-12-10 17:40:38','2020-12-10 17:40:38'),
	(156,'country.edit','admin','2020-12-10 17:40:38','2020-12-10 17:40:38'),
	(157,'country.delete','admin','2020-12-10 17:40:38','2020-12-10 17:40:38'),
	(158,'country.bulk-delete','admin','2020-12-10 17:40:38','2020-12-10 17:40:38');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
	(1,2),
	(2,2),
	(3,2),
	(4,2),
	(5,2),
	(6,1),
	(7,1),
	(7,2),
	(8,1),
	(9,1),
	(9,2),
	(11,2),
	(12,2),
	(13,2),
	(14,2),
	(15,2),
	(16,2),
	(17,2),
	(18,2),
	(19,2),
	(20,2),
	(21,2),
	(22,2),
	(23,2),
	(24,2),
	(25,2),
	(26,2),
	(27,2),
	(28,2),
	(29,2),
	(30,2),
	(31,2),
	(32,2),
	(33,2),
	(34,2),
	(35,2),
	(36,2),
	(37,2),
	(38,2),
	(39,2),
	(40,2),
	(41,2),
	(42,2),
	(43,2),
	(44,2),
	(45,2),
	(46,2),
	(47,2),
	(48,2),
	(49,2),
	(50,2),
	(51,2),
	(52,2),
	(53,1),
	(54,1),
	(55,1),
	(56,1),
	(57,1),
	(58,1),
	(59,1),
	(60,1),
	(61,1),
	(62,1),
	(63,1),
	(64,1),
	(65,1),
	(66,1),
	(67,3),
	(68,3),
	(69,3),
	(70,3),
	(71,3),
	(72,3),
	(73,3),
	(74,2),
	(75,2),
	(76,2),
	(77,2),
	(78,2),
	(79,2),
	(80,2),
	(81,2),
	(82,2),
	(83,2),
	(84,2),
	(85,2),
	(86,2),
	(87,2),
	(88,2),
	(89,2),
	(90,2),
	(91,2),
	(92,2),
	(93,2),
	(94,2),
	(95,2),
	(96,2),
	(97,2),
	(98,2),
	(99,2),
	(100,2),
	(101,2),
	(102,2),
	(103,2),
	(104,2),
	(105,2),
	(106,2),
	(107,2),
	(108,2),
	(109,2),
	(110,2),
	(111,2),
	(112,2),
	(113,2),
	(114,2),
	(115,2),
	(116,2),
	(117,2),
	(118,2),
	(119,2),
	(120,2),
	(121,2),
	(122,2),
	(123,2),
	(124,2),
	(125,2),
	(126,2),
	(127,2),
	(128,2),
	(129,2),
	(130,2),
	(131,2),
	(132,2),
	(133,2),
	(134,2),
	(135,2),
	(136,2),
	(137,2),
	(138,2),
	(139,2),
	(140,2),
	(141,2),
	(142,2),
	(143,2),
	(144,1),
	(152,1),
	(153,1),
	(154,1),
	(155,1),
	(156,1),
	(157,1),
	(158,1);

/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(1,'Administrator','admin','2020-12-02 00:41:45','2020-12-02 00:41:45'),
	(2,'Booker','admin','2020-12-02 22:10:03','2020-12-02 22:10:03'),
	(3,'Customer','web','2020-12-02 22:13:13','2020-12-02 22:13:13');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
