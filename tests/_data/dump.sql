CREATE TABLE `cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `cards` (`id`, `name`)
  VALUES
  (1, 'first list'),
  (2, 'second list');


CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `isDone` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(3) NOT NULL DEFAULT '500',
  `cardId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `tasks` (`id`, `name`, `isDone`, `priority`, `cardId`)
  VALUES
  (1, 'save a whale', 0, 500, 1),
  (2, 'kiss a chicken', 0, 900, 1),
  (3, 'hug yourself', 0, 100, 1);