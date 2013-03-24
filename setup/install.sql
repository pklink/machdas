CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `marked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tasks` (`id`, `name`, `marked`)
VALUES
	(1, 'save a whale', 0),
	(2, 'kiss a chicken', 0),
	(3, 'hug yourself', 0);
