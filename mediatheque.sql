-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 23 mai 2021 à 22:34
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `aid` int(11) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `audio`
--

CREATE TABLE `audio` (
  `mid` int(11) NOT NULL,
  `editor` varchar(64) NOT NULL,
  `edition` int(11) NOT NULL,
  `duration` int(11) NOT NULL CHECK (`duration` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `audio`
--

INSERT INTO `audio` (`mid`, `editor`, `edition`, `duration`) VALUES
(4, 'truite', 1, 258);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `cid` int(11) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `inOrder` tinyint(1) NOT NULL DEFAULT 0,
  `subscribeDate` datetime NOT NULL DEFAULT current_timestamp(),
  `validate` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `email` varchar(46) NOT NULL,
  `adress` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `mid` int(11) NOT NULL,
  `productor` varchar(64) NOT NULL,
  `duration` int(11) NOT NULL CHECK (`duration` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `fid` int(11) NOT NULL,
  `companyName` varchar(32) NOT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

CREATE TABLE `gestionnaire` (
  `gid` int(11) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `hid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `borrowingDate` datetime NOT NULL DEFAULT current_timestamp(),
  `renderingDate` datetime DEFAULT NULL,
  `clientPremium` tinyint(1) NOT NULL,
  `extend` tinyint(1) NOT NULL DEFAULT 0,
  `lost` tinyint(1) NOT NULL DEFAULT 0,
  `virtualMedia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `mid` int(11) NOT NULL,
  `editor` varchar(64) NOT NULL,
  `edition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`mid`, `editor`, `edition`) VALUES
(1, 'Albertier', 1),
(2, 'Warner bros capitalisation', 2),
(3, 'Marx production', 1);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `mid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `format` varchar(16) NOT NULL CHECK (`format` = 'livre' or `format` = 'audio' or `format` = 'film' or `format` = 'periodique'),
  `title` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `price` float NOT NULL CHECK (`price` > 0),
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 0),
  `kind` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `releaseDate` date NOT NULL,
  `type` varchar(32) NOT NULL,
  `mediaType` int(11) NOT NULL CHECK (0 <= `mediaType` and `mediaType` <= 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`mid`, `pid`, `fid`, `format`, `title`, `author`, `price`, `quantity`, `kind`, `description`, `releaseDate`, `type`, `mediaType`) VALUES
(1, NULL, NULL, 'livre', 'Voyage au centre de la terre', 'Jules Verne', 13.9, 13, 'aventure', 'Un bon livre, même très bon. La preuve il est écrit Jules qui a fait d\'autres bon livres donc il est forcément bon !', '2010-04-02', 'roman', 2),
(2, NULL, NULL, 'livre', 'Harry pot de beurre 1', 'JK', 15, 19, 'aventure', 'Un bon très livre, qui parle d\'un enfant un peu perturbé qui croit qu\'il est un sorcier pufff. C\'est vraiment has been heureusement que son ami Ron est là pour remettre un peu de réalité avec sa souris métamorphe ! ', '2012-04-02', 'roman', 2),
(3, NULL, NULL, 'livre', 'Les animaux de la ferme', 'Orwell George', 10, 0, 'sci-fi', 'Les animaux de la ferme tente un putsch contre l\'état établit, rébellion ou insurgé ?', '2020-04-02', 'roman', 0),
(4, NULL, NULL, 'audio', 'Clocks', 'Coldplay', 5, 0, 'rock alternatif', 'Une musique qui parle de... Oh vous avez vue l\'heure je doit y aller !', '2019-06-10', 'rock', 0);

-- --------------------------------------------------------

--
-- Structure de la table `periodique`
--

CREATE TABLE `periodique` (
  `mid` int(11) NOT NULL,
  `editor` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE `proposition` (
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `propositionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `accepted` tinyint(1) DEFAULT NULL,
  `mediaType` tinyint(4) NOT NULL CHECK (0 >= `mediaType` and `mediaType` <= 2),
  `deliveryDate` date DEFAULT NULL,
  `received` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservationmedia`
--

CREATE TABLE `reservationmedia` (
  `rmid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `sheduledDate` datetime NOT NULL,
  `cancelled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservationsalle`
--

CREATE TABLE `reservationsalle` (
  `rsid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `sheduledDate` date NOT NULL,
  `morning` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL CHECK (`capacity` > 0),
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`number`, `capacity`, `description`) VALUES
(1, 6, 'Belle salle avec vue sur l\'arrière court, au rez de chaussez, faite attention à la marche'),
(2, 8, 'Au 1er');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD KEY `aid` (`aid`);

--
-- Index pour la table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`mid`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD KEY `cid` (`cid`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`mid`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD KEY `fid` (`fid`);

--
-- Index pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  ADD KEY `gid` (`gid`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`hid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `mid` (`mid`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`mid`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `fid` (`fid`);

--
-- Index pour la table `periodique`
--
ALTER TABLE `periodique`
  ADD PRIMARY KEY (`mid`);

--
-- Index pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `fid` (`fid`),
  ADD KEY `mid` (`mid`);

--
-- Index pour la table `reservationmedia`
--
ALTER TABLE `reservationmedia`
  ADD PRIMARY KEY (`rmid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `mid` (`mid`);

--
-- Index pour la table `reservationsalle`
--
ALTER TABLE `reservationsalle`
  ADD PRIMARY KEY (`rsid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `number` (`number`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`number`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `proposition`
--
ALTER TABLE `proposition`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservationmedia`
--
ALTER TABLE `reservationmedia`
  MODIFY `rmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reservationsalle`
--
ALTER TABLE `reservationsalle`
  MODIFY `rsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `audio_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD CONSTRAINT `fournisseur_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  ADD CONSTRAINT `gestionnaire_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `client` (`cid`),
  ADD CONSTRAINT `historique_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `livre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `proposition` (`pid`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `fournisseur` (`fid`);

--
-- Contraintes pour la table `periodique`
--
ALTER TABLE `periodique`
  ADD CONSTRAINT `periodique_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD CONSTRAINT `proposition_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `fournisseur` (`fid`),
  ADD CONSTRAINT `proposition_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `reservationmedia`
--
ALTER TABLE `reservationmedia`
  ADD CONSTRAINT `reservationmedia_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `client` (`cid`),
  ADD CONSTRAINT `reservationmedia_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `media` (`mid`);

--
-- Contraintes pour la table `reservationsalle`
--
ALTER TABLE `reservationsalle`
  ADD CONSTRAINT `reservationsalle_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `client` (`cid`),
  ADD CONSTRAINT `reservationsalle_ibfk_2` FOREIGN KEY (`number`) REFERENCES `salle` (`number`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`id`) REFERENCES `compte` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
