-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 08:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enseignement_a_distance`
--

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `ID` int(11) NOT NULL,
  `CODE_MODULE` tinyint(4) NOT NULL,
  `SEMESTRE` tinyint(4) NOT NULL,
  `FILIERE` int(11) NOT NULL,
  `ENSEIGNANT` int(11) NOT NULL,
  `MODULE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`ID`, `CODE_MODULE`, `SEMESTRE`, `FILIERE`, `ENSEIGNANT`, `MODULE`) VALUES
(1, 1, 1, 1, 2, 1),
(2, 2, 1, 1, 2, 2),
(3, 3, 1, 1, 1, 3),
(4, 4, 1, 1, 2, 4),
(5, 5, 2, 1, 4, 5),
(6, 6, 2, 1, 2, 6),
(7, 7, 2, 1, 4, 7),
(8, 8, 2, 1, 1, 8),
(9, 9, 3, 1, 2, 9),
(10, 10, 3, 1, 1, 10),
(11, 11, 3, 1, 4, 11),
(12, 12, 3, 1, 2, 12),
(13, 13, 4, 1, 2, 13),
(14, 14, 4, 1, 1, 14),
(15, 16, 4, 1, 4, 15),
(16, 17, 4, 1, 1, 24),
(17, 1, 1, 2, 1, 1),
(18, 2, 1, 2, 3, 2),
(19, 3, 1, 2, 1, 3),
(20, 4, 1, 2, 4, 4),
(21, 5, 2, 2, 2, 16),
(22, 6, 2, 2, 4, 17),
(23, 7, 2, 2, 4, 7),
(24, 8, 2, 2, 4, 18),
(25, 9, 3, 2, 1, 19),
(26, 10, 3, 2, 1, 12),
(27, 11, 3, 2, 3, 20),
(28, 12, 3, 2, 3, 21),
(29, 13, 4, 2, 1, 22),
(30, 14, 4, 2, 1, 23),
(31, 16, 4, 2, 1, 15),
(32, 17, 4, 2, 3, 24);

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `ID` int(11) NOT NULL,
  `DATE_ECHEANCE` timestamp NOT NULL DEFAULT current_timestamp(),
  `INTITULE` varchar(255) NOT NULL,
  `CLASSE` int(11) NOT NULL,
  `TYPE_AJOUT` tinyint(1) NOT NULL COMMENT '0 = cours / 1 = exercice',
  `HASH_FICHIER` varchar(255) NOT NULL,
  `TYPE_FICHIER` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`ID`, `DATE_ECHEANCE`, `INTITULE`, `CLASSE`, `TYPE_AJOUT`, `HASH_FICHIER`, `TYPE_FICHIER`) VALUES
(7, '2021-08-11 23:00:00', 'DS', 2, 1, '5f0bf706baf0f4b853c60a7a01ab6adb', 'txt'),
(6, '2021-05-01 00:00:00', 'DS vbvb', 2, 1, '564d6ebec5413de03f52fb969f72c482', 'jpg'),
(8, '2021-04-15 06:46:36', 'DS vbvb', 1, 0, 'e29728a82ed87500e349655d0f244ea7', 'png'),
(9, '2021-08-11 23:00:00', 'sdsdsdsd', 1, 1, 'de36841d60e06c5673b752d7d2b1b7d6', 'txt');

-- --------------------------------------------------------

--
-- Table structure for table `devoir`
--

