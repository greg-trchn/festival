-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 20 oct. 2020 à 08:54
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `artistes`
--

CREATE TABLE `artistes` (
  `artistes_id` int(11) NOT NULL,
  `artistes_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `artistes`
--

INSERT INTO `artistes` (`artistes_id`, `artistes_name`) VALUES
(1, 'Jamiroquai'),
(2, 'Metronomy'),
(3, 'Synapson'),
(4, 'The Avener'),
(5, 'Jain'),
(6, 'The Weeknd');

-- --------------------------------------------------------

--
-- Structure de la table `concerts`
--

CREATE TABLE `concerts` (
  `concerts_id` int(11) NOT NULL,
  `id_scenes` int(11) NOT NULL,
  `id_artistes` int(11) NOT NULL,
  `concerts_price` float NOT NULL,
  `concerts_date` datetime NOT NULL,
  `concerts_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `concerts`
--

INSERT INTO `concerts` (`concerts_id`, `id_scenes`, `id_artistes`, `concerts_price`, `concerts_date`, `concerts_stock`) VALUES
(1, 1, 1, 15, '2020-09-28 15:00:00', 5000),
(2, 1, 4, 15, '2020-09-28 23:00:00', 5000),
(3, 1, 5, 15, '2020-09-28 19:00:00', 5000),
(4, 2, 5, 30, '2020-09-28 15:00:00', 3000),
(5, 2, 2, 15, '2020-09-28 23:00:00', 3000),
(6, 2, 6, 15, '2020-09-28 19:00:00', 3000),
(7, 3, 3, 30, '2020-09-28 15:00:00', 4000),
(8, 3, 4, 15, '2020-09-28 23:00:00', 4000),
(9, 3, 2, 15, '2020-09-28 19:00:00', 4000);

-- --------------------------------------------------------

--
-- Structure de la table `scenes`
--

CREATE TABLE `scenes` (
  `scenes_id` int(11) NOT NULL,
  `scenes_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `scenes`
--

INSERT INTO `scenes` (`scenes_id`, `scenes_name`) VALUES
(1, 'Hall Tony Garnier'),
(2, 'Bourse du Travail'),
(3, 'Transbordeur');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `tickets_id` int(11) NOT NULL,
  `id_concerts` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `tickets_nbr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `users_lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `users_password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `users_email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artistes`
--
ALTER TABLE `artistes`
  ADD PRIMARY KEY (`artistes_id`);

--
-- Index pour la table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`concerts_id`),
  ADD KEY `id_artistes` (`id_artistes`),
  ADD KEY `id_scenes` (`id_scenes`);

--
-- Index pour la table `scenes`
--
ALTER TABLE `scenes`
  ADD PRIMARY KEY (`scenes_id`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`tickets_id`),
  ADD KEY `id_concerts` (`id_concerts`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artistes`
--
ALTER TABLE `artistes`
  MODIFY `artistes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `concerts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `scenes`
--
ALTER TABLE `scenes`
  MODIFY `scenes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `tickets_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`id_artistes`) REFERENCES `artistes` (`artistes_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `concerts_ibfk_2` FOREIGN KEY (`id_scenes`) REFERENCES `scenes` (`scenes_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`id_concerts`) REFERENCES `concerts` (`concerts_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`users_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
