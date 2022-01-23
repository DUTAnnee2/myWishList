# myWishList

Projet PHP Bully-Cimbaluria Kévin (TheRealEureka) / Francois Aurélien (AurelienFrancoisUL) / Pierron Maxence (Azfouille) / Steiner Noé (Unshade)

## The project

Simple php project to create WishLists aiming to train us with new php tools such as slim and the eloquent ORM. The goal was not to develop a site with an exceptional UI/UX, but above all to practice simply using Eloquent, slim and php.

### Utility

Create an account, create lists, add items to lists. Edit everything, delete, change the image. 
You can reserve an item and add a message. 


## SetUp

First, you need to install mysql, php and composer on your server :

* MySql : 
```bash
$ sudo apt update
$ sudo apt install mysql-server
$ sudo mysql_secure_installation
```

* php (If you are using Apache) :
```bash
$ sudo apt update
$ sudo apt install php libapache2-mod-php
```

* composer :
```bash
$ sudo apt install php-cli unzip
$ cd ~
$ curl -sS https://getcomposer.org/installer -o composer-setup.php
$ HASH=`curl -sS https://composer.github.io/installer.sig`
$ echo $HASH
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
Don't forget to change your password, host, database user in the conf.ini file.
When your environment is ready to run php and has the database, you must initialize it with this SQL script:
```sql
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


```

## Tech used
We therefore used php, Eloquent and slim to carry out this project. Eloquent is used as an ORM, therefore for the connection to the database and active records. Slim is used as a router, it allows to launch methods of our controllers. Our project fully respects MVC (Model view controller), allowing us to have a good structure, a single php script used to process the routes (the rest being classes).

* For the database, we use MySql, simple and efficient.
