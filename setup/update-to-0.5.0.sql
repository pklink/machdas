# change type of tasks.priority to string
ALTER TABLE `tasks`
    MODIFY COLUMN `priority` varchar(6);

# add column `slug to `cards`
ALTER TABLE `cards`
    ADD COLUMN `slug` VARCHAR(255) CHARACTER SET ascii NOT NULL;

# add random slugs to cards
UPDATE `cards` SET `slug`=MD5(RAND());

# set cards.slug as unique
ALTER TABLE `cards`
    ADD UNIQUE KEY `slug` (`slug`);

# remove `name`-key from cards
ALTER TABLE `cards`
    DROP KEY `name`;