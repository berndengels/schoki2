# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.5.8-MariaDB)
# Datenbank: schokoladen2
# Erstellt am: 2020-12-18 09:31:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle menu
# ------------------------------------------------------------

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`id`, `parent_id`, `menu_item_type_id`, `name`, `icon`, `fa_icon`, `url`, `lft`, `rgt`, `lvl`, `api_enabled`, `is_published`)
VALUES
	(1,NULL,4,X'544F50',NULL,NULL,NULL,1,26,0,1,1),
	(2,NULL,5,X'424F54544F4D',NULL,NULL,NULL,27,42,0,1,1),
	(3,1,1,X'4576656E7473',NULL,NULL,NULL,2,9,1,1,1),
	(4,3,3,X'4D7573696B',NULL,NULL,'https://schoki2.test/category/musik',3,4,2,1,1),
	(5,3,3,X'4C6573756E67',NULL,NULL,'https://schoki2.test/category/lesung',5,6,2,1,1),
	(6,3,3,X'5061727479',NULL,NULL,'https://schoki2.test/category/party',7,8,2,1,1),
	(7,2,3,X'496D7072657373756D',NULL,NULL,'https://schoki2.test/page/impressum',28,29,1,1,1),
	(8,2,3,X'446174656E73636875747A',NULL,NULL,'https://schoki2.test/page/datenschutz',30,31,1,1,1),
	(9,2,2,X'46616365626F6F6B','logo-facebook','fab fa-facebook-square','https://www.facebook.com/Schokoladen-189587901135862',34,35,1,1,1),
	(10,2,2,X'54776974746572','logo-twitter','fab fa-twitter-square','https://www.twitter.com/search/schokoladen-mitte',36,37,1,1,1),
	(11,2,2,X'4C6173742E666D','lastfm_logo.png',NULL,'http://www.lastfm.de/venue/8784758+Schokoladen/events',38,39,1,1,1),
	(12,1,1,X'4B6F6E74616B74',NULL,NULL,NULL,10,17,1,1,1),
	(14,12,3,X'4E6577736C6574746572',NULL,NULL,'https://schoki2.test/contact/formNewsletter',11,12,2,0,0),
	(15,1,1,X'526164696F',NULL,NULL,NULL,20,25,1,1,0),
	(16,15,3,X'526164696F20362E332E32303138',NULL,NULL,'https://schoki2.test/page/radio-6-3-2018',21,22,2,1,0),
	(17,15,3,X'526164696F20332E342E32303138',NULL,NULL,'https://schoki2.test/page/radio-3-4-2018',23,24,2,1,0),
	(19,2,3,X'525353','logo-rss',NULL,'https://schoki2.test/feed',40,41,1,0,1),
	(20,12,3,X'4C616765706C616E',NULL,NULL,'https://schoki2.test/static/map',15,16,2,0,1),
	(22,12,3,X'42616E6420416E6672616765',NULL,NULL,'https://schoki2.test/contact/formBands',13,14,2,1,1),
	(25,2,3,X'4E75747A756E67626564696E67756E67656E',NULL,NULL,'https://schoki2.test/page/nutzungsbedingungen',32,33,1,1,1),
	(27,1,3,X'53686F70',NULL,NULL,'https://schoki2.test/product',18,19,1,1,1);

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
