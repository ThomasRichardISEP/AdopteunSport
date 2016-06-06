-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 10:38 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartenance_club`
--

CREATE TABLE IF NOT EXISTS `appartenance_club` (
  `Pseudo_membre_inscrit` varchar(255) NOT NULL,
  `Titre_club` varchar(255) NOT NULL,
  `Date_inscription` date NOT NULL,
  PRIMARY KEY (`Pseudo_membre_inscrit`,`Titre_club`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appartenance_groupe`
--

CREATE TABLE IF NOT EXISTS `appartenance_groupe` (
  `Pseudo_membre_inscrit` varchar(255) NOT NULL,
  `Titre_groupe` varchar(255) NOT NULL,
  `Date_inscription` date NOT NULL,
  PRIMARY KEY (`Pseudo_membre_inscrit`,`Titre_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appartenance_groupe`
--

INSERT INTO `appartenance_groupe` (`Pseudo_membre_inscrit`, `Titre_groupe`, `Date_inscription`) VALUES
('ElyesMzabi', 'Felix Basket', '2016-06-06'),
('ElyesMzabi', 'Mehdi Natation', '2016-06-06'),
('ElyesMzabi', 'Nithusan Basket', '2016-06-06'),
('ElyesMzabi', 'Thomas Basket', '2016-06-06'),
('FelixWlody', 'Elyes Badminton', '2016-06-06'),
('FelixWlody', 'Mehdi Badminton', '2016-06-06'),
('FelixWlody', 'Vincent Badminton', '2016-06-06'),
('MehdiTouati', 'Mickael football', '2016-06-06'),
('MehdiTouati', 'Thomas football', '2016-06-06'),
('MehdiTouati', 'Vincent Football', '2016-06-06'),
('MickaelPetit', 'Elyes Tennis', '2016-06-06'),
('MickaelPetit', 'Felix Tennis', '2016-06-06'),
('MickaelPetit', 'Mehdi Tennis', '2016-06-06'),
('MickaelPetit', 'Vincent Tennis', '2016-06-06'),
('NithusanRaveendran', 'Mickael football', '2016-06-06'),
('NithusanRaveendran', 'Thomas football', '2016-06-06'),
('NithusanRaveendran', 'Vincent Football', '2016-06-06'),
('ThomasRichard', 'Elyes Natation', '2016-06-06'),
('ThomasRichard', 'Felix Handball', '2016-06-06'),
('ThomasRichard', 'Mickael handball', '2016-06-06'),
('ThomasRichard', 'Nithusan Handball', '2016-06-06'),
('VincentBoutsry', 'Elyes Natation', '2016-06-06'),
('VincentBoutsry', 'Mehdi Natation', '2016-06-06'),
('VincentBoutsry', 'Mickael Natation', '2016-06-06'),
('VincentBoutsry', 'Nithusan Natation', '2016-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `avisclub`
--

CREATE TABLE IF NOT EXISTS `avisclub` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Commentaire` varchar(5000) NOT NULL,
  `Note` int(11) NOT NULL,
  `Pseudo_membre` varchar(255) NOT NULL,
  `Club` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `avisclub`
--

INSERT INTO `avisclub` (`Id`, `Commentaire`, `Note`, `Pseudo_membre`, `Club`) VALUES
(10, 'Ce club est vraiment génial!!', 5, 'ThomasRichard', 'Badminton Lille'),
(11, 'Ce club est vraiment génial!!', 4, 'ThomasRichard', 'Basket Lille'),
(12, 'Ce club est vraiment génial!!', 5, 'ThomasRichard', 'Hand Lille'),
(13, 'Ce club est vraiment génial!!', 4, 'ThomasRichard', 'LOSC'),
(14, 'Ce club est vraiment génial!!', 4, 'ThomasRichard', 'Natation Lille'),
(15, 'Ce club est vraiment génial!!', 5, 'ThomasRichard', 'Tennis Lille'),
(16, 'J''adore ce club!', 4, 'ElyesMzabi', 'Badminton Paris'),
(17, 'J''adore ce club!', 5, 'ElyesMzabi', 'Basket Paris'),
(18, 'J''adore ce club!', 4, 'ElyesMzabi', 'Hand Paris'),
(19, 'J''adore ce club!', 3, 'ElyesMzabi', 'Natation Paris'),
(20, 'J''adore ce club!', 5, 'ElyesMzabi', 'PSG'),
(21, 'J''adore ce club!', 4, 'ElyesMzabi', 'Tennis Paris'),
(22, 'Ce club est pas mal!', 2, 'FelixWlody', 'Badminton Paris'),
(23, 'Ce club est pas mal!', 3, 'FelixWlody', 'Basket Paris'),
(24, 'Ce club est pas mal!', 3, 'FelixWlody', 'Hand Paris'),
(25, 'Ce club est pas mal!', 2, 'FelixWlody', 'Natation Paris'),
(26, 'Ce club est pas mal!', 2, 'FelixWlody', 'PSG'),
(27, 'Ce club est pas mal!', 3, 'FelixWlody', 'Tennis Paris'),
(28, 'J''aime bien ce club!', 3, 'MickaelPetit', 'Badminton Marseille'),
(29, 'J''aime bien ce club!', 4, 'MickaelPetit', 'Basket Marseille'),
(30, 'J''aime bien ce club!', 3, 'MickaelPetit', 'Hand Marseille'),
(31, 'J''aime bien ce club!', 4, 'MickaelPetit', 'Natation Marseille'),
(32, 'J''aime bien ce club!', 4, 'MickaelPetit', 'OM'),
(33, 'J''aime bien ce club!', 3, 'MickaelPetit', 'Tennis Marseille'),
(34, 'Très bon club!', 4, 'VincentBoutsry', 'Badminton Lyon'),
(35, 'Très bon club!', 5, 'VincentBoutsry', 'Basket Lyon'),
(36, 'Très bon club!', 3, 'VincentBoutsry', 'Hand Lyon'),
(37, 'Très bon club!', 4, 'VincentBoutsry', 'Natation Lyon'),
(38, 'Très bon club!', 3, 'VincentBoutsry', 'Tennis Lyon'),
(39, 'Très bon club!', 3, 'MehdiTouati', 'Badminton Lille'),
(40, 'Très bon club!', 3, 'MehdiTouati', 'Basket Lille'),
(41, 'Très bon club!', 5, 'MehdiTouati', 'Hand Lille'),
(42, 'Très bon club!', 5, 'MehdiTouati', 'LOSC'),
(43, 'Très bon club!', 4, 'MehdiTouati', 'Natation Lille'),
(44, 'Très bon club!', 3, 'MehdiTouati', 'Tennis Lille'),
(45, 'Très bon club!', 3, 'NithusanRaveendran', 'Badminton Nantes'),
(46, 'Très bon club!', 5, 'NithusanRaveendran', 'Basket Nantes'),
(47, 'Très bon club!', 4, 'NithusanRaveendran', 'Hand Lille'),
(48, 'Très bon club!', 3, 'NithusanRaveendran', 'FC Nantes'),
(49, 'Très bon club!', 4, 'NithusanRaveendran', 'Hand Nantes'),
(50, 'Très bon club!', 5, 'NithusanRaveendran', 'Natation Nantes'),
(51, 'Très bon club!', 3, 'NithusanRaveendran', 'Tennis Nantes');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `Titre` varchar(255) NOT NULL,
  `Sport` varchar(255) NOT NULL,
  `Descriptif` varchar(5000) NOT NULL,
  `Zone_geographique` varchar(255) NOT NULL,
  `Nb_max_personnes` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Pseudo_membre_createur` varchar(255) NOT NULL,
  `Date_creation` date NOT NULL,
  PRIMARY KEY (`Titre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`Titre`, `Sport`, `Descriptif`, `Zone_geographique`, `Nb_max_personnes`, `Photo`, `Pseudo_membre_createur`, `Date_creation`) VALUES
('Badminton Lille', 'Badminton', 'Club de badminton', 'Lille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Badminton Lyon', 'Badminton', 'Club de badminton', 'Lyon', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Badminton Marseille', 'Badminton', 'Club de basket', 'Marseille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Badminton Nantes', 'Badminton', 'Club de badminton', 'Nantes', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Badminton Paris', 'Badminton', 'Club de badminton', 'Paris', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Basket Lille', 'Basket', 'Club de basket', 'Lille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Basket Lyon', 'Basket', 'Club de basket', 'Lyon', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Basket Marseille', 'Basket', 'Club de basket', 'Marseille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Basket Nantes', 'Basket', 'Club de basket', 'Nantes', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Basket Paris', 'Basket', 'Club de basket', 'Paris', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('FC Nantes', 'Football', 'Club de football', 'Nantes', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Hand Lille', 'Handball', 'Club de handball', 'Lille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Hand Lyon', 'Handball', 'Club de handball', 'Lyon', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Hand Marseille', 'Handball', 'Club de football', 'Marseille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Hand Nantes', 'Handball', 'Club de handball', 'Nantes', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Hand Paris', 'Handball', 'Club de handball', 'Paris', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('LOSC', 'Football', 'Club de football', 'Lille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Natation Lille', 'Natation', 'Club de natation', 'Lille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Natation Lyon', 'Natation', 'Club de natation', 'Lyon', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Natation Marseille', 'Natation', 'Club de natation', 'Marseille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Natation Nantes', 'Natation', 'Club de natation', 'Nantes', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Natation Paris', 'Natation', 'Club de natation', 'Paris', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('OL', 'Football', 'Club de football', 'Lyon', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('OM', 'Football', 'Club de football', 'Marseille', 100, 'I', 'Administrateur1', '2016-06-06'),
('PSG', 'Football', 'Club de football', 'Paris', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Tennis Lille', 'Tennis', 'Club de tennis', 'Lille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Tennis Lyon', 'Tennis', 'Club de tennis', 'Lyon', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Tennis Marseille', 'Tennis', 'Club de tennis', 'Marseille', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Tennis Nantes', 'Tennis', 'Club de tennis', 'Nantes', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06'),
('Tennis Paris', 'Tennis', 'Club de tennis', 'Paris', 100, 'Images/utilisateur.png', 'Administrateur1', '2016-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_event` varchar(255) NOT NULL,
  `Groupe` varchar(255) NOT NULL,
  `Club` varchar(255) NOT NULL,
  `Date_event` date NOT NULL,
  `Heure_event` time NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`Id`, `Nom_event`, `Groupe`, `Club`, `Date_event`, `Heure_event`) VALUES
(3, 'Événement Thomas 1', 'Thomas football', 'LOSC', '2016-06-10', '14:00:00'),
(4, 'Evenement Thomas 2', 'Thomas Handball', 'Hand Paris', '2016-06-20', '14:00:00'),
(5, 'Evenement Thomas 3', 'Thomas Basket', 'Basket Lyon', '2016-06-25', '15:09:00'),
(6, 'Evenement Elyes 1', 'Elyes Natation', 'Natation Paris', '2016-07-02', '14:35:00'),
(7, 'Evenement Elyes 2', 'Elyes Tennis', 'Tennis Marseille', '2016-06-23', '16:00:00'),
(8, 'Evenement Elyes 3', 'Elyes Badminton', 'Badminton Nantes', '2016-08-08', '12:30:00'),
(9, 'Evenement Felix 1', 'Felix Basket', 'Basket Lyon', '2016-06-27', '12:10:00'),
(10, 'Evenement Felix 2', 'Felix Tennis', 'Tennis Marseille', '2016-07-03', '13:45:00'),
(11, 'Evenement Felix 3', 'Felix Handball', 'Hand Paris', '2016-09-09', '14:55:00'),
(12, 'Evenement Mickael 1', 'Mickael football', 'PSG', '2016-07-15', '13:40:00'),
(13, 'Evenement Mickael 2', 'Mickael Natation', 'Natation Lille', '2016-08-24', '20:00:00'),
(14, 'Evenement Mickael 3', 'Mickael handball', 'Hand Nantes', '2016-10-10', '15:00:00'),
(15, 'Evenement Mehdi 1', 'Mehdi Badminton', 'Badminton Marseille', '2016-08-08', '13:01:00'),
(16, 'Evenement Mehdi 2', 'Mehdi Tennis', 'Tennis Lyon', '2016-09-10', '15:00:00'),
(17, 'Evenement Mehdi 3', 'Mehdi Natation', 'Natation Lille', '2016-11-11', '16:30:00'),
(18, 'Evenement Vincent 1', 'Vincent Badminton', 'Badminton Paris', '2016-09-18', '16:00:00'),
(19, 'Evenement Vincent 2', 'Vincent Football', 'LOSC', '2016-10-18', '12:00:00'),
(20, 'Evenement Vincent 3', 'Vincent Tennis', 'Tennis Marseille', '2016-12-12', '15:00:00'),
(21, 'Evenement Nithusan 1', 'Nithusan Basket', 'Basket Nantes', '2016-06-25', '13:00:00'),
(22, 'Evenement Nithusan 2', 'Nithusan Natation', 'Natation Marseille', '2016-07-25', '14:00:00'),
(23, 'Evenement Nithusan 3', 'Nithusan Handball', 'Hand Lille', '2016-09-13', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(5000) NOT NULL,
  `Reponse` varchar(5000) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`Id`, `Question`, `Reponse`) VALUES
(15, 'Comment s''inscrire sur Adopte-un-Sport?', 'Cliquez sur le bouton "Inscription", en haut à droite de la page, puis remplissez le formulaire concernant les informations personnelles.'),
(16, 'Comment se connecter sur Adopte-un-Sport?', 'Cliquez sur le bouton "connexion", en haut à droite de la page, puis saisissez votre Pseudo et votre mot de passe dans le formulaire.'),
(17, 'Comment poster un message sur le forum?', 'Pour poster un message sur le forum, vous devez tout d''abord vous connecter sur votre compte Adopte-un-sport, puis rendez vous sur la page Forum, et saisissez votre post dans le formulaire présent.'),
(18, 'Comment créer un groupe?', 'Pour créer un groupe, vous devez tout d''abord vous connecter à votre espace membre, puis rendez vous sur la page Groupes et remplissez le formulaire de création d''un groupe.'),
(19, 'Comment visualiser les groupes existants?', 'Pour visualiser en détail les groupes existants, que vous soyez connectés ou non, rendez vous sur la page Groupes, puis remplissez le formulaire de recherche d''un groupe, soit par sport, soit par ville.'),
(20, 'Comment créer ou visualiser un club?', 'Se référer aux questions similaires pour les groupes. '),
(21, 'Comment modifier mes informations personnelles?', 'Connectez vous, puis sur votre page Profil, cliquez sur "Modifier mes informations" et changez les données que vous souhaitez.'),
(23, 'Comment modifier les informations d''un groupe dont je suis le leader?', 'Pour modifier les informations d''un groupe dont vous êtes le leader, rendez vous sur votre page profil, puis cliquez sur l''un des groupes se trouvant dans la catégorie "groupes dont je suis le leader".'),
(24, 'Comment créer ou modifier un événement d''un groupe?', 'Rendez vous sur votre page Profil, cliquez sur l''un des groupes dont vous êtes le leader, puis cliquez sur le bouton "gestion des événements". Pour créer un événement, remplissez le formulaire de création. Pour modifier un événement, cliquez sur l''événement voulu, puis modifiez les champs remplis.');

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(255) NOT NULL,
  `Descriptif` varchar(1000) NOT NULL,
  `Zone_geographique` varchar(255) NOT NULL,
  `Nb_max_personnes` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Nom_sport` varchar(255) NOT NULL,
  `Pseudo_membre_createur` varchar(255) NOT NULL,
  `Date_creation` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`Id`, `Titre`, `Descriptif`, `Zone_geographique`, `Nb_max_personnes`, `Photo`, `Nom_sport`, `Pseudo_membre_createur`, `Date_creation`) VALUES
(16, 'Thomas football', 'Groupe de football', 'Lille', 20, 'Images/groupe.jpg', 'Football', 'ThomasRichard', '2016-06-06'),
(17, 'Thomas Handball', 'Groupe de handball', 'Paris', 15, 'Images/groupe.jpg', 'Handball', 'ThomasRichard', '2016-06-06'),
(18, 'Thomas Basket', 'Groupe de basket', 'Lyon', 24, 'Images/groupe.jpg', 'Basket', 'ThomasRichard', '2016-06-06'),
(19, 'Elyes Natation', 'Groupe de natation', 'Paris', 12, 'Images/groupe.jpg', 'Natation', 'ElyesMzabi', '2016-06-06'),
(20, 'Elyes Tennis', 'Groupe de tennis', 'Marseille', 15, 'Images/groupe.jpg', 'Tennis', 'ElyesMzabi', '2016-06-06'),
(21, 'Elyes Badminton', 'Groupe de badminton', 'Nantes', 24, 'Images/groupe.jpg', 'Badminton', 'ElyesMzabi', '2016-06-06'),
(22, 'Mickael football', 'Groupe de football', 'Paris', 30, 'Images/groupe.jpg', 'Football', 'MickaelPetit', '2016-06-06'),
(23, 'Mickael Natation', 'Groupe de natation', 'Lille', 16, 'Images/groupe.jpg', 'Natation', 'MickaelPetit', '2016-06-06'),
(24, 'Mickael handball', 'Groupe de handball', 'Nantes', 17, 'Images/groupe.jpg', 'Handball', 'MickaelPetit', '2016-06-06'),
(25, 'Mehdi Badminton', 'Groupe de badminton', 'Marseille', 12, 'Images/groupe.jpg', 'Badminton', 'MehdiTouati', '2016-06-06'),
(26, 'Mehdi Tennis', 'Groupe de tennis', 'Lyon', 26, 'Images/groupe.jpg', 'Tennis', 'MehdiTouati', '2016-06-06'),
(27, 'Mehdi Natation', 'Groupe de natation', 'Lille', 23, 'Images/groupe.jpg', 'Natation', 'MehdiTouati', '2016-06-06'),
(28, 'Felix Basket', 'Groupe de basket', 'Lyon', 34, 'Images/groupe.jpg', 'Basket', 'FelixWlody', '2016-06-06'),
(29, 'Felix Tennis', 'Groupe de tennis', 'Marseille', 14, 'Images/groupe.jpg', 'Tennis', 'FelixWlody', '2016-06-06'),
(30, 'Felix Handball', 'Groupe de handball', 'Paris', 24, 'Images/groupe.jpg', 'Handball', 'FelixWlody', '2016-06-06'),
(31, 'Vincent Badminton', 'Groupe de badminton', 'Paris', 12, 'Images/groupe.jpg', 'Badminton', 'VincentBoutsry', '2016-06-06'),
(32, 'Vincent Football', 'Groupe de football', 'Lille', 28, 'Images/groupe.jpg', 'Football', 'VincentBoutsry', '2016-06-06'),
(33, 'Vincent Tennis', 'Groupe de tennis', 'Marseille', 40, 'Images/groupe.jpg', 'Tennis', 'VincentBoutsry', '2016-06-06'),
(34, 'Nithusan Basket', 'Groupe de basket', 'Nantes', 24, 'Images/groupe.jpg', 'Basket', 'NithusanRaveendran', '2016-06-06'),
(35, 'Nithusan Natation', 'Groupe de natation', 'Marseille', 39, 'Images/groupe.jpg', 'Natation', 'NithusanRaveendran', '2016-06-06'),
(36, 'Nithusan Handball', 'Groupe de handball', 'Lille', 34, 'Images/groupe.jpg', 'Handball', 'NithusanRaveendran', '2016-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `membre_inscrit`
--

CREATE TABLE IF NOT EXISTS `membre_inscrit` (
  `Pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Date_naissance` date NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Administrateur` int(11) NOT NULL,
  PRIMARY KEY (`Pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membre_inscrit`
--

INSERT INTO `membre_inscrit` (`Pseudo`, `mdp`, `Nom`, `Prenom`, `Date_naissance`, `Mail`, `Adresse`, `Ville`, `Photo`, `Administrateur`) VALUES
('Administrateur1', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Istrateur', 'Admin', '1995-04-25', 'admin@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 1),
('ElyesMzabi', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Mzabi', 'Elyes', '1994-11-11', 'elyes.mzabi@isep.fr', '28 rue Notre-Dame des Champs', 'Paris', 'Images/utilisateur.png', 0),
('FelixWlody', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Wlody', 'Félix', '1995-11-11', 'felix.wlody@isep.fr', '28 rue Notre-Dame des Champs', 'Paris', 'Images/utilisateur.png', 0),
('MehdiTouati', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Touati', 'Mehdi', '1995-11-11', 'mehdi.touati@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Lille', 'Images/utilisateur.png', 0),
('MickaelPetit', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Petit', 'Mickael', '1995-11-11', 'mickael.petit@isep.fr', '28 rue Notre-Dame des Champs', 'Marseille', 'Images/utilisateur.png', 0),
('NithusanRaveendran', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Raveendran', 'Nithusan', '1995-11-07', 'nithusan.raveendran@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Nantes', 'Images/utilisateur.png', 0),
('ThomasRichard', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Richard', 'Thomas', '1995-04-25', 'thomas.richard@isep.fr', '100 Avenue des Champs Elysées', 'Lille', 'Images/photothomas.jpg', 0),
('VincentBoutsry', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Boutsry', 'Vincent', '1995-11-11', 'vincent.boutsry@isep.fr', '28 rue Notre-Dame des Champs', 'Lyon', 'Images/utilisateur.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Prenomauteur` varchar(255) NOT NULL,
  `Nomauteur` varchar(255) NOT NULL,
  `Prenomdestinataire` varchar(255) NOT NULL,
  `Nomdestinataire` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `messagerie`
--

INSERT INTO `messagerie` (`Id`, `Prenomauteur`, `Nomauteur`, `Prenomdestinataire`, `Nomdestinataire`, `Message`) VALUES
(8, 'Thomas', 'Richard', 'Elyes', 'Mzabi', 'Salut Elyes!'),
(9, 'Thomas', 'Richard', 'Mehdi', 'Touati', 'Salut Mehdi!\r\n'),
(10, 'Elyes', 'Mzabi', 'Thomas', 'Richard', 'Salut Thomas!'),
(11, 'Elyes', 'Mzabi', 'Mickael', 'Petit', 'Salut Mickael!'),
(12, 'Mickael', 'Petit', 'Elyes', 'Mzabi', 'Salut Elyes!'),
(13, 'Mickael', 'Petit', 'Vincent', 'Boutsry', 'Salut Vincent!'),
(14, 'Vincent', 'Boutsry', 'Mickael', 'Petit', 'Salut Mickael!'),
(15, 'Vincent', 'Boutsry', 'Nithusan', 'Raveendran', 'Salut Nithusan!'),
(16, 'Nithusan', 'Raveendran', 'Vincent', 'Boutsry', 'Salut Vincent!'),
(17, 'Nithusan', 'Raveendran', 'Felix', 'Wlody', 'Salut Felix!'),
(18, 'Félix', 'Wlody', 'Nithusan', 'Raveendran', 'Salut Nithusan!'),
(19, 'Félix', 'Wlody', 'Mehdi', 'Touati', 'Salut Mehdi!'),
(20, 'Mehdi', 'Touati', 'Felix', 'Wlody', 'Salut Felix!'),
(21, 'Mehdi', 'Touati', 'Thomas', 'Richard', 'Salut Thomas!');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `Id_message` int(11) NOT NULL AUTO_INCREMENT,
  `Contenu` varchar(5000) NOT NULL,
  `Date_message` date NOT NULL,
  `Heure_message` time NOT NULL,
  `Pseudo_membre_inscrit` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`Id_message`, `Contenu`, `Date_message`, `Heure_message`, `Pseudo_membre_inscrit`) VALUES
(26, 'Ceci est mon premier message sur ce forum!', '2016-05-05', '22:15:57', 'ThomasRichard'),
(27, 'Je viens de m''inscrire sur ce site!', '2016-05-05', '22:16:28', 'ElyesMzabi'),
(28, 'Ce site est très pratique pour pratiquer les sports que l''on souhaite!', '2016-05-05', '22:17:01', 'FelixWlody'),
(29, 'Je viens de me connecter sur Adopte un Sport!', '2016-05-05', '22:17:33', 'MickaelPetit');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
