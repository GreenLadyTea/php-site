create database messagesdb;
use messagesdb;
DROP TABLE IF EXISTS `Messages`;
CREATE TABLE `Messages` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `message` text,
                            `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `user_id` int NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `Messages_Users_id_fk` (`user_id`),
                            CONSTRAINT `Messages_Users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `username` varchar(256) NOT NULL,
                         `password` varchar(64) NOT NULL,
                         `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `Users_username_uindex` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
