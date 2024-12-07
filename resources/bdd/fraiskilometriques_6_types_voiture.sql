-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 07 déc. 2024 à 14:26
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsb_frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `fraiskilometriques`
--

CREATE TABLE `fraiskilometriques` (
  `idmoteur` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `typemoteur` text NOT NULL,
  `cheveaux` int NOT NULL,
  `KM` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `fraiskilometriques`
--

INSERT INTO `fraiskilometriques` (`idmoteur`, `typemoteur`, `cheveaux`, `KM`) VALUES
('die04', 'diesel', 4, 0.52),
('die05', 'diesel', 5, 0.58),
('die06', 'diesel', 6, 0.58),
('ess04', 'essence', 4, 0.62),
('ess05', 'essence', 5, 0.67),
('ess06', 'essence', 6, 0.67);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fraiskilometriques`
--
ALTER TABLE `fraiskilometriques`
  ADD PRIMARY KEY (`idmoteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
