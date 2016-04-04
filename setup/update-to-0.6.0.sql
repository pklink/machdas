UPDATE `tasks` SET `priority`='900' WHERE `priority`='high';
UPDATE `tasks` SET `priority`='500' WHERE `priority`='normal';
UPDATE `tasks` SET `priority`='100' WHERE `priority`='low';

ALTER TABLE `tasks`
  MODIFY COLUMN `priority` INT(3) UNSIGNED;

ALTER TABLE `tasks`
  CHANGE COLUMN `marked` `isDone` tinyint(1) NOT NULL DEFAULT '0';

