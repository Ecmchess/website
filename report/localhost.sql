


CREATE DATABASE `lacombes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lacombes`;

-- --------------------------------------------------------



CREATE TABLE `Categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------


CREATE TABLE `Image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` date DEFAULT NULL,
  `urlImage` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------



CREATE TABLE `Menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `glyphicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DD3795ADFF7747B4` (`titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

-- --------------------------------------------------------



CREATE TABLE `Produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E618D5BBBCF5E72D` (`categorie_id`),
  KEY `IDX_E618D5BB3DA5256D` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------



CREATE TABLE `Publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `titre` longtext COLLATE utf8_unicode_ci NOT NULL,
  `corps` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motif` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_29A0E8AECCD7E912` (`menu_id`),
  KEY `IDX_29A0E8AE60BB6FE6` (`auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

-- --------------------------------------------------------


CREATE TABLE `Sponsor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urlImage` longtext COLLATE utf8_unicode_ci,
  `lien` longtext COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `updated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------



CREATE TABLE `SubMenu` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CB3FDEBA1BB9D5A2` (`id_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------



CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------


-- --------------------------------------------------------



ALTER TABLE `Produit`
  ADD CONSTRAINT `FK_E618D5BB3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `Image` (`id`),
  ADD CONSTRAINT `FK_E618D5BBBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `Categorie` (`id`);


ALTER TABLE `Publication`
  ADD CONSTRAINT `FK_29A0E8AE60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_29A0E8AECCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `Menu` (`id`) ON DELETE SET NULL;


ALTER TABLE `SubMenu`
  ADD CONSTRAINT `FK_CB3FDEBABF396750` FOREIGN KEY (`id`) REFERENCES `Menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB3FDEBA1BB9D5A2` FOREIGN KEY (`id_parent`) REFERENCES `Menu` (`id`);