CREATE TABLE `devoir` (
  `ID` int(11) NOT NULL,
  `HASH_FICHIER` varchar(255) NOT NULL,
  `TYPE_FICHIER` varchar(10) NOT NULL,
  `DATE_ENVOI` timestamp NOT NULL DEFAULT current_timestamp(),
  `COURS` int(11) NOT NULL,
  `ETUDIANT` int(11) NOT NULL,
  `NOTE` decimal(4,2) DEFAULT NULL,
  `REMARQUES` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devoir`
--

INSERT INTO `devoir` (`ID`, `HASH_FICHIER`, `TYPE_FICHIER`, `DATE_ENVOI`, `COURS`, `ETUDIANT`, `NOTE`, `REMARQUES`) VALUES
(2, '6e060dd4d76c4e13ff4e00572fd34d6f', 'jpg', '2021-04-15 05:51:28', 7, 1, '12.05', 'bien'),
(4, '5f0bf706baf0f4b853c60a7a01ab6adb', 'txt', '2021-04-15 06:47:51', 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `ID` int(11) NOT NULL COMMENT '_ENSEIGNANT',
  `PRENOM` varchar(25) NOT NULL,
  `NOM` varchar(25) NOT NULL,
  `EMAIL_DE_ENSEIGNANT` varchar(25) NOT NULL,
  `MOT_DE_PASSE` varchar(10) NOT NULL,
  `ENLIGNE_DEPUIS` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`ID`, `PRENOM`, `NOM`, `EMAIL_DE_ENSEIGNANT`, `MOT_DE_PASSE`, `ENLIGNE_DEPUIS`) VALUES
(1, 'ELMUSTAPHA', 'AIT LMAATI', 'LMAATIMUSTAPHA@YAHOO.FR', '123', '2021-04-03 23:49:48'),
(2, 'GUEZZAZ', 'AZIDINE', 'A.GUZZAZ@GMAIL.COM', '123', '2021-04-12 04:42:14'),
(3, 'SAID', 'GOUNANE', 'GOUNANE.SAID@GMAIL.COM ', '123', '2021-04-03 23:49:48'),
(4, 'FAHD', 'KARAMI', 'FA.KARAMI@UCA.MA ', '123', '2021-04-03 23:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `ID` int(11) NOT NULL COMMENT '_ETUDIANT',
  `PRENOM` varchar(25) NOT NULL,
  `NOM` varchar(25) NOT NULL,
  `EMAIL_DE_ETUDIANT` varchar(255) NOT NULL,
  `CNE` varchar(8) NOT NULL,
  `FILIERE` varchar(15) NOT NULL,
  `MOT_DE_PASSE` varchar(10) NOT NULL,
  `ENLIGNE_DEPUIS` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`ID`, `PRENOM`, `NOM`, `EMAIL_DE_ETUDIANT`, `CNE`, `FILIERE`, `MOT_DE_PASSE`, `ENLIGNE_DEPUIS`) VALUES
(1, 'HAJAR', 'EL AOUNI', 'EL-AOUNI.HAJAR@ESTE.UCA.MA', 'D1384925', '1', '123', '2021-04-15 08:01:12'),
(2, 'REDOUANE', 'BESSIOUA', 'BESSIOUA.REDOUANE@ESTE.UCA.MA', 'K1391219', '1', '123', '2021-04-04 00:25:27'),
(3, 'ISMAIL', 'EL HAJRI', 'EL-HAJRI.ISMAIL@ESTE.UCA.MA', 'G1326598', '1', '123', '2021-04-06 20:17:08'),
(4, 'MOHAMMED', 'LAMKHANTAR', 'LAMKHANTAR.MOHAMMED@ESTE.UCA.MA', 'G1353504', '1', '123', '2021-04-04 00:25:27'),
(5, 'YOUNESS', 'KARAMI', 'KARAMI.YOUNESS@ESTE.UCA.MA', 'R1383500', '1', '123', '2021-04-04 00:25:27'),
(6, 'FAISSAL', 'EZZOUAOUI', 'EZZOUAOUI.FAISSAL@ESTE.UCA.MA', 'G1430342', '1', '123', '2021-04-04 00:25:27'),
(7, 'ALAE', 'TRACHLI', 'TRACHLI.ALAE@ESTE.UCA.MA', 'P1382207', '1', '123', '2021-04-05 22:26:15'),
(8, 'HAKIMA', 'EL MENANI', 'EL-MENANI.HAKIMA@ESTE.UCA.MA', 'G1330750', '1', '123', '2021-04-04 00:25:27'),
(9, 'MOHAMED', 'FAKIR', 'FAKIR.MOHAMED@ESTE.UCA.MA', 'F1312720', '1', '123', '2021-04-04 00:25:27'),
(10, 'YOUNESS', 'LAHRIRISS', 'LAHRIRISS.YOUNESS@ESTE.UCA.MA', 'E1440593', '1', '123', '2021-04-04 00:25:27'),
(11, 'NIZAR', 'HAFAYAN', 'HAFAYAN.NIZAR@ESTE.UCA.MA', 'R1358994', '1', '123', '2021-04-04 00:25:27'),
(12, 'RACHID', 'ZIANE', 'ZIANE.RACHID@ESTE.UCA.MA', 'D1300255', '1', '123', '2021-04-04 00:25:27'),
(13, 'YASSAMINE', 'KADDAF', 'KADDAF.YASSAMINE@ESTE.UCA.MA', 'K1384739', '1', '123', '2021-04-04 00:25:27'),
(14, 'MOUAAD', 'RAHIM', 'RAHIM.MOUAAD@ESTE.UCA.MA', 'D1328400', '1', '123', '2021-04-04 00:25:27'),
(15, 'HANANE', 'STITOU', 'STITOU.HANANE@ESTE.UCA.MA', 'G1383423', '1', '123', '2021-04-04 00:25:27'),
(16, 'MOUAAD', 'EL BAKILI', 'EL-BAKILI.MOUAAD@ESTE.UCA.MA', 'D1410469', '1', '123', '2021-04-04 00:25:27'),
(17, 'JAMILA', 'KATIBI', 'KATIBI.JAMILA@ESTE.UCA.MA', 'G1328270', '1', '123', '2021-04-04 00:25:27'),
(18, 'YASSINE', 'CHERQAOUI', 'CHERQAOUI.YASSINE@ESTE.UCA.MA', 'G1344619', '1', '123', '2021-04-04 00:25:27'),
(19, 'MARYAM', 'ASSKAKE', 'ASSKAKE.MARYAM@ESTE.UCA.MA', 'D1470280', '1', '123', '2021-04-04 00:25:27'),
(20, 'MOHAMED', 'AIT SI', 'AIT-SI.MOHAMED@ESTE.UCA.MA', 'D1398917', '1', '123', '2021-04-04 00:25:27'),
(21, 'MARIEM', 'BOUFFI', 'BOUFFI.MARIEM@ESTE.UCA.MA', 'D1367359', '1', '123', '2021-04-04 00:25:27'),
(22, 'LATIFA', 'SALAH EDDINE', 'SALAH-EDDINE.LATIFA@ESTE.UCA.MA', 'D1320523', '2', '123', '2021-04-04 00:25:27'),
(23, 'ANAS', 'HAIDOURI', 'HAIDOURI.ANAS@ESTE.UCA.MA', 'Z1978001', '2', '123', '2021-04-04 00:25:27'),
(24, 'CHAIMA', 'KIKIH', 'KIKIH.CHAIMA@ESTE.UCA.MA', 'G1383423', '2', '123', '2021-04-04 00:25:27'),
(25, 'SALAH', 'BEN SARAR', 'BEN-SARAR.SALAH@ESTE.UCA.MA', 'L1420072', '2', '123', '2021-04-04 00:25:27'),
(26, 'NADIA', 'LECHGUER', 'LECHGUER.NADIA@ESTE.UCA.MA', 'D1308970', '2', '123', '2021-04-04 00:25:27'),
(27, 'NAOUFAL', 'MANDOUR', 'MANDOUR.NAOUFAL@ESTE.UCA.MA', 'G1385135', '2', '123', '2021-04-04 00:25:27'),
(28, 'CHAIMA', 'IDRISSI', 'IDRISSI.CHAIMA@ESTE.UCA.MA', 'D1450471', '2', '123', '2021-04-04 00:25:27'),
(29, 'INASS', 'ELOUAFI', 'ELOUAFI.INASS@ESTE.UCA.MA', 'K1352577', '2', '123', '2021-04-04 00:25:27'),
(30, 'MARYAM', 'SAKAM', 'SAKAM.MARYAM@ESTE.UCA.MA', 'D1373624', '2', '123', '2021-04-04 00:25:27'),
(31, 'MANAL', 'MENSOUR', 'MENSOUR.MANAL@ESTE.UCA.MA', 'G1396183', '2', '123', '2021-04-04 00:25:27'),
(32, 'IMANE', 'MAZZOUR', 'MAZZOUR.IMANE@ESTE.UCA.MA', 'N1312607', '2', '123', '2021-04-04 00:25:27'),
(33, 'YOUSSEF', 'TALIBI', 'TALIBI.YOUSSEF@ESTE.UCA.MA', 'D1311236', '2', '123', '2021-04-04 00:25:27'),
(34, 'FATIMA-EZZAHRAE', 'LAHMIDI', 'LAHMIDI.FATIMA-EZZAHRAE@ESTE.UCA.MA', 'G1200105', '2', '123', '2021-04-04 00:25:27'),
(35, 'MONCIF', 'EL OMARI', 'EL-OMARI.MONCIF@ESTE.UCA.MA', 'G1370760', '2', '123', '2021-04-04 00:25:27'),
(36, 'OUMAIMA', 'AKALABBOU', 'AKALABBOU.OUMAIMA@ESTE.UCA.MA', 'G1321091', '2', '123', '2021-04-04 00:25:27'),
(37, 'YOUNES', 'AITOUNI', 'AITOUNI.YOUNES@ESTE.UCA.MA', 'K1324088', '2', '123', '2021-04-04 00:25:27'),
(38, 'OUSSAMA', 'ESSAADI', 'ESSAADI.OUSSAMA@ESTE.UCA.MA', 'R1301665', '2', '123', '2021-04-04 00:25:27'),
(39, 'KHADIJA', 'HALLABOU', 'HALLABOU.KHADIJA@ESTE.UCA.MA', 'G1332287', '2', '123', '2021-04-04 00:25:27'),
(40, 'HIND', 'TABIA', 'TABIA.HIND@ESTE.UCA.MA', 'K1352560', '2', '123', '2021-04-04 00:25:27'),
(41, 'KHADIJA', 'KAMAL', 'KAMAL.KHADIJA@ESTE.UCA.MA', 'G1364294', '2', '123', '2021-04-04 00:25:27'),
(42, 'HOUSSAM', 'BOUSNINA', 'BOUSNINA.HOUSSAM@ESTE.UCA.MA', 'F1313090', '2', '123', '2021-04-04 00:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `ID` int(11) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `ABREVIATION` varchar(5) NOT NULL,
  `TYPE_FORMATION` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`ID`, `NOM`, `ABREVIATION`, `TYPE_FORMATION`) VALUES
(1, 'Génie Informatique', 'GI', 0),
(2, 'Informatique Décisionnelle et Science de Données', 'IDSD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `DATE_ENVOI` timestamp NOT NULL DEFAULT current_timestamp(),
  `CLASSE` int(11) NOT NULL,
  `ETUDIANT` int(11) NOT NULL COMMENT '0 = tous les etudiants de la classe',
  `SENS` tinyint(1) NOT NULL COMMENT '1 = DESTINATION ETUDIANT / 0 = destination ENSEIGNANT',
  `MESSAGE` text NOT NULL,
  `VU` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID`, `DATE_ENVOI`, `CLASSE`, `ETUDIANT`, `SENS`, `MESSAGE`, `VU`) VALUES
