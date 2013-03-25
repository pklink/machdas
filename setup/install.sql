CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `marked` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

INSERT INTO `tasks` (`id`, `name`, `marked`, `priority`)
VALUES
	(1, 'save a whale', 0, 1),
	(2, 'kiss a chicken', 0, 2),
	(3, 'hug yourself', 0, 0);
