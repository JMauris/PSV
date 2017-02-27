-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Février 2017 à 12:52
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `psv`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `direct_update_Report` ()  BEGIN
	delete from ola_direct;
 
	insert into ola_direct
	select
		id_intrevention, date, duration, 1 as annonyme, intervenant_id
	FROM intreventions
	WHERE person_id IS NULL;

	insert into ola_direct
	select
		id_intrevention, date, duration, 1 as annonyme, intervenant_id
	FROM intreventions, persons
	WHERE 
		intreventions.person_id = persons.id_Person
		AND persons.name = '';


	insert into ola_direct
	select
		id_intrevention, date, duration, 0 as annonyme, intervenant_id
	FROM intreventions, persons
	WHERE
		intreventions.person_id = persons.id_Person
		AND persons.name <> '';

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `indirect_update_Report` ()  BEGIN
delete from ola_indirect;

insert into ola_indirect
	SELECT 
		id_indirect as indirect_id,
		owner as user_id,
		date as date,
		`prestation-group`.id_presstationGroup as prestGroup_id,
        prestation_id as prest_id,
		duration as duration
	FROM
		indirect
		join indirect_has_prestations
			on indirect.id_indirect = indirect_has_prestations.indirect_id
		join prestation
			on indirect_has_prestations.prestation_id = prestation.id_prestation
		join `prestation-group`
			on `prestation-group`.id_presstationGroup = prestation.prestation_group;

insert into ola_indirect

	SELECT 
		id_indirect as indirect_id,
		user_id as user_id,
		date as date,
		`prestation-group`.id_presstationGroup as prestGroup_id,
		prestation_id as prest_id,
		duration as duration
	FROM
		indirect
		join indirect_has_called
			on indirect.id_indirect = indirect_has_called.indirect_id
		join indirect_has_prestations
			on indirect.id_indirect = indirect_has_prestations.indirect_id
		join prestation
			on indirect_has_prestations.prestation_id = prestation.id_prestation
		join `prestation-group`
			on `prestation-group`.id_presstationGroup = prestation.prestation_group;
END$$


DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `place_Id` int(11) NOT NULL,
  `line_1` varchar(45) NOT NULL,
  `line_2` varchar(45) DEFAULT NULL,
  `city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `age_groups`
--

CREATE TABLE `age_groups` (
  `id_ages_goup` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `age_groups`
--

INSERT INTO `age_groups` (`id_ages_goup`, `name`, `activated`, `position`) VALUES
(0, 'Groupe d''age', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `citys`
--

CREATE TABLE `citys` (
  `id_city` int(11) NOT NULL,
  `npa` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `citys`
--

INSERT INTO `citys` (`id_city`, `npa`, `name`, `activated`) VALUES
(6, 3922, 'Ackersand', 0),
(7, 3951, 'Agarn', 0),
(8, 3955, 'Albinen', 0),
(9, 1905, 'Allesse', 0),
(10, 3963, 'Aminona', 0),
(11, 3973, 'Anchettes', 0),
(12, 1972, 'Anzère', 0),
(13, 1994, 'Aproz', 0),
(14, 1974, 'Arbaz', 0),
(15, 1957, 'Ardon', 0),
(16, 1966, 'Argnoud (Ayent)', 0),
(17, 1986, 'Arolla', 0),
(18, 1991, 'Arvillard (Salins)', 0),
(19, 1914, 'Auddes-sur-Riddes', 0),
(20, 3938, 'Ausserberg', 0),
(21, 3995, 'Ausserbinn', 0),
(22, 1976, 'Aven', 0),
(23, 1966, 'Ayent', 0),
(24, 3961, 'Ayer', 0),
(25, 1996, 'Baar (Nendaz)', 0),
(26, 1934, 'Bagnes', 0),
(27, 3937, 'Baltschieder', 0),
(28, 1996, 'Basse-Nendaz', 0),
(29, 3914, 'Belalp', 0),
(30, 3997, 'Bellwald', 0),
(31, 3999, 'Belvedere (Furka)', 0),
(32, 3900, 'Berisal', 0),
(33, 3991, 'Betten', 0),
(34, 3992, 'Bettmeralp', 0),
(35, 1996, 'Beuson', 0),
(36, 3989, 'Biel VS', 0),
(37, 1996, 'Bieudron', 0),
(38, 3996, 'Binn', 0),
(39, 1996, 'Bioley-de-Brignon', 0),
(40, 3903, 'Birgisch', 0),
(41, 3983, 'Bister', 0),
(42, 3982, 'Bitsch', 0),
(43, 3914, 'Blatten b. Naters', 0),
(44, 3919, 'Blatten(Lötschen)', 0),
(45, 1966, 'Blignoud (Ayent)', 0),
(46, 3989, 'Blitzingen', 0),
(47, 3975, 'Bluche-Randogne', 0),
(48, 1966, 'Botyre (Ayent)', 0),
(49, 1946, 'Bourg-St-Bernard', 0),
(50, 1946, 'Bourg-St-Pierre', 0),
(51, 1897, 'Bouveret', 0),
(52, 1932, 'Bovernier', 0),
(53, 1967, 'Bramois', 0),
(54, 1944, 'Branche', 0),
(55, 1926, 'Branson', 0),
(56, 3957, 'Bratsch', 0),
(57, 3983, 'Breiten', 0),
(58, 3966, 'Briey', 0),
(59, 3900, 'Brig', 0),
(61, 3981, 'Brig Ausgänge', 0),
(63, 3900, 'Brig Paketbasis', 0),
(65, 3900, 'Brigerbad', 0),
(66, 1996, 'Brignon', 0),
(67, 3900, 'Brigue', 0),
(68, 1934, 'Bruson', 0),
(69, 3935, 'Bürchen', 0),
(70, 1987, 'Cerise', 0),
(71, 3966, 'Chalais', 0),
(72, 1933, 'Chamoille', 0),
(73, 1955, 'Chamoson', 0),
(74, 1874, 'Champéry', 0),
(75, 1938, 'Champex', 0),
(76, 1971, 'Champlan', 0),
(77, 1873, 'Champoussin', 0),
(78, 1947, 'Champsec', 0),
(79, 3976, 'Champzabé', 0),
(80, 3961, 'Chandolin', 0),
(81, 1965, 'Chandolin-Savièse', 0),
(82, 1945, 'Chandonne (Liddes)', 0),
(83, 1906, 'Charrat', 0),
(84, 1926, 'Châtaignier', 0),
(85, 1964, 'Châteauneuf (Cont)', 0),
(86, 1962, 'Châtroz', 0),
(87, 3978, 'Chelin', 0),
(88, 1872, 'Chemex', 0),
(89, 1927, 'Chemin', 0),
(90, 1927, 'Chemin-Dessous', 0),
(91, 1927, 'Chemin-Dessus', 0),
(92, 3971, 'Chermignon', 0),
(93, 3971, 'Chermignon-Bas', 0),
(94, 1945, 'Chez Petit(Liddes)', 0),
(95, 1937, 'Chez-les-Addy', 0),
(96, 1937, 'Chez-les-Giroud', 0),
(97, 1937, 'Chez-les-Reuses', 0),
(98, 1926, 'Chiboz', 0),
(99, 3965, 'Chippis', 0),
(100, 1871, 'Choëx', 0),
(101, 1993, 'Clèbes (Veysonnaz)', 0),
(102, 1868, 'Collombey', 0),
(103, 1903, 'Collonges', 0),
(104, 1971, 'Coméraz(Grimisuat)', 0),
(105, 1937, 'Commeire', 0),
(106, 1996, 'Condémines', 0),
(107, 1964, 'Conthey', 0),
(108, 1975, 'Conthey-Bourg', 0),
(109, 3974, 'Conzor', 0),
(110, 1996, 'Coor', 0),
(111, 3960, 'Corin-de-la-Crête', 0),
(112, 1934, 'Cotterg(Le Châble)', 0),
(113, 3963, 'Crans-Montana', 0),
(114, 1941, 'Cries (Vollèges)', 0),
(115, 3979, 'Daillet', 0),
(116, 1976, 'Daillon', 0),
(117, 1890, 'Dailly', 0),
(118, 3973, 'Darnona', 0),
(119, 1891, 'Daviaz', 0),
(120, 3993, 'Deisch', 0),
(121, 1976, 'Derborence', 0),
(122, 3963, 'Diogne', 0),
(123, 1950, 'Diolly', 0),
(124, 1905, 'Dorénaz', 0),
(125, 1945, 'Dranse (Liddes)', 0),
(126, 1965, 'Drône VS', 0),
(127, 1912, 'Dugny (Leytron)', 0),
(128, 1908, 'Ecône', 0),
(129, 3939, 'Eggerberg', 0),
(130, 3984, 'Eggishorn', 0),
(131, 3943, 'Eischoll', 0),
(132, 1969, 'Eison', 0),
(133, 3909, 'Eisten', 0),
(134, 3919, 'Eisten (Lötschen)', 0),
(135, 3926, 'Embd', 0),
(136, 3948, 'Ems VS', 0),
(137, 1890, 'Epinassey', 0),
(138, 1976, 'Erde', 0),
(139, 3979, 'Erdesson', 0),
(140, 3947, 'Ergisch', 0),
(141, 3995, 'Ernen', 0),
(142, 3957, 'Erschmatt', 0),
(143, 1941, 'Etiez', 0),
(144, 1982, 'Euseigne', 0),
(145, 1902, 'Evionnaz', 0),
(146, 1983, 'Evolène', 0),
(147, 3931, 'Eyholz', 0),
(148, 3919, 'Fafleralp', 0),
(149, 3961, 'Fang', 0),
(150, 3916, 'Ferden', 0),
(151, 1984, 'Ferpècle', 0),
(152, 3956, 'Feschel', 0),
(153, 1996, 'Fey (Nendaz)', 0),
(154, 3984, 'Fiesch', 0),
(155, 3984, 'Fieschertal', 0),
(156, 3983, 'Filet', 0),
(157, 1925, 'Finhaut', 0),
(158, 1948, 'Fionnay', 0),
(159, 3978, 'Flanthey', 0),
(160, 1945, 'Fontaine Dessous', 0),
(161, 1945, 'Fontaine Dessus', 0),
(162, 1934, 'Fontenelle', 0),
(163, 1945, 'Fornex(Liddes)', 0),
(164, 1966, 'Fortunau (Ayent)', 0),
(165, 1926, 'Fully', 0),
(166, 3997, 'Fürgangen', 0),
(167, 3907, 'Gabi (Simplon)', 0),
(168, 3945, 'Gampel', 0),
(169, 3900, 'Gamsen', 0),
(170, 3924, 'Gasenried', 0),
(171, 3904, 'Geimen', 0),
(172, 3981, 'Geschinen', 0),
(173, 3945, 'Getwing', 0),
(174, 1925, 'Giétroz', 0),
(175, 3999, 'Gletsch', 0),
(176, 3902, 'Glis', 0),
(177, 3998, 'Gluringen', 0),
(178, 3907, 'Gondo', 0),
(179, 3917, 'Goppenstein', 0),
(180, 3983, 'Goppisberg', 0),
(181, 3920, 'Gornergrat', 0),
(182, 3925, 'Grächen', 0),
(183, 3989, 'Grafschaft', 0),
(184, 1946, 'Grand-St-Bernard', 0),
(185, 1922, 'Granges (Salvan)', 0),
(186, 3977, 'Granges VS', 0),
(187, 1965, 'Granois (Savièse)', 0),
(188, 3983, 'Greich', 0),
(189, 3993, 'Grengiols', 0),
(190, 3961, 'Grimentz', 0),
(191, 1971, 'Grimisuat', 0),
(192, 3999, 'Grimsel Passhöhe', 0),
(193, 3979, 'Grône', 0),
(194, 3946, 'Gruben', 0),
(195, 1955, 'Grugnay (Chamoson)', 0),
(196, 3933, 'Gspon', 0),
(197, 1920, 'Gueuroz', 1),
(198, 3956, 'Guttet', 0),
(199, 3956, 'Guttet-Feschel', 0),
(200, 1997, 'Haute-Nendaz', 0),
(201, 3927, 'Herbriggen', 0),
(202, 1987, 'Hérémence', 0),
(203, 3949, 'Hohtenn', 0),
(204, 1977, 'Icogne', 0),
(205, 1893, 'Illarsaz', 0),
(206, 3953, 'Inden', 0),
(207, 1914, 'Isérables', 0),
(208, 1937, 'Issert', 0),
(209, 3979, 'Itravers', 0),
(210, 3945, 'Jeizinen', 0),
(211, 3801, 'Jungfraujoch', 0),
(212, 3922, 'Kalpetran', 0),
(213, 3917, 'Kippel', 0),
(214, 1902, 'La Balmaz', 0),
(215, 1920, 'La Bâtiaz', 1),
(216, 1921, 'La Caffe', 0),
(217, 1991, 'La Courtaz', 0),
(218, 1923, 'La Creusaz', 0),
(219, 1937, 'La Douay', 0),
(220, 1921, 'La Fontaine', 0),
(221, 1985, 'La Forclaz VS', 0),
(222, 1920, 'La Forclaz(Trient)', 1),
(223, 1944, 'La Fouly VS', 0),
(224, 1933, 'La Garde', 0),
(225, 1982, 'La Luette', 0),
(226, 1947, 'La Montoz', 0),
(227, 1950, 'La Muraz', 0),
(228, 1966, 'La Place (Ayent)', 0),
(229, 1902, 'La Rasse VS', 0),
(230, 1937, 'La Rosière', 0),
(231, 1985, 'La Sage', 0),
(232, 1943, 'La Seiloz', 0),
(233, 1950, 'La Sionne', 0),
(234, 1992, 'La Vernaz', 0),
(235, 3931, 'Lalden', 0),
(236, 1983, 'Lana (Evolène)', 0),
(237, 3994, 'Lax', 0),
(240, 1997, 'Le Bleusy', 0),
(241, 1932, 'Le Borgeaud', 0),
(242, 1921, 'Le Brocard', 0),
(243, 1921, 'Le Cergneux VS', 0),
(244, 1934, 'Le Châble VS', 0),
(245, 1921, 'Le Chanton', 0),
(246, 1987, 'Le Chargeur', 0),
(247, 1925, 'Le Châtelard VS', 0),
(248, 1921, 'Le Fays', 0),
(249, 1947, 'Le Fregnoley', 0),
(250, 1947, 'Le Martinet', 0),
(251, 1948, 'Le Morgnes', 0),
(252, 1976, 'Le Nez', 0),
(253, 1991, 'Le Parfay', 0),
(254, 1948, 'Le Planchamp', 0),
(255, 1991, 'Le Saillen', 0),
(256, 1934, 'Le Sapey', 0),
(257, 1923, 'Le Trétien', 0),
(258, 1978, 'Lens', 0),
(259, 1992, 'Les Agettes', 0),
(260, 1943, 'Les Arlaches', 0),
(261, 1906, 'Les Chênes', 0),
(262, 1988, 'Les Collons', 0),
(263, 1873, 'Les Crosets', 0),
(264, 1897, 'Les Evouettes', 0),
(265, 1871, 'Les Giettes', 0),
(266, 1984, 'Les Haudères', 0),
(267, 1929, 'Les Jeurs', 0),
(268, 1923, 'Les Marécottes', 0),
(269, 1988, 'Les Masses', 0),
(271, 1992, 'Les Mayens-de-Sion', 0),
(272, 1945, 'Les Moulins VS', 0),
(273, 1868, 'Les Neyres', 0),
(274, 1947, 'Les Places', 0),
(275, 3960, 'Les Pontis', 0),
(276, 1981, 'Les Prasses', 0),
(277, 1921, 'Les Rappes', 0),
(278, 1932, 'Les Valettes', 0),
(279, 1955, 'Les Vérines', 0),
(280, 3953, 'Leuk Stadt', 0),
(281, 3954, 'Leukerbad', 0),
(282, 1942, 'Levron', 0),
(283, 1912, 'Leytron', 0),
(284, 1945, 'Liddes', 0),
(285, 1969, 'Liez (St-Martin)', 0),
(286, 3960, 'Loc', 0),
(287, 3953, 'Loèche-la-Ville', 0),
(288, 3954, 'Loèche-les-Bains', 0),
(289, 1948, 'Lourtier', 0),
(290, 3979, 'Loye', 0),
(291, 1966, 'Luc (Ayent)', 0),
(292, 1987, 'Mâche', 0),
(293, 1963, 'Magnot', 0),
(294, 1937, 'Maligue', 0),
(295, 1950, 'Maragnénaz', 0),
(296, 1920, 'Martigny', 0),
(297, 1921, 'Martigny-Combe', 0),
(298, 1921, 'Martigny-Croix', 0),
(299, 3994, 'Martisberg', 0),
(300, 1968, 'Mase', 0),
(301, 1869, 'Massongex', 0),
(302, 3905, 'Mattmark', 0),
(303, 3927, 'Mattsand', 0),
(304, 1934, 'Mayens-de-Bruson', 0),
(305, 1911, 'Mayens-de-Chamoson', 0),
(306, 1976, 'Mayens-de-Conthey', 0),
(307, 1965, 'Mayens-de-la-Zour', 0),
(308, 1968, 'Mayens-de-Mase', 0),
(309, 1976, 'Mayens-de-My', 0),
(310, 1973, 'Mayens-de-Nax', 0),
(311, 1918, 'Mayens-de-Riddes', 0),
(312, 1907, 'Mayens-de-Saxon', 0),
(313, 3961, 'Mayoux', 0),
(314, 1926, 'Mazembroz', 0),
(315, 1936, 'Médières', 0),
(316, 1891, 'Mex VS', 0),
(317, 3972, 'Miège', 0),
(318, 1904, 'Miéville', 0),
(319, 1896, 'Miex', 0),
(320, 1991, 'Misériez (Salins)', 0),
(321, 3961, 'Mission', 0),
(322, 3961, 'Moiry VS', 0),
(323, 1950, 'Molignon', 0),
(324, 3974, 'Mollens VS', 0),
(325, 1934, 'Montagnier', 0),
(326, 1912, 'Montagnon(Leytron)', 0),
(327, 3963, 'Montana', 0),
(328, 1965, 'Monteiller-Savièse', 0),
(329, 1870, 'Monthey', 0),
(332, 1870, 'Monthey Fil Colis', 0),
(333, 1950, 'Montorge', 0),
(334, 3983, 'Mörel', 0),
(335, 1875, 'Morgins', 0),
(336, 3961, 'Mottec', 0),
(337, 3995, 'Mühlebach (Goms)', 0),
(338, 3903, 'Mund', 0),
(339, 3985, 'Münster VS', 0),
(340, 1893, 'Muraz (Collombey)', 0),
(341, 3960, 'Muraz (Sierre)', 0),
(342, 3904, 'Naters', 0),
(343, 1973, 'Nax', 0),
(344, 1955, 'Némiaz (Chamoson)', 0),
(345, 3945, 'Niedergampel', 0),
(346, 3942, 'Niedergesteln', 0),
(347, 3989, 'Niederwald', 0),
(348, 3960, 'Niouc', 0),
(349, 3976, 'Noës', 0),
(350, 3948, 'Oberems', 0),
(351, 3981, 'Obergesteln', 0),
(352, 3999, 'Oberwald', 0),
(353, 3971, 'Ollon VS', 0),
(354, 1965, 'Ormône (Savièse)', 0),
(355, 1937, 'Orsières', 0),
(356, 1911, 'Ovronnaz', 0),
(357, 1945, 'Palasuit (Liddes)', 0),
(358, 1945, 'Petit Vichères', 0),
(359, 3961, 'Pinsec', 0),
(360, 1874, 'Planachaux', 0),
(361, 1996, 'Plan-Baar', 0),
(362, 1921, 'Plan-Cerisier', 0),
(363, 3972, 'Planige', 0),
(364, 1976, 'Pomeiron', 0),
(365, 1962, 'Pont-de-la-Morge', 0),
(366, 1897, 'Port-Valais', 0),
(367, 1991, 'Pradurant', 0),
(368, 1965, 'Prafirmin', 0),
(369, 1987, 'Pralong', 0),
(370, 3979, 'Pramagnon', 0),
(371, 1947, 'Prarreyer', 0),
(372, 1937, 'Prassurny', 0),
(373, 1991, 'Pravidondaz', 0),
(374, 1944, 'Prayon', 0),
(375, 1943, 'Praz-de-Fort', 0),
(376, 1982, 'Praz-Jean', 0),
(377, 1976, 'Premploz', 0),
(378, 1912, 'Produit (Leytron)', 0),
(379, 1987, 'Prolin', 0),
(380, 3928, 'Randa', 0),
(381, 3975, 'Randogne', 0),
(382, 3942, 'Raron', 0),
(383, 1928, 'Ravoire', 0),
(384, 3966, 'Réchy', 0),
(385, 3998, 'Reckingen VS', 0),
(386, 1937, 'Reppaz', 0),
(387, 1899, 'Revereulaz', 0),
(388, 1908, 'Riddes', 0),
(389, 3919, 'Ried (Lötschen)', 0),
(390, 3911, 'Ried-Brig', 0),
(391, 3987, 'Riederalp', 0),
(392, 3986, 'Ried-Mörel', 0),
(393, 1987, 'Riod', 0),
(394, 3989, 'Ritzingen', 0),
(395, 1945, 'Rive Haute(Liddes)', 0),
(396, 3913, 'Rosswald', 0),
(397, 3901, 'Rothwald', 0),
(398, 1965, 'Roumaz (Savièse)', 0),
(399, 3905, 'Saas Almagell', 0),
(400, 3908, 'Saas Balen', 0),
(401, 3908, 'Saas Bidermatten', 0),
(402, 3906, 'Saas Fee', 0),
(403, 3910, 'Saas Grund', 0),
(404, 1996, 'Saclentz', 0),
(405, 1913, 'Saillon', 0),
(406, 1965, 'Saint-Germain', 0),
(407, 1966, 'Saint-Romain', 0),
(408, 1943, 'Saleinaz', 0),
(409, 3970, 'Salgesch', 0),
(410, 1991, 'Salins', 0),
(411, 1922, 'Salvan', 0),
(412, 1907, 'Sapinhaut', 0),
(413, 1948, 'Sarreyer', 0),
(414, 1890, 'Savatan', 0),
(415, 1965, 'Savièse', 0),
(416, 1926, 'Saxé', 0),
(417, 1907, 'Saxon', 0),
(418, 1966, 'Saxonne (Ayent)', 0),
(419, 3920, 'Schwarzsee', 0),
(420, 3989, 'Selkingen', 0),
(421, 1933, 'Sembrancher', 0),
(422, 1975, 'Sensine', 0),
(424, 3960, 'Sierre / Siders', 0),
(425, 3960, 'Sierre Fil. Colis', 0),
(426, 3961, 'Sierre Sorties', 0),
(427, 1966, 'Signèse', 0),
(428, 3907, 'Simplon Dorf', 0),
(429, 3907, 'Simplon Hospiz', 0),
(430, 3900, 'Simplon Kulm', 0),
(431, 1950, 'Sion', 1),
(438, 1950, 'Sitten', 0),
(439, 1997, 'Siviez', 0),
(440, 1937, 'Som-la-Proz', 0),
(441, 1928, 'Sommet-des-Vignes', 0),
(442, 1997, 'Sornard', 0),
(443, 1937, 'Soulalex', 0),
(444, 3961, 'Soussillon', 0),
(445, 3936, 'St. German', 0),
(446, 3924, 'St. Niklaus VS', 0),
(447, 3922, 'Stalden VS', 0),
(448, 3933, 'Staldenried', 0),
(449, 3978, 'St-Clément', 0),
(450, 3940, 'Steg VS', 0),
(451, 3995, 'Steinhaus', 0),
(452, 1898, 'St-Gingolph', 0),
(453, 3961, 'St-Jean VS', 0),
(454, 1958, 'St-Léonard', 0),
(455, 3961, 'St-Luc', 0),
(456, 1969, 'St-Martin VS', 0),
(457, 1890, 'St-Maurice', 0),
(458, 1891, 'St-Maurice Sorties', 0),
(459, 3974, 'St-Maurice-Laques', 0),
(460, 1955, 'St-Pierre-Clages', 0),
(461, 1971, 'St-Raphaël', 0),
(462, 1975, 'St-Séverin', 0),
(463, 1969, 'Suen (St-Martin)', 0),
(464, 3952, 'Susten', 0),
(465, 1896, 'Tanay', 0),
(466, 3929, 'Täsch', 0),
(467, 3912, 'Termen', 0),
(468, 1988, 'Thyon', 0),
(469, 1988, 'Thyon-Les Collons', 0),
(470, 3923, 'Törbel', 0),
(471, 1899, 'Torgon', 0),
(472, 1907, 'Tovassière', 0),
(473, 1929, 'Trient', 0),
(474, 1969, 'Trogne (St-Martin)', 0),
(475, 1872, 'Troistorrents', 0),
(476, 3983, 'Tunetschalp', 0),
(477, 1991, 'Turin (Salins)', 0),
(478, 3946, 'Turtmann', 0),
(479, 3988, 'Ulrichen', 0),
(480, 3944, 'Unterbäch VS', 0),
(481, 3948, 'Unterems', 0),
(482, 1958, 'Uvrier', 0),
(483, 3978, 'Vaas', 0),
(484, 3979, 'Val-de-Réchy', 0),
(485, 3978, 'Valençon', 0),
(486, 3953, 'Varen', 0),
(487, 1933, 'Vens(Sembrancher)', 0),
(488, 3973, 'Venthône', 0),
(489, 1936, 'Verbier', 0),
(490, 3967, 'Vercorin', 0),
(491, 1937, 'Verlonnaz', 0),
(492, 1961, 'Vernamiège', 0),
(493, 1904, 'Vernayaz', 0),
(494, 1891, 'Vérossaz', 0),
(495, 1947, 'Versegères', 0),
(496, 1963, 'Vétroz', 0),
(497, 1981, 'Vex', 0),
(498, 3968, 'Veyras', 0),
(499, 1993, 'Veysonnaz', 0),
(500, 1945, 'Vichères (Liddes)', 0),
(501, 3930, 'Viège', 0),
(502, 1966, 'Villa (Ayent)', 0),
(503, 1985, 'Villaz', 0),
(504, 1934, 'Villette', 0),
(505, 1918, 'Villy VS', 0),
(506, 1895, 'Vionnaz', 0),
(507, 1906, 'Vison', 0),
(508, 3930, 'Visp', 0),
(509, 3932, 'Visperterminen', 0),
(510, 3961, 'Vissoie', 0),
(511, 1941, 'Vollèges', 0),
(512, 1896, 'Vouvry', 0),
(513, 1962, 'Vuisse', 0),
(514, 3919, 'Weissenried', 0),
(515, 3918, 'Wiler (Lötschen)', 0),
(516, 1981, 'Ypresses', 0),
(517, 3934, 'Zeneggen', 0),
(518, 3920, 'Zermatt', 0),
(519, 1966, 'Zeuzier', 0),
(520, 3961, 'Zinal', 0),
(521, 3907, 'Zwischbergen', 0),
(522, 1974, 'Mayens-d''Arbaz', 0),
(524, 1873, 'Val-d''Illiez', 0),
(525, 1922, 'Van-d''en-Bas', 0),
(528, 1922, 'Van-d''en-Haut', 0),
(529, 3982, 'Z''Matt', 0),
(530, 1905, 'Champex-d''Allesse', 0),
(531, 1992, 'Crête-à-l''Oeil', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `genders`
--

CREATE TABLE `genders` (
  `id_gender` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genders`
