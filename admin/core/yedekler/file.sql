CREATE DATABASE df;

--CREATING TABLE admin
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eposta` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `kadi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--INSERTING DATA INTO admin
INSERT INTO admin VALUES ('1','admin@root.com','root','admin');



--CREATING TABLE begen
CREATE TABLE `begen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `begenen` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--INSERTING DATA INTO begen



--CREATING TABLE comment
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yazan` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yorum` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--INSERTING DATA INTO comment



--CREATING TABLE notification
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yazan` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_id` int(11) NOT NULL,
  `yazilan` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sakla` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--INSERTING DATA INTO notification



--CREATING TABLE post
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_adi` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `post_turu` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `post_boyut` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `post_sahip` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `post_aciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `post_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--INSERTING DATA INTO post



--CREATING TABLE users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eposta` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `kadi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `adi` varchar(25) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Adınızı ayarlayın',
  `pp` varchar(500) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'nopp.jpg',
  `sifre` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `token` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `kayit-tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--INSERTING DATA INTO users



-- Son

