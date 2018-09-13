-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 sep. 2018 à 18:01
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ocp6`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `avatar`
--

INSERT INTO `avatar` (`id`, `url`) VALUES
(1, 'avatar.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Grabs'),
(2, 'Rotations'),
(3, 'Flips'),
(4, 'Slides'),
(5, 'One Foot tricks'),
(6, 'Old School');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `datetime`, `content`, `user_id`, `trick_id`) VALUES
(1, '2018-09-10 00:00:00', 'test', 1, 1),
(2, '2018-09-10 00:00:02', 'test user samuel 41', 41, 1),
(6, '2018-09-10 00:00:02', 'test user samuel 41 -2', 41, 1),
(7, '2018-09-10 00:00:02', 'test user samuel 41 -3                                             ', 41, 1),
(8, '2018-09-10 00:00:02', 'test user samuel 41 -4', 41, 1),
(9, '2018-09-10 00:00:02', 'test user samuel 41 -5', 41, 1),
(10, '2018-09-10 16:33:50', 'test', 1, 1),
(11, '2018-09-11 14:19:55', 'test 11/09', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `url`) VALUES
(1, '03a2e33ee894a67581504a7ff5a65b62.jpeg'),
(16, '2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

DROP TABLE IF EXISTS `trick`;
CREATE TABLE IF NOT EXISTS `trick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `creaDate` datetime DEFAULT NULL,
  `editDate` datetime DEFAULT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D8F0A91E5E237E06` (`name`),
  KEY `IDX_D8F0A91E12469DE2` (`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `name`, `description`, `category_id`, `creaDate`, `editDate`, `published`) VALUES
(1, 'Mute', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', 1, '2018-08-21 00:00:00', '2018-09-11 15:09:14', 1),
(2, 'Sad', 'saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.', 1, '2018-08-21 00:00:00', '2018-09-04 13:42:26', 1),
(3, 'Indy', 'saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.', 1, '2018-08-21 00:00:00', NULL, 1),
(4, 'Stalefish', 'saisie de la carre backside de la planche entre les deux pieds avec la main arrière.', 1, '2018-08-21 00:00:00', NULL, 1),
(5, 'Tail grab', 'saisie de la partie arrière de la planche, avec la main arrière.', 1, '2018-08-21 00:00:00', NULL, 1),
(6, 'Nose grab', 'saisie de la partie avant de la planche, avec la main avant.', 1, '2018-08-21 00:00:00', NULL, 1),
(7, 'Japan', 'saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.', 1, '2018-08-21 00:00:00', NULL, 1),
(8, 'Seat belt', 'saisie du carre frontside à l\'arrière avec la main avant.', 1, '2018-08-21 00:00:00', NULL, 1),
(9, 'Truck driver', 'saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).', 1, '2018-08-21 00:00:00', NULL, 1),
(25, '180', 'Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.', 2, '2018-09-11 16:29:58', NULL, 1),
(26, '360', 'Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.', 2, '2018-09-11 16:29:59', NULL, 1),
(27, '720', 'Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.', 2, '2018-09-11 16:29:59', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `trick_image`
--

DROP TABLE IF EXISTS `trick_image`;
CREATE TABLE IF NOT EXISTS `trick_image` (
  `trick_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`trick_id`,`image_id`),
  KEY `IDX_E1204E0B281BE2E` (`trick_id`),
  KEY `IDX_E1204E03DA5256D` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `trick_image`
--

INSERT INTO `trick_image` (`trick_id`, `image_id`) VALUES
(1, 1),
(1, 16);

-- --------------------------------------------------------

--
-- Structure de la table `trick_video`
--

DROP TABLE IF EXISTS `trick_video`;
CREATE TABLE IF NOT EXISTS `trick_video` (
  `trick_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`trick_id`,`video_id`),
  KEY `IDX_B7E8DA93B281BE2E` (`trick_id`),
  KEY `IDX_B7E8DA9329C1004E` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `trick_video`
--

INSERT INTO `trick_video` (`trick_id`, `video_id`) VALUES
(1, 3),
(1, 9),
(1, 11);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_avatar` int(11) DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `id_avatar`, `roles`, `salt`, `token`, `is_active`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$13$B4omKHsI54s9dNnEClXEEOdpB5Qhd17lDXjkdoRagrtbkluxDdq6a', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}', NULL, '', 1),
(41, 'samuel', 'samuelcrux30@gmail.com', '$2y$13$9AGFIM334eufVr6aFX0sKeyZDZgPunmqNrjj.F.rxvQ2x2OXNVrL.', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}', NULL, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `link`) VALUES
(3, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/_hxLS2ErMiY\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>'),
(9, '<iframe frameborder=\"0\" width=\"480\" height=\"270\" src=\"//www.dailymotion.com/embed/video/xib0e9\" allowfullscreen allow=\"autoplay\"></iframe>'),
(11, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/_hxLS2ErMiY\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `trick_image`
--
ALTER TABLE `trick_image`
  ADD CONSTRAINT `FK_C722C4EB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C722C4EC06A9F55` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `trick_video`
--
ALTER TABLE `trick_video`
  ADD CONSTRAINT `FK_E66D5CBDB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E66D5CBDD5DF2635` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
