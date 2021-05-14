-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 24 mai 2020 à 23:41
-- Version du serveur :  5.7.29-0ubuntu0.18.04.1
-- Version de PHP : 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `it103`
--

-- --------------------------------------------------------

--
-- Structure de la table `liste_amis`
--

CREATE TABLE `liste_amis` (
  `users_id` int(60) NOT NULL,
  `id` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liste_amis`
--

INSERT INTO `liste_amis` (`users_id`, `id`) VALUES
(1, 2),
(2, 1),
(1, 3),
(3, 1),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `TRANSACTIONS`
--

CREATE TABLE `TRANSACTIONS` (
  `tr_id` int(60) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(60) NOT NULL,
  `msg_1` varchar(60) NOT NULL,
  `amount` int(60) NOT NULL,
  `date_1` date DEFAULT NULL,
  `stat` int(60) NOT NULL,
  `date_2` date DEFAULT NULL,
  `msg_2` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TRANSACTIONS`
--

INSERT INTO `TRANSACTIONS` (`tr_id`, `sender_id`, `receiver_id`, `msg_1`, `amount`, `date_1`, `stat`, `date_2`, `msg_2`) VALUES
(1, 1, 3, 'hihi', 200, '2020-05-10', 0, '2020-05-22', 'byee');

-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--

CREATE TABLE `USERS` (
  `pseudo` varchar(60) NOT NULL,
  `user_id` int(60) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `birth` date DEFAULT NULL,
  `prenom` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `USERS`
--

INSERT INTO `USERS` (`pseudo`, `user_id`, `passwd`, `birth`, `prenom`, `nom`, `email`) VALUES
('tnoumar', 1, 'sirt7wa', '2020-05-19', 'toto', 'toto', 'tnoumar@enseirb-matmeca.fr'),
('admin', 2, 'it103aa', NULL, 'Taha', 'Noumar', 'tnoumar@gmail.com'),
('timtim', 3, 'timtim', NULL, 'timothÃ©e', 'janvier', 'timtim@enseirb-matmeca.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `TRANSACTIONS`
--
ALTER TABLE `TRANSACTIONS`
  ADD PRIMARY KEY (`tr_id`),
  ADD UNIQUE KEY `tr_id` (`tr_id`);

--
-- Index pour la table `USERS`
--
ALTER TABLE `USERS`
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `USERS` ADD FULLTEXT KEY `passwd` (`passwd`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `TRANSACTIONS`
--
ALTER TABLE `TRANSACTIONS`
  MODIFY `tr_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `user_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
