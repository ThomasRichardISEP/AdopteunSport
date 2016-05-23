-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2016 at 10:15 AM
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

--
-- Dumping data for table `appartenance_club`
--

INSERT INTO `appartenance_club` (`Pseudo_membre_inscrit`, `Titre_club`, `Date_inscription`) VALUES
('ElyesMzabi', 'PSG', '0000-00-00'),
('ThomasRichard', 'LOSC', '0000-00-00');

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
('', 'groupetest', '0000-00-00'),
('ElyesMzabi', 'Club de foot pour les nuls', '0000-00-00'),
('ThomasRichard', 'groupetest', '0000-00-00');

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
  `Heure` time NOT NULL,
  PRIMARY KEY (`Titre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`Titre`, `Sport`, `Descriptif`, `Zone_geographique`, `Nb_max_personnes`, `Photo`, `Pseudo_membre_createur`, `Date_creation`, `Heure`) VALUES
('LilleHand', 'Handball', 'Club de Handball', 'Lille', 0, '', '', '0000-00-00', '00:00:00'),
('LOSC', 'Football', 'Club de football', 'Lille', 0, '', '', '0000-00-00', '00:00:00'),
('Lyon Handball', 'Handball', 'Club de Handball', 'Lyon', 0, '', '', '0000-00-00', '00:00:00'),
('OL', 'Football', 'Club de football', 'Lyon', 0, '', '', '0000-00-00', '00:00:00'),
('OM', 'Football', 'Club de Football', 'Marseille', 0, '', '', '0000-00-00', '00:00:00'),
('Paris FC', 'Football', 'Club de football', 'Paris', 0, '', '', '0000-00-00', '00:00:00'),
('Paris Handball', 'Handball', 'Club de Handball', 'Paris', 0, '', '', '0000-00-00', '00:00:00'),
('PSG', 'Football', 'Club de football', 'Paris', 0, '', '', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `creer`
--

CREATE TABLE IF NOT EXISTS `creer` (
  `Pseudo_administrateur` varchar(255) NOT NULL,
  `Id_questions/reponses` int(11) NOT NULL,
  PRIMARY KEY (`Pseudo_administrateur`,`Id_questions/reponses`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(5000) NOT NULL,
  `Reponse` varchar(5000) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`Id`, `Question`, `Reponse`) VALUES
(9, 'question 1', 'reponse 1'),
(14, 'Question 3', 'reponse 3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`Id`, `Titre`, `Descriptif`, `Zone_geographique`, `Nb_max_personnes`, `Photo`, `Nom_sport`, `Pseudo_membre_createur`, `Date_creation`) VALUES
(1, 'Club de foot pour les forts', 'Club de football', 'Lille', 20, '', 'Football', 'ThomasRichard', '2016-05-11'),
(2, 'Club de foot pour les nuls', 'Club de', 'Paris', 15, '', 'Football', 'ThomasRichard', '2016-05-11'),
(3, 'Club de thomas', 'Club de football', 'Lille', 10, '', 'Football', 'ThomasRichard', '2016-05-11'),
(4, 'Club de toto', 'Club de football', 'Lyon', 10, '', 'Football', 'ThomasRichard', '2016-05-11'),
(5, 'Club de hand fort', 'Club de handball', 'Lille', 14, '', 'Handball', 'ThomasRichard', '2016-05-11'),
(6, 'Club de hand nul', 'Club de handball', 'Paris', 23, '', 'Handball', 'ThomasRichard', '2016-05-11'),
(7, 'groupetest', 'Club de football', 'Lille', 12, '', 'football', 'ThomasRichard', '2016-05-19'),
(8, 'grpadmin', 'Club de football', 'Lille', 20, '', 'Football', 'Administrateur1', '2016-05-23');

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
('Administrateur1', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Richard', 'Thomas', '1995-04-25', 'tho-richard@sfr.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/photothomas.jpg', 1),
('ElyesMzabi', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Mzabi', 'Elyes', '1995-11-11', 'elyes.mzabi@isep.fr', '28 rue Notre-Dame des Champs Paris', 'paris', 'Images/utilisateur.png', 0),
('FelixWlody', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Wlody', 'Félix', '1995-11-11', 'felix.wlody@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 0),
('MehdiTouati', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Touati', 'Mehdi', '1995-11-11', 'mehdi.touati@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 0),
('MickaelPetit', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Petit', 'Mickael', '1995-11-11', 'mickael.petit@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 0),
('NithusanRaveendran', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Raveendran', 'Nithusan', '1995-11-07', 'nithusan.raveendran@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 0),
('ThomasRichard', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Richard', 'Thomas', '1995-04-25', 'thomas.richard@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Lille', 'Images/photothomas.jpg', 0),
('VincentBoutsry', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Boutsry', 'Vincent', '1995-11-11', 'vincent.boutsry@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Lyon', 'Images/utilisateur.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `Prenomauteur` varchar(255) NOT NULL,
  `Nomauteur` varchar(255) NOT NULL,
  `Prenomdestinataire` varchar(255) NOT NULL,
  `Nomdestinataire` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  PRIMARY KEY (`Prenomauteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagerie`
--

INSERT INTO `messagerie` (`Prenomauteur`, `Nomauteur`, `Prenomdestinataire`, `Nomdestinataire`, `Message`) VALUES
('Elyes', 'Mzabi', 'Thomas', 'Richard', 'premier message'),
('Thomas', 'Richard', 'Elyes', 'Mzabi', 'Reponse premiere');

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
(29, 'Je viens de me connecter sur Adopte un Sport!', '2016-05-05', '22:17:33', 'MickaelPetit'),
(30, 'Je peux trouver des clubs proche de chez moi!', '2016-05-05', '22:18:14', 'NithusanRaveendran'),
(31, 'Je profite pleinement de toutes les fonctionnalités de ce site!', '2016-05-05', '22:18:43', 'MehdiTouati'),
(32, 'Ce site m''est très utile pour pratiquer un sport avec de nouvelles personnes!', '2016-05-05', '22:19:26', 'VincentBoutsry');

-- --------------------------------------------------------

--
-- Table structure for table `pratique`
--

CREATE TABLE IF NOT EXISTS `pratique` (
  `Pseudo_membre_inscrit` varchar(255) NOT NULL,
  `Nom_sport` varchar(255) NOT NULL,
  PRIMARY KEY (`Pseudo_membre_inscrit`,`Nom_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `Id_planning` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Lieu_rencontre` varchar(255) NOT NULL,
  `Pseudo_Membre_inscrit` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_planning`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE IF NOT EXISTS `sport` (
  `Nom` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
