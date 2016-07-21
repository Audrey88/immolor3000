create database bourse_grand_est;
use bourse_grand_est;

CREATE TABLE `departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `offers_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `affilates` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `type` varchar(80) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` INT(10) NOT NULL,
  `contact_name` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `pictures` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `offers_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `transactions_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `offers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `ridge_height` INT NOT NULL,
  `picture_url` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(60) NOT NULL,
  `postal_code` INT(6) NOT NULL,
  `subdividable` BOOLEAN NOT NULL,
  `surface` INT NOT NULL,
  `price` INT NOT NULL,
  `pdf_url` varchar(255) NOT NULL,
  `latitude` FLOAT NOT NULL,
  `longitude` FLOAT NOT NULL,
  `commission_included` BOOLEAN NOT NULL,
  `departement_id` INT NOT NULL,
  `transaction_types_id` INT NOT NULL,
  `offer_types_id` INT NOT NULL,
  `affilate_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `pictures` ADD CONSTRAINT `pictures_fk0` FOREIGN KEY (`offers_id`) REFERENCES `offers`(`id`);

ALTER TABLE `offers` ADD CONSTRAINT `offers_fk0` FOREIGN KEY (`departement_id`) REFERENCES `departements`(`id`);

ALTER TABLE `offers` ADD CONSTRAINT `offers_fk1` FOREIGN KEY (`transaction_types_id`) REFERENCES `transactions_types`(`id`);

ALTER TABLE `offers` ADD CONSTRAINT `offers_fk2` FOREIGN KEY (`offer_types_id`) REFERENCES `offers_types`(`id`);

ALTER TABLE `offers` ADD CONSTRAINT `offers_fk3` FOREIGN KEY (`affilate_id`) REFERENCES `affilates`(`id`);