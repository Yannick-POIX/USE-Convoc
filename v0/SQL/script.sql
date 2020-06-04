-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 26 mai 2020 à 10:48
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `test_1`
--
CREATE DATABASE IF NOT EXISTS `test_1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_1`;

-- --------------------------------------------------------

--
-- Structure de la table `Joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE `joueurs` (
  `id` int(5) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `licence` varchar(15) NOT NULL,
  `etat` int(1) NOT NULL COMMENT '1=>actif  0=>inactif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;
