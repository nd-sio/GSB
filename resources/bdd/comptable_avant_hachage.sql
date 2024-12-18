-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 11 déc. 2024 à 18:54
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
-- Structure de la table `comptable`
--

CREATE TABLE `comptable` (
  `id` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comptable`
--

INSERT INTO `comptable` (`id`, `nom`, `prenom`, `login`, `mdp`, `email`) VALUES
('01J78YGVTA6JVYE7B94NNQPQAG', 'Guinna', 'Kleinber', 'gkleinber0', 'e3bd71aa0', 'gkleinber0@swiss-galaxy.com'),
('01J78YGVTBQAYXVVS1DJDFGS5Y', 'Jori', 'Sivyer', 'jsivyer1', '075a6a1d3', 'jsivyer1@swiss-galaxy.com'),
('01J78YGVTCVE36V23MJ65G9AB9', 'Kattie', 'Dightham', 'kdightham2', 'db67eac20', 'kdightham2@swiss-galaxy.com'),
('01J78YGVTDHKNP6649PBNMT6HW', 'Desdemona', 'Owbridge', 'dowbridge3', 'f9c45d6f0', 'dowbridge3@swiss-galaxy.com'),
('01J78YGVTEDSGVF10D36QVV3RA', 'Josias', 'Cheshir', 'jcheshir5', '6b6e01b11', 'jcheshir5@swiss-galaxy.com'),
('01J78YGVTEVB566KAWGNSVMT92', 'Ashely', 'Durrad', 'adurrad4', '8e7fb2d4c', 'adurrad4@swiss-galaxy.com'),
('01J78YGVTGF6E7EYJDFHDSQH9Z', 'Julianne', 'Lempenny', 'jlempenny6', '832a58ad8', 'jlempenny6@swiss-galaxy.com'),
('01J78YGVTHJAGCGQJGKVAKHGTJ', 'Barbra', 'Aland', 'baland7', '41bb60323', 'baland7@swiss-galaxy.com'),
('01J78YGVTJTWNW3ZVFA7F38H6K', 'Cris', 'Hitcham', 'chitcham8', '744021192', 'chitcham8@swiss-galaxy.com'),
('01J78YGVTKERS1H14KB9AYN5FN', 'Kacey', 'Deamer', 'kdeamer9', 'cef1d3fcf', 'kdeamer9@swiss-galaxy.com'),
('01J78YGVTNEDMVA1M762M2M86P', 'Charleen', 'Coady', 'ccoadya', '86657877b', 'ccoadya@swiss-galaxy.com'),
('01J78YGVTPP41MAJ0DVEH781X5', 'Jocelin', 'Woffenden', 'jwoffendenb', 'ed7286d3e', 'jwoffendenb@swiss-galaxy.com'),
('01J78YGVTQ29ZD3MB0VB0PTT4Q', 'Blaine', 'Wilkisson', 'bwilkissonc', '928b166dc', 'bwilkissonc@swiss-galaxy.com'),
('01J78YGVTR7153FREQ0NZV77BM', 'Sherry', 'Buggs', 'sbuggsd', 'e4047cd2c', 'sbuggsd@swiss-galaxy.com'),
('01J78YGVTSJZKKVEN61VEMP2NZ', 'Kaja', 'Beadnell', 'kbeadnelle', '77d44cc7b', 'kbeadnelle@swiss-galaxy.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptable`
--
ALTER TABLE `comptable`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