(1, '2021-04-11 15:50:03', 2, 0, 1, 'vkjvjvkjvv', 0),
(2, '2021-04-11 15:50:07', 2, 0, 1, 'fkjdkjfdkjfdkjfd', 0),
(3, '2021-04-11 15:50:09', 2, 0, 1, 'dfjdfjdfkjdkjfd', 0),
(4, '2021-04-11 16:27:44', 2, 1, 1, 'juujuj', 0),
(5, '2021-04-11 16:27:49', 2, 1, 1, 'ujujujuj', 0),
(6, '2021-04-11 16:30:46', 2, 0, 1, 'fgkfkgflkfglfgf', 0),
(7, '2021-04-11 16:31:55', 2, 1, 0, 'gfgfgf', 0),
(8, '2021-04-11 17:03:41', 2, 1, 0, 'ffffffffffffffffffffffffffffffffffff', 0),
(9, '2021-04-11 17:51:55', 4, 1, 0, 'iuiu', 0),
(10, '2021-04-11 17:53:42', 2, 1, 0, 'iuiuiu', 0),
(11, '2021-04-11 23:28:34', 1, 1, 1, 'uyuyuy', 0),
(12, '2021-04-12 02:42:00', 1, 0, 1, '7878', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `ID` int(11) NOT NULL,
  `NOM` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`ID`, `NOM`) VALUES
