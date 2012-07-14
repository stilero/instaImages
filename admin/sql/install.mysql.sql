CREATE TABLE IF NOT EXISTS `#__instaimages_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

