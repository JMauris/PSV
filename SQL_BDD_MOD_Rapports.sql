-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 01 Mars 2017 à 02:12
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `ola_compta_refresh` ()  BEGIN
-- clean content
	delete from ola_compta;
  
 -- insert criad elements
	insert into ola_compta
		select
			'direct' as `type`,
			YEAR(intreventions.`date`) as `year`,
			MONTH(intreventions.`date`) as `month`,
			users.username as `user`,
			sum(intreventions.duration) as `duration`,
			sum(intreventions.distance) as `km`,
			sum(intreventions.extraCost) as `extraCost`
		
		FROM intreventions
		join users
			on intreventions.intervenant_id = users.id
		group by `year`,`month`,`user`;
        
 -- insert protpreh as owner elements
	insert into ola_compta
		SELECT 
			'indirect-owner' as `type`,
			YEAR(indirect.`date`) as `year`,
			MONTH(indirect.`date`) as `month`,
			users.username as `user`,
			sum(indirect_has_prestations.duration) as `duration`,
			sum(indirect.distance) as `km`,
			sum(indirect.extraCost) as `extraCost`
		FROM
			indirect
			join indirect_has_prestations
				on indirect.id_indirect = indirect_has_prestations.indirect_id
			join users
				on indirect.owner = users.id
			group by `year`,`month`,`user`;
	
 -- insert protpreh as no-owmer elements
	insert into ola_compta
		SELECT 
			'indirect-present' as `type`,
			YEAR(indirect.`date`) as `year`,
			MONTH(indirect.`date`) as `month`,
			users.username as `user`,
			sum(indirect_has_prestations.duration) as `duration`,
			0 as `km`,
			0 as `extraCost`
		FROM
			indirect
			join indirect_has_prestations
				on indirect.id_indirect = indirect_has_prestations.indirect_id
			join indirect_has_called
				on indirect.id_indirect = indirect_has_called.indirect_id
			join users
				on indirect_has_called.user_id = users.id

		group by `year`,`month`,`user`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ola_criad_refresh` ()  BEGIN
  delete from ola_criad;
 
  insert into ola_criad
	select
		users.username as `user`,
		YEAR(intreventions.`date`) as `year`,
		MONTH(intreventions.`date`) as `month`,
		sum(intreventions.duration) as `duration`
    
	FROM intreventions
		join users
			on intreventions.intervenant_id = users.id
	group by `year`,`month`,`user`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ola_prospreh_refresh` ()  BEGIN
delete from ola_prospreh;
insert into ola_prospreh
		SELECT 
		users.username as `user`,
		YEAR(indirect.`date`) as `year`,
		MONTH(indirect.`date`) as `month`,
		`prestation-group`.id_presstationGroup as `prestGroupId`,
		indirect_has_prestations.prestation_id as `prest`,
		sum(indirect_has_prestations.duration) as `duration`
	FROM
		indirect
		join indirect_has_prestations
			on indirect.id_indirect = indirect_has_prestations.indirect_id
		join prestation
			on indirect_has_prestations.prestation_id = prestation.id_prestation
		join `prestation-group`
			on `prestation-group`.id_presstationGroup = prestation.prestation_group
		join users
			on indirect.owner = users.id
	group by `year`,`month`,`user`,`prest`
	UNION
    SELECT
		users.username as `user`,
		YEAR(indirect.`date`) as `year`,
		MONTH(indirect.`date`) as `month`,
		`prestation-group`.id_presstationGroup as `prestGroupId`,
		indirect_has_prestations.prestation_id as `prest`,
		sum(indirect_has_prestations.duration) as `duration`
	FROM
		indirect
		join indirect_has_prestations
			on indirect.id_indirect = indirect_has_prestations.indirect_id
		join prestation
			on indirect_has_prestations.prestation_id = prestation.id_prestation
		join `prestation-group`
			on `prestation-group`.id_presstationGroup = prestation.prestation_group
		join indirect_has_called
			on indirect.id_indirect = indirect_has_called.indirect_id
		join users
			on indirect_has_called.user_id = users.id
            
	group by `year`,`month`,`user`,`prest`;
END$$

DELIMITER ;
--
-- Structure de la table `ola_compta`
--

CREATE TABLE `ola_compta` (
  `type` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  `extraCost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Structure de la table `ola_criad`
--

CREATE TABLE `ola_criad` (
  `user` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Structure de la table `ola_prospreh`
--

CREATE TABLE `ola_prospreh` (
  `user` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `prestGroupId` int(11) NOT NULL,
  `prest` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
