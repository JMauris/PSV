-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 05 Décembre 2016 à 18:01
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

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id_adresse` int(11) NOT NULL,
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
  `activated` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `age_groups`
--

INSERT INTO `age_groups` (`id_ages_goup`, `name`, `activated`) VALUES
(1, 'mineurs', 1),
(2, '18-25', 1),
(3, '26-35', 1),
(4, '36-50', 1),
(5, '51-65', 1),
(6, '66+', 1);

-- --------------------------------------------------------

--
-- Structure de la table `citys`
--

CREATE TABLE `citys` (
  `id_city` int(11) NOT NULL,
  `npa` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `activated` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genders`
--

INSERT INTO `genders` (`id_gender`, `name`, `activated`) VALUES
(1, 'ne se reconait dans aucun genre', 1),
(2, 'homme', 1),
(3, 'femme', 0),
(4, 'homme >> femme', 1),
(5, 'femme >> hommme', 1);

-- --------------------------------------------------------

--
-- Structure de la table `intervention_has_persons`
--

CREATE TABLE `intervention_has_persons` (
  `intervention_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `intervention_has_persons`
--

INSERT INTO `intervention_has_persons` (`intervention_id`, `person_id`) VALUES
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `intervention_has_thematics`
--

CREATE TABLE `intervention_has_thematics` (
  `intervention_id` int(11) NOT NULL,
  `thematic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `intervention_has_thematics`
--

INSERT INTO `intervention_has_thematics` (`intervention_id`, `thematic_id`) VALUES
(3, 2),
(3, 3),
(3, 4),
(3, 6),
(3, 8),
(3, 9),
(3, 11),
(3, 12),
(3, 14),
(3, 15),
(16, 11),
(16, 12);

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
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `intreventions`
--

INSERT INTO `intreventions` (`id_intrevention`, `intervenant_id`, `date`, `place_id`, `duration`, `extraCost`, `distance`, `kind_id`, `parent`) VALUES
(3, 2, '2016-12-29', 1, 15, 12, 25, 4, NULL),
(13, 3, '0000-00-00', 1, 0, 0, 0, 4, NULL),
(14, 3, '0000-00-00', 1, 0, 0, 0, 4, NULL),
(15, 1, '2016-12-21', 1, 0, 0, 0, 4, NULL),
(16, 2, '2017-08-09', 1, 0, 0, 0, 4, NULL),
(17, 1, '2016-12-01', 1, 0, 0, 0, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `intrevention_has_material`
--

CREATE TABLE `intrevention_has_material` (
  `intrevention_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `intrevention_has_material`
--

INSERT INTO `intrevention_has_material` (`intrevention_id`, `material_id`, `quantity`) VALUES
(3, 1, 2),
(3, 2, 4),
(16, 2, 1),
(3, 4, 14);

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
  `actived` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `materials`
--

INSERT INTO `materials` (`id_material`, `descr`, `actived`) VALUES
(1, 'preservatifs', 1),
(2, 'preservatifs feminins', 1),
(3, 'flyers', 1),
(4, 'Cartes de visite', 1);

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
  `declared_origine_id` int(11) NOT NULL,
  `age_group_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `sexuality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `persons`
--

INSERT INTO `persons` (`id_Person`, `name`, `declared_origine_id`, `age_group_id`, `gender_id`, `sexuality_id`) VALUES
(2, '', 11, 2, 3, 2),
(3, '', 11, 2, 2, 2),
(4, '', 11, 2, 3, 2),
(5, '', 11, 1, 2, 1),
(6, '', 11, 1, 2, 1),
(7, '', 11, 1, 2, 1),
(8, '', 11, 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id_lieu` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `kind` int(11) NOT NULL,
  `adresse` int(11) DEFAULT NULL,
  `actived` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `place`
--

INSERT INTO `place` (`id_lieu`, `Name`, `kind`, `adresse`, `actived`) VALUES
(1, 'perle d''asie', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `place_kind`
--

CREATE TABLE `place_kind` (
  `id_kind` int(11) NOT NULL,
  `descr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `place_kind`
--

INSERT INTO `place_kind` (`id_kind`, `descr`) VALUES
(1, 'autres');

-- --------------------------------------------------------

--
-- Structure de la table `sexuality`
--

CREATE TABLE `sexuality` (
  `id_sexuality` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sexuality`
--

INSERT INTO `sexuality` (`id_sexuality`, `name`, `activated`) VALUES
(1, 'hétérosexuel', 1),
(2, 'homosexuel', 1);

-- --------------------------------------------------------

--
-- Structure de la table `thematics`
--

CREATE TABLE `thematics` (
  `id_thematic` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `thematics`
--

INSERT INTO `thematics` (`id_thematic`, `name`, `parent_id`) VALUES
(0, 'thematics', NULL),
(2, 'HIV', 0),
(3, 'IST', 0),
(4, 'Vie', 0),
(5, 'autre', 0),
(6, 'Safer sex', 2),
(7, 'Risques', 2),
(8, 'Dépistage', 2),
(9, 'Traitement', 2),
(10, 'Safer sex', 3),
(11, 'Risques', 3),
(12, 'Dépistage', 3),
(13, 'Traitement', 3),
(14, 'Sociale', 4),
(15, 'Professionnelle', 4),
(16, 'Affective', 4),
(17, 'Familiale', 4),
(18, 'Pr. juridiques', 5),
(19, 'Pr. financiers', 5),
(20, 'Addictions', 5),
(21, 'Santé Physique', 5),
(22, 'Santé Psychique (dépression, suicide)', 5);

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
(1, 'toto', '$2a$08$QZw5jt/wAhQCj8MapvDx7.ggCNTHifI0fhZJm/fX5NFbBOZNvBrTG', 'toto@toto.toto', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-12-05 11:07:43', '2016-11-29 17:54:13', '2016-12-05 10:07:43', 300),
(2, 'tata', '$2a$08$MUAWTWCOMJzOAo3B24lpju3RvdwWncNgXr.0gkT3zUzVj0mf4J8b.', 'tata@tata.tata', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-11-29 19:32:15', '2016-11-29 19:32:15', '2016-11-29 18:32:15', 300),
(3, 'titi', '$2a$08$iBHekq9MdoJOGJEI04xaMeYcEzbvcz5OS8caVDsIZGJDPxJcRPgVi', 'titi@titi.titi', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2016-12-01 14:03:10', '2016-12-01 14:02:43', '2016-12-01 13:03:10', 300);

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
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`),
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
  ADD PRIMARY KEY (`id_city`);

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
  ADD KEY `parent_ik_idx` (`parent`);

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
  ADD KEY `fk_Lieu_TypeDeLieu1_idx` (`kind`),
  ADD KEY `fk_Lieu_Adresse1_idx` (`adresse`);

--
-- Index pour la table `place_kind`
--
ALTER TABLE `place_kind`
  ADD PRIMARY KEY (`id_kind`);

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
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `age_groups`
--
ALTER TABLE `age_groups`
  MODIFY `id_ages_goup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `citys`
--
ALTER TABLE `citys`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `genders`
--
ALTER TABLE `genders`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `intreventions`
--
ALTER TABLE `intreventions`
  MODIFY `id_intrevention` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `origines`
--
ALTER TABLE `origines`
  MODIFY `id_origine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `persons`
--
ALTER TABLE `persons`
  MODIFY `id_Person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `id_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `place_kind`
--
ALTER TABLE `place_kind`
  MODIFY `id_kind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `sexuality`
--
ALTER TABLE `sexuality`
  MODIFY `id_sexuality` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `thematics`
--
ALTER TABLE `thematics`
  MODIFY `id_thematic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_Adresse_Ville1` FOREIGN KEY (`city`) REFERENCES `citys` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `intervention_has_thematics_ibfk_1` FOREIGN KEY (`intervention_id`) REFERENCES `intreventions` (`id_intrevention`),
  ADD CONSTRAINT `intervention_has_thematics_ibfk_2` FOREIGN KEY (`thematic_id`) REFERENCES `thematics` (`id_thematic`);

--
-- Contraintes pour la table `intreventions`
--
ALTER TABLE `intreventions`
  ADD CONSTRAINT `fk_Intrevention_Lieu1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id_lieu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intrevention_programe1` FOREIGN KEY (`kind_id`) REFERENCES `intrevention_kinds` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `intreventions_ibfk_1` FOREIGN KEY (`intervenant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `paren_ik` FOREIGN KEY (`parent`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_Lieu_Adresse1` FOREIGN KEY (`adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lieu_TypeDeLieu1` FOREIGN KEY (`kind`) REFERENCES `place_kind` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `thematics`
--
ALTER TABLE `thematics`
  ADD CONSTRAINT `fk_Thematique_Thematique1` FOREIGN KEY (`parent_id`) REFERENCES `thematics` (`id_thematic`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
