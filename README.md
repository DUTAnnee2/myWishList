# myWishList

Projet PHP Bully-Cimbaluria Kévin (TheRealEureka) / Francois Aurélien (AurelienFrancoisUL) / Pierron Maxence (Azfouille) / Steiner Noé (Unshade)

## The project

Simple php project to create WishLists aiming to train us with new php tools such as slim and the eloquent ORM. The goal was not to develop a site with an exceptional UI/UX, but above all to practice simply using Eloquent, slim and php.

## Tech used
We therefore used php, Eloquent and slim to carry out this project. Eloquent is used as an ORM, therefore for the connection to the database and active records. Slim is used as a router, it allows to launch methods of our controllers. Our project fully respects MVC (Model view controller), allowing us to have a good structure, a single php script used to process the routes (the rest being classes).

For the database, we use MySql, simple and efficient.

## Utility

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
When your environment is ready to run php and has the database, you must initialize it with this SQL script or else use initialization + trial set below :
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
Init + dataset :
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


INSERT INTO `item` (`id`, `liste_id`, `reserv_id`, `nom`, `descr`, `img`, `url`, `tarif`) VALUES
(1, 2, 2, 'Champagne', 'Bouteille de champagne + flutes + jeux à gratter', 'champagne.jpg', '', '20.00'),
(2, 2, NULL, 'Musique', 'Partitions de piano à 4 mains', 'musique.jpg', '', '25.00'),
(3, 2, NULL, 'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', 'poirelregarder.jpg', '', '14.00'),
(4, 3, NULL, 'Goûter', 'Goûter au FIFNL', 'gouter.jpg', '', '20.00'),
(5, 3, NULL, 'Projection', 'Projection courts-métrages au FIFNL', 'film.jpg', '', '10.00'),
(6, 2, NULL, 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', 'rose.jpg', '', '16.00'),
(7, 2, NULL, 'Diner Stanislas', 'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)', 'bonroi.jpg', '', '60.00'),
(8, 3, NULL, 'Origami', 'Baguettes magiques en Origami en buvant un thé', 'origami.jpg', '', '12.00'),
(9, 3, NULL, 'Livres', 'Livre bricolage avec petits-enfants + Roman', 'bricolage.jpg', '', '24.00'),
(10, 2, NULL, 'Diner  Grand Rue ', 'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', 'grandrue.jpg', '', '59.00'),
(11, 0, NULL, 'Visite guidée', 'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', 'place.jpg', '', '11.00'),
(12, 2, NULL, 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil', 'bijoux.jpg', '', '29.00'),
(19, 0, NULL, 'Jeu contacts', 'Jeu pour échange de contacts', 'contact.png', '', '5.00'),
(22, 0, NULL, 'Concert', 'Un concert à Nancy', 'concert.jpg', '', '17.00'),
(23, 1, NULL, 'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', 'apparthotel.jpg', '', '56.00'),
(24, 2, NULL, 'Hôtel d\'Haussonville', 'Hôtel d\'Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', 'hotel_haussonville_logo.jpg', '', '169.00'),
(25, 1, NULL, 'Boite de nuit', 'Discothèque, Boîte tendance avec des soirées à thème & DJ invités', 'boitedenuit.jpg', '', '32.00'),
(26, 1, NULL, 'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', 'laser.jpg', '', '15.00'),
(27, 1, NULL, 'Fort Aventure', 'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l\'élastique inversé,\r\n        Toboggan géant... et bien plus encore.', 'fort.jpg', '', '25.00'),
(28, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(29, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(30, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(31, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(32, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(33, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(34, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00'),
(35, 4, NULL, 'Bierre', 'Bierre miam', 'https://stickeramoi.com/16989-large_default/sticker-cocktail-bierre.jpg', NULL, '10.00');


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

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `token`, `public`) VALUES
(1, 1, 'Pour fêter le bac !', 'Pour un week-end à Nancy qui nous fera oublier les épreuves. ', '2018-06-27', 'eae6204bad34c1745b560db21af352a3', 1),
(2, 1, 'Liste de mariage d\'Alice et Bob', 'Nous souhaitons passer un week-end royal à Nancy pour notre lune de miel :)', '2018-06-30', '3b47b14bbdbd535feeed1be17a268373', 1),
(3, 2, 'C\'est l\'anniversaire de Charlie', 'Pour lui préparer une fête dont il se souviendra :)', '2017-12-12', '2c64734aed2bf3a0ff833388c2ad2eca', 0),
(4, 1, 'Anniversaire de M. Wiart ', 'Anniversaire du meilleur prof de php', '2022-02-03', '9c2d85dc61f1d45a6fd88d71d3d60b60', 1);


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

INSERT INTO `message` (`mess_id`, `author_id`, `liste_id`, `text`, `date`) VALUES
(1, 2, 4, 'Bierre miam', '2022-01-23 20:18:53');


CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `user` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Utilisateur1', 'oui@gmail.com', '$2y$10$bATvgiLlM0Z7dnRQdwDiY.z6EiWFmwHp5haevohRt43He3QTkK5Hq'),
(2, 'Utilisateur2', 'oui1@gmail.com', '$2y$10$HFESyCW/e1dUmyXb4YGna.VBOLbyrzls.N7mkyxJ/lUbSHK1aFTsK');
```

If you used the init + dataset here are the credential for the users :
```
utilisateur 1 : 
oui@gmail.com
testu1

utilisateur 2 : 
oui1@gmail.com
testu2
```

