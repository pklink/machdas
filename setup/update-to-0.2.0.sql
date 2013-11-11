ALTER TABLE `tasks` ADD COLUMN `priority` tinyint(1) NOT NULL DEFAULT '1';
UPDATE `tasks` SET `priority`='1';