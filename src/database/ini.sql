SET NAMES utf8;
SET
time_zone = '+00:00';
SET
foreign_key_checks = 0;
SET
sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`
(
    `id`       int(11) NOT NULL AUTO_INCREMENT,
    `liste_id` int(11) NOT NULL,
    `reserv_id` int(11) DEFAULT NULL,
    `nom`      text NOT NULL,
    `descr`    text,
    `img`      text,
    `url`      text,
    `tarif`    decimal(5, 2) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `liste`;
CREATE TABLE `liste`
(
    `no`          int(11) NOT NULL AUTO_INCREMENT,
    `user_id`     int(11) DEFAULT NULL,
    `titre`       varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `description` text COLLATE utf8_unicode_ci,
    `expiration`  date                                 DEFAULT NULL,
    `token`       varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `public`      int(1) DEFAULT 0,
    PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `user_id`  int(5) NOT NULL AUTO_INCREMENT,
    `username` varchar(20)  NOT NULL,
    `email`    varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`user_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message`
(
    `mess_id`  int(5) NOT NULL AUTO_INCREMENT,
    `author_id`  int(5) NOT NULL ,
    `liste_id` int(5) NOT NULL,
    `text` text COLLATE utf8_unicode_ci,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`mess_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

