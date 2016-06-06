-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 10:06 AM
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
('ElyesMzabi', 'LOSC', '2016-05-23'),
('ElyesMzabi', 'PSG', '0000-00-00'),
('ThomasRichard', 'LOSC', '0000-00-00'),
('ThomasRichard', 'OL', '2016-05-23'),
('ThomasRichard', 'OM', '2016-05-23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `avisclub`
--

INSERT INTO `avisclub` (`Id`, `Commentaire`, `Note`, `Pseudo_membre`, `Club`) VALUES
(1, 'test', 3, 'ThomasRichard', 'LOSC'),
(4, 'coucou', 1, 'ThomasRichard', 'LOSC'),
(5, 'tegtev', 2, 'ElyesMzabi', 'LOSC'),
(6, 'j''adore ce club', 4, 'ThomasRichard', 'OL'),
(7, 'thomas', 4, 'ThomasRichard', 'LOSC'),
(8, 'top\r\n', 5, 'ThomasRichard', 'PSG');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`Id`, `Titre`, `Descriptif`, `Zone_geographique`, `Nb_max_personnes`, `Photo`, `Nom_sport`, `Pseudo_membre_createur`, `Date_creation`) VALUES
(13, 'FranceHandball', 'Groupe de handball', 'Paris', 10, '', 'Handball', 'ThomasRichard', '2016-06-01');

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
('ElyesMzabi', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Mzabi', 'Elyes', '1995-11-11', 'elyes.mzabi@isep.fr', '28 rue Notre-Dame des Champs', 'Paris', 'Images/utilisateur.png', 0),
('MehdiTouati', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Touati', 'Mehdi', '1995-11-11', 'mehdi.touati@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 0),
('MickaelPetit', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Petit', 'Mickael', '1995-11-11', 'mickael.petit@isep.fr', '28 rue Notre-Dame des Champs', 'Paris', 'Images/utilisateur.png', 0),
('NithusanRaveendran', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Raveendran', 'Nithusan', '1995-11-07', 'nithusan.raveendran@isep.fr', '28 rue Notre-Dame des Champs Paris', 'Paris', 'Images/utilisateur.png', 0),
('ThomasRichard', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'Richard', 'Thomas', '1995-04-25', 'thomas.richard@isep.fr', '100 Avenue des Champs Elysées', 'Lille', 'Images/photothomas.jpg', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `messagerie`
--

INSERT INTO `messagerie` (`Id`, `Prenomauteur`, `Nomauteur`, `Prenomdestinataire`, `Nomdestinataire`, `Message`) VALUES
(1, 'Thomas', 'Richard', 'Elyes', 'Mzabi', 'message 1'),
(2, 'Thomas', 'Richard', 'Elyes', 'Mzabi', 'message2'),
(3, 'Elyes', 'Mzabi', 'Thomas', 'Richard', 'reponse ok\r\n'),
(4, 'Thomas', 'Richard', 'Thomas', 'Mzabi', 'message 3'),
(5, 'Thomas', 'Richard', 'Elyes', 'mdp', ''),
(6, 'Thomas', 'Richard', 'Elyes', 'Mzabi', 'mesage final\r\n'),
(7, 'Elyes', 'Mzabi', 'Thomas', 'Richard', 'reponse final\r\n');

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
