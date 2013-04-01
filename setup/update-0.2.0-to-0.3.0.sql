CREATE TABLE `cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `cards` (`id`, `name`)
VALUES
	(1, 'first list');

ALTER TABLE `tasks` ADD COLUMN `cardId` int(11) NOT NULL;

UPDATE `tasks` SET `cardId`='1';