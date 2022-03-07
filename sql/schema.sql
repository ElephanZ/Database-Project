DROP DATABASE IF EXISTS `service_center`;
CREATE DATABASE `service_center`;

USE `service_center`;

CREATE TABLE client (
    `fc` CHAR(16) NOT NULL,
    `name` VARCHAR(32) NOT NULL,
    `surname` VARCHAR(32) NOT NULL,
    `date_birth` DATE NOT NULL,
    PRIMARY KEY (`fc`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE contact (
    `value` VARCHAR(320) NOT NULL,
    `kind` ENUM('email', 'phone') NOT NULL,
    PRIMARY KEY (`value`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE own (
    `client_id` CHAR(16) NOT NULL,
    `contact_id` VARCHAR(320) NOT NULL,
    PRIMARY KEY (`client_id`, `contact_id`),
    FOREIGN KEY (`client_id`) REFERENCES client(`fc`),
    FOREIGN KEY (`contact_id`) REFERENCES contact(`value`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE device (
    `sn` VARCHAR(50) NOT NULL,
    `brand` VARCHAR(32) NOT NULL,
    `model` VARCHAR(32) NOT NULL,
    `kind` ENUM('desktop', 'notebook', 'smartphone', 'printer'),
    `client_id` CHAR(16) NOT NULL,
    PRIMARY KEY (`sn`),
    FOREIGN KEY (`client_id`) REFERENCES client(`fc`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE technician (
    `fc` CHAR(16) NOT NULL,
    `name` VARCHAR(32) NOT NULL,
    `surname` VARCHAR(32) NOT NULL,
    `date_birth` DATE NOT NULL,
    `date_hire` DATE NOT NULL,
    `pay_hourly` DECIMAL(2, 2) NOT NULL,
    password CHAR(32) NOT NULL,
    PRIMARY KEY (`fc`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE slot (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `wall` INT(1) NOT NULL,
    `colmn` INT(1) NOT NULL,
    `rw` INT(1) NOT NULL,
    UNIQUE (`wall`, `colmn`, `rw`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE operation (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `date_pickup` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_delivery` DATETIME DEFAULT NULL,
    `total_cost` DECIMAL(5, 2) DEFAULT 0.0,
    `vat` INT(2) NOT NULL,
    `labor` INT(3) NOT NULL,
    `slot_id` INT(11) NOT NULL,
    `device_id` VARCHAR(50) NOT NULL,
    `technician_id` CHAR(16) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`slot_id`) REFERENCES slot(`id`),
    FOREIGN KEY (`device_id`) REFERENCES device(`sn`),
    FOREIGN KEY (`technician_id`) REFERENCES technician(`fc`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE accessory (
    `name` VARCHAR(32) NOT NULL,
    `operation_id` INT(11) NOT NULL,
    `device_id` VARCHAR(50) NOT NULL,
    `note` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`name`, `operation_id`, `device_id`),
    FOREIGN KEY (`operation_id`) REFERENCES operation(`id`),
    FOREIGN KEY (`device_id`) REFERENCES device(`sn`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE reparation (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `trouble` VARCHAR(255) NOT NULL,
    `note` VARCHAR(255),
    `operation_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`operation_id`) REFERENCES operation(`id`),
    UNIQUE (`operation_id`, `trouble`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE material (
    `sn` VARCHAR(50) NOT NULL,
    `name` VARCHAR(32) NOT NULL,
    `cost` DECIMAL(4, 2) NOT NULL,
    `description` VARCHAR(128),
    `reparation_id` INT(11) NOT NULL,
    PRIMARY KEY (`sn`),
    FOREIGN KEY (`reparation_id`) REFERENCES reparation(`id`)
) ENGINE=InnoDB CHARACTER SET utf8;