(1, 'Langues et Techniques d’Expression'),
(2, 'Mathématiques'),
(3, 'Architecture des ordinateurs Et électronique numérique'),
(4, 'Algorithmique et Programmation'),
(5, 'Programmation Avancée'),
(6, 'Langues et Techniques de Communication'),
(7, 'Systèmes d’Information et Bases de Données'),
(8, 'Systèmes d’Exploitation'),
(9, 'Mathématiques Appliquées'),
(10, 'Programmation Web et Multimédia'),
(11, 'Génie Logiciel'),
(12, 'Bases de Données Avancées'),
(13, 'Réseaux Informatiques'),
(14, 'Préparation à La Vie Active'),
(15, 'Projet Fin d’étude'),
(16, 'Python pour la science des données'),
(17, 'Programmation Web'),
(18, 'Systèmes et Réseaux'),
(19, 'Modélisation et programmation orientée objet JAVA'),
(20, 'Mathématiques pour l’analyse des données'),
(21, 'Communication et organisation des entreprises'),
(22, 'Data mining'),
(23, 'Machine Learning'),
(24, 'Stage Technique');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `devoir`
--
ALTER TABLE `devoir`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `devoir`
--
ALTER TABLE `devoir`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '_ENSEIGNANT', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '_ETUDIANT', AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
