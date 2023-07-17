CREATE TABLE `Contacts`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` BIGINT NOT NULL,
    `user_id` BIGINT NOT NULL,
    `note` TEXT NOT NULL
);
CREATE TABLE `Users`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
CREATE TABLE `Phones`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Number` VARCHAR(255) NOT NULL,
    `Type` VARCHAR(255) NOT NULL,
    `contact_id` BIGINT NOT NULL
);
CREATE TABLE `Addresses`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `address` TEXT NOT NULL,
    `contact_id` BIGINT NOT NULL
);
ALTER TABLE
    `Contacts` ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `Users`(`id`);
ALTER TABLE
    `Phones` ADD CONSTRAINT `phones_contact_id_foreign` FOREIGN KEY(`contact_id`) REFERENCES `Contacts`(`id`);
ALTER TABLE
    `Addresses` ADD CONSTRAINT `addresses_contact_id_foreign` FOREIGN KEY(`contact_id`) REFERENCES `Contacts`(`id`);
ALTER TABLE
    `Users` ADD CONSTRAINT `users_id_foreign` FOREIGN KEY(`id`) REFERENCES `Contacts`(`id`);