--

INSERT INTO `genders` (`id_gender`, `name`, `activated`, `position`) VALUES
(0, 'Genre', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `indirect`
--

CREATE TABLE `indirect` (
  `id_indirect` int(11) NOT NULL,
  `date` date NOT NULL,
  `place` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `extraCost` int(11) DEFAULT '0',
  `distance` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `indirect_has_called`
--

CREATE TABLE `indirect_has_called` (
  `indirect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `indirect_has_prestations`
--

CREATE TABLE `indirect_has_prestations` (
  `indirect_id` int(11) NOT NULL,
  `prestation_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `intervention_has_persons`
--

CREATE TABLE `intervention_has_persons` (
  `intervention_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `intervention_has_thematics`
--

CREATE TABLE `intervention_has_thematics` (
  `intervention_id` int(11) NOT NULL,
  `thematic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intreventions`
--

CREATE TABLE `intreventions` (
  `id_intrevention` int(11) NOT NULL,
  `intervenant_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `place_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `extraCost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `distance` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `kind_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Déclencheurs `intreventions`
--
DELIMITER $$
CREATE TRIGGER `intreventions_BEFORE_DELETE` BEFORE DELETE ON `intreventions` FOR EACH ROW BEGIN
 delete from intervention_has_persons
	where intervention_id = OLD.id_intrevention;
 delete from intervention_has_thematics
	where intervention_id = OLD.id_intrevention;
 delete from intrevention_has_material
	where intrevention_id = OLD.id_intrevention;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `intrevention_has_material`
--

CREATE TABLE `intrevention_has_material` (
  `intrevention_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intrevention_kinds`
--

CREATE TABLE `intrevention_kinds` (
  `id_kind` int(11) NOT NULL,
  `descr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `intrevention_kinds`
--

INSERT INTO `intrevention_kinds` (`id_kind`, `descr`) VALUES
(1, 'Mail'),
(2, 'Entretient'),
(3, 'Téléphone'),
(4, 'Démarche');

-- --------------------------------------------------------

--
-- Structure de la table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `materials`
--

CREATE TABLE `materials` (
  `id_material` int(11) NOT NULL,
  `descr` varchar(45) NOT NULL,
  `actived` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `ola_direct`
--

CREATE TABLE `ola_direct` (
  `id_intrevention` int(11) NOT NULL,
  `date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `annonyme` tinyint(1) NOT NULL,
  `intervenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `ola_indirect`
--

CREATE TABLE `ola_indirect` (
  `indirect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `prestGrp` int(11) NOT NULL,
  `prest_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `origines`
--

CREATE TABLE `origines` (
  `id_origine` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `origines`
--

INSERT INTO `origines` (`id_origine`, `name`, `parent_id`) VALUES
(0, '', NULL),
(2, 'Europe', 0),
(3, 'Europe l Est', 0),
(4, 'Proche/Moy. Orient', 0),
(5, 'Afrique Du Nord', 0),
(6, 'Afrique Sub-Saharienne', 0),
(7, 'Amerique du Nord', 0),
(8, 'Amerique Centrale', 0),
(9, 'Amerique du Sud', 0),
(10, 'suisse', 2),
(11, 'valais', 10);

-- --------------------------------------------------------

--
-- Structure de la table `persons`
--

CREATE TABLE `persons` (
  `id_Person` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `declared_origine_id` int(11) NOT NULL DEFAULT '0',
  `age_group_id` int(11) NOT NULL DEFAULT '0',
  `gender_id` int(11) NOT NULL DEFAULT '0',
  `sexuality_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id_lieu` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `kind` int(11) NOT NULL,
  `actived` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `place`
--

-- --------------------------------------------------------

--
-- Structure de la table `place_kind`
--

CREATE TABLE `place_kind` (
  `id_kind` int(11) NOT NULL,
  `descr` varchar(45) DEFAULT NULL,
  `kind_actived` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `place_kind`
--

INSERT INTO `place_kind` (`id_kind`, `descr`, `kind_actived`, `position`) VALUES
(0, 'Autres', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id_prestation` int(11) NOT NULL,
  `prestation_group` int(11) NOT NULL,
  `prestation_descr` varchar(200) NOT NULL,
  `isActiv` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `prestation`
--

INSERT INTO `prestation` (`id_prestation`, `prestation_group`, `prestation_descr`, `isActiv`, `position`) VALUES
(1, 1, 'contacts avec les médias et les journalistes ;', 1, 3),
(2, 1, 'interviews accordées (journaux, radio, TV) ;', 1, 2),
(3, 1, 'publication d’articles (en dehors de la revue / du site internet propres à l’organisation) ;', 1, 1),
(4, 1, 'conférences, exposés ;', 1, 4),
(5, 3, 'revues de l’organisation (publications périodiques) ou collaboration à une revue publiée en ', 1, 3),
(6, 2, 'circulaires paraissant périodiquement ;', 1, 2),
(7, 2, 'brochures d’information ;', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prestation-group`
--

CREATE TABLE `prestation-group` (
  `id_presstationGroup` int(11) NOT NULL,
  `presstationGroup_descr` varchar(200) NOT NULL,
  `isActiv` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `prestation-group`
--

INSERT INTO `prestation-group` (`id_presstationGroup`, `presstationGroup_descr`, `isActiv`, `position`) VALUES
(1, '9.1 Information générale des médias et du public', 1, 1),
(2, '9.2 Médias et publications accessibles au public appartenant au mandataire', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sexuality`
--

CREATE TABLE `sexuality` (
  `id_sexuality` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sexuality`
--

INSERT INTO `sexuality` (`id_sexuality`, `name`, `activated`, `position`) VALUES
(0, 'Sexualité', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `thematics`
--

CREATE TABLE `thematics` (
  `id_thematic` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '1',
  `isActiv` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `thematics`
--

INSERT INTO `thematics` (`id_thematic`, `name`, `parent_id`, `position`, `isActiv`) VALUES
(0, 'thematics', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_id` int(11) NOT NULL DEFAULT '300'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `group_id`) VALUES
(0, 'Admin', '$2a$08$eCSY6umGzkYK8ecWGRlxTu949NjHh9bqbQL0gC2PiO56snhICfpUS', 'Admin@Admin.AdminAdmin', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2017-02-27 12:52:29', '2017-02-27 12:51:09', '2017-02-27 11:52:29', 500);

-- --------------------------------------------------------

--
-- Structure de la table `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(0, 0, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`place_Id`),
  ADD KEY `fk_Adresse_Ville1_idx` (`city`);

--
-- Index pour la table `age_groups`
--
ALTER TABLE `age_groups`
  ADD PRIMARY KEY (`id_ages_goup`);

--
-- Index pour la table `citys`
--
ALTER TABLE `citys`
  ADD PRIMARY KEY (`id_city`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Index pour la table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id_gender`);

--
-- Index pour la table `indirect`
--
ALTER TABLE `indirect`
  ADD PRIMARY KEY (`id_indirect`),
  ADD KEY `indirect_owner_idx` (`owner`),
  ADD KEY `indirect_place_idx` (`place`);

--
-- Index pour la table `indirect_has_called`
--
ALTER TABLE `indirect_has_called`
  ADD PRIMARY KEY (`indirect_id`,`user_id`),
  ADD KEY `indirect_has_caller_called_idx` (`user_id`),
  ADD KEY `indirect_has_called_indirectId_idx` (`indirect_id`);

--
-- Index pour la table `indirect_has_prestations`
--
ALTER TABLE `indirect_has_prestations`
  ADD PRIMARY KEY (`indirect_id`,`prestation_id`),
  ADD KEY `indirect_has_prestation_prestation_idx` (`prestation_id`),
  ADD KEY `indirect_has_prestation_indirect_idx` (`indirect_id`);

--
-- Index pour la table `intervention_has_persons`
--
ALTER TABLE `intervention_has_persons`
  ADD PRIMARY KEY (`intervention_id`,`person_id`),
  ADD KEY `fk_person_idx` (`person_id`);

--
-- Index pour la table `intervention_has_thematics`
--
ALTER TABLE `intervention_has_thematics`
  ADD PRIMARY KEY (`intervention_id`,`thematic_id`),
  ADD KEY `thematic_id` (`thematic_id`);

--
-- Index pour la table `intreventions`
--
ALTER TABLE `intreventions`
  ADD PRIMARY KEY (`id_intrevention`),
  ADD KEY `fk_Intrevention_Lieu1_idx` (`place_id`),
  ADD KEY `fk_Intrevention_programe1_idx` (`kind_id`),
  ADD KEY `dateIndex` (`date`),
  ADD KEY `intervenant_id` (`intervenant_id`),
  ADD KEY `parent_ik_idx` (`parent`),
  ADD KEY `person_id` (`person_id`);

--
-- Index pour la table `intrevention_has_material`
--
ALTER TABLE `intrevention_has_material`
  ADD PRIMARY KEY (`material_id`,`intrevention_id`),
  ADD KEY `fk_intrevention_has_material_Intrevention1_idx` (`intrevention_id`),
  ADD KEY `fk_intrevention_has_material_Material1_idx` (`material_id`);

--
-- Index pour la table `intrevention_kinds`
--
ALTER TABLE `intrevention_kinds`
  ADD PRIMARY KEY (`id_kind`);

--
-- Index pour la table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_material`);

--
-- Index pour la table `ola_direct`
--
ALTER TABLE `ola_direct`
  ADD PRIMARY KEY (`id_intrevention`);

--
-- Index pour la table `ola_indirect`
--
ALTER TABLE `ola_indirect`
  ADD PRIMARY KEY (`indirect_id`,`user_id`,`prest_id`),
  ADD KEY `fk_pk_user_idx` (`user_id`),
  ADD KEY `fk_pk_prest_idx` (`prest_id`),
  ADD KEY `fk_presGrpt_idx` (`prestGrp`);

--
-- Index pour la table `origines`
--
ALTER TABLE `origines`
  ADD PRIMARY KEY (`id_origine`),
  ADD KEY `parent_id_idx` (`parent_id`);

--
-- Index pour la table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id_Person`),
  ADD KEY `fk_Persons_Origine1_idx` (`declared_origine_id`),
  ADD KEY `fk_Persons_Ages-group1_idx` (`age_group_id`),
  ADD KEY `fk_Persons_Gender_idx` (`gender_id`),
  ADD KEY `fk_Persons_sexuality_idx` (`sexuality_id`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id_lieu`),
  ADD KEY `fk_Lieu_TypeDeLieu1_idx` (`kind`);

--
-- Index pour la table `place_kind`
--
ALTER TABLE `place_kind`
  ADD PRIMARY KEY (`id_kind`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id_prestation`),
  ADD KEY `prestation_group_idx` (`prestation_group`);

--
-- Index pour la table `prestation-group`
--
ALTER TABLE `prestation-group`
  ADD PRIMARY KEY (`id_presstationGroup`);

--
-- Index pour la table `sexuality`
--
ALTER TABLE `sexuality`
  ADD PRIMARY KEY (`id_sexuality`);

--
-- Index pour la table `thematics`
--
ALTER TABLE `thematics`
  ADD PRIMARY KEY (`id_thematic`),
  ADD KEY `fk_Thematique_Thematique1_idx` (`parent_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_autologin`
--
ALTER TABLE `user_autologin`
  ADD PRIMARY KEY (`key_id`,`user_id`);

--
-- Index pour la table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `age_groups`
--
ALTER TABLE `age_groups`
  MODIFY `id_ages_goup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `citys`
--
ALTER TABLE `citys`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=532;
--
-- AUTO_INCREMENT pour la table `genders`
--
ALTER TABLE `genders`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `indirect`
--
ALTER TABLE `indirect`
  MODIFY `id_indirect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `intreventions`
--
ALTER TABLE `intreventions`
  MODIFY `id_intrevention` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `intrevention_kinds`
--
ALTER TABLE `intrevention_kinds`
  MODIFY `id_kind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `materials`
--
ALTER TABLE `materials`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `origines`
--
ALTER TABLE `origines`
  MODIFY `id_origine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `persons`
--
ALTER TABLE `persons`
  MODIFY `id_Person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `id_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `place_kind`
--
ALTER TABLE `place_kind`
  MODIFY `id_kind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id_prestation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `prestation-group`
--
ALTER TABLE `prestation-group`
  MODIFY `id_presstationGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `sexuality`
--
ALTER TABLE `sexuality`
  MODIFY `id_sexuality` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `thematics`
--
ALTER TABLE `thematics`
  MODIFY `id_thematic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_Adresse_Ville1` FOREIGN KEY (`city`) REFERENCES `citys` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `indirect`
--
ALTER TABLE `indirect`
  ADD CONSTRAINT `indirect_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `indirect_place` FOREIGN KEY (`place`) REFERENCES `place_kind` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `indirect_has_called`
--
ALTER TABLE `indirect_has_called`
  ADD CONSTRAINT `indirect_has_called_indirectId` FOREIGN KEY (`indirect_id`) REFERENCES `indirect` (`id_indirect`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `indirect_has_caller_called` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `indirect_has_prestations`
--
ALTER TABLE `indirect_has_prestations`
  ADD CONSTRAINT `indirect_has_prestation_indirect` FOREIGN KEY (`indirect_id`) REFERENCES `indirect` (`id_indirect`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `indirect_has_prestation_prestation` FOREIGN KEY (`prestation_id`) REFERENCES `prestation` (`id_prestation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `intervention_has_persons`
--
ALTER TABLE `intervention_has_persons`
  ADD CONSTRAINT `fk_intervention` FOREIGN KEY (`intervention_id`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_person` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id_Person`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `intervention_has_thematics`
--
ALTER TABLE `intervention_has_thematics`
  ADD CONSTRAINT `intervention_has_thematics_ibfk_1` FOREIGN KEY (`intervention_id`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `intervention_has_thematics_ibfk_2` FOREIGN KEY (`thematic_id`) REFERENCES `thematics` (`id_thematic`);

--
-- Contraintes pour la table `intreventions`
--
ALTER TABLE `intreventions`
  ADD CONSTRAINT `fk_Intrevention_Lieu1` FOREIGN KEY (`place_id`) REFERENCES `place_kind` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intrevention_programe1` FOREIGN KEY (`kind_id`) REFERENCES `intrevention_kinds` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `intreventions_ibfk_1` FOREIGN KEY (`intervenant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `intreventions_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id_Person`),
  ADD CONSTRAINT `paren_ik` FOREIGN KEY (`parent`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `intrevention_has_material`
--
ALTER TABLE `intrevention_has_material`
  ADD CONSTRAINT `intrevention_has_material_ibfk_1` FOREIGN KEY (`intrevention_id`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION,
  ADD CONSTRAINT `intrevention_has_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id_material`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ola_direct`
--
ALTER TABLE `ola_direct`
  ADD CONSTRAINT `pk_fk` FOREIGN KEY (`id_intrevention`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ola_indirect`
--
ALTER TABLE `ola_indirect`
  ADD CONSTRAINT `fk_pk_inter` FOREIGN KEY (`indirect_id`) REFERENCES `indirect` (`id_indirect`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pk_prest` FOREIGN KEY (`prest_id`) REFERENCES `prestation` (`id_prestation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prestGrp` FOREIGN KEY (`prestGrp`) REFERENCES `prestation-group` (`id_presstationGroup`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `origines`
--
ALTER TABLE `origines`
  ADD CONSTRAINT `parent_ik` FOREIGN KEY (`parent_id`) REFERENCES `origines` (`id_origine`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `fk_Persons_Ages-group1` FOREIGN KEY (`age_group_id`) REFERENCES `age_groups` (`id_ages_goup`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_Gender` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id_gender`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_Origine1` FOREIGN KEY (`declared_origine_id`) REFERENCES `origines` (`id_origine`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_sexuality` FOREIGN KEY (`sexuality_id`) REFERENCES `sexuality` (`id_sexuality`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `fk_Lieu_TypeDeLieu1` FOREIGN KEY (`kind`) REFERENCES `place_kind` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD CONSTRAINT `prestation_group` FOREIGN KEY (`prestation_group`) REFERENCES `prestation-group` (`id_presstationGroup`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `thematics`
--
ALTER TABLE `thematics`
  ADD CONSTRAINT `fk_Thematique_Thematique1` FOREIGN KEY (`parent_id`) REFERENCES `thematics` (`id_thematic`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
