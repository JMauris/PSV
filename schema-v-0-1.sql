-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 23 Octobre 2016 à 16:14
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.20

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
  `desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

CREATE TABLE `intervenant` (
  `idi_ntervenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intreventions`
--

CREATE TABLE `intreventions` (
  `id_intrevention` int(11) NOT NULL,
  `intervenant_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `kind_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intrevention_kinds`
--

CREATE TABLE `intrevention_kinds` (
  `id_kind` int(11) NOT NULL,
  `descr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `descr` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `material_has_intrevention`
--

CREATE TABLE `material_has_intrevention` (
  `material_id` int(11) NOT NULL,
  `intrevention_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Structure de la table `persons`
--

CREATE TABLE `persons` (
  `id_Person` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `declared-origine_id` int(11) NOT NULL,
  `age-group_id` int(11) NOT NULL,
  `born-gender_id` int(11) NOT NULL,
  `sexual-identity_id` int(11) NOT NULL,
  `sexual-preference_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `persons_has_intrevention`
--

CREATE TABLE `persons_has_intrevention` (
  `person_id` int(11) NOT NULL,
  `intrevention_id` int(11) NOT NULL,
  `thematic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id_lieu` int(11) NOT NULL,
  `kind` int(11) NOT NULL,
  `adresse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `place_kind`
--

CREATE TABLE `place_kind` (
  `id_kind` int(11) NOT NULL,
  `descr` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `thematics`
--

CREATE TABLE `thematics` (
  `id_thematic` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Index pour la table `intervenant`
--
ALTER TABLE `intervenant`
  ADD PRIMARY KEY (`idi_ntervenant`);

--
-- Index pour la table `intreventions`
--
ALTER TABLE `intreventions`
  ADD PRIMARY KEY (`id_intrevention`),
  ADD KEY `fk_Intrevention_Intervenant1_idx` (`intervenant_id`),
  ADD KEY `fk_Intrevention_Lieu1_idx` (`place_id`),
  ADD KEY `fk_Intrevention_programe1_idx` (`kind_id`);

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
-- Index pour la table `material_has_intrevention`
--
ALTER TABLE `material_has_intrevention`
  ADD PRIMARY KEY (`material_id`,`intrevention_id`),
  ADD KEY `fk_Material_has_Intrevention_Intrevention1_idx` (`intrevention_id`),
  ADD KEY `fk_Material_has_Intrevention_Material1_idx` (`material_id`);

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
  ADD KEY `fk_Persons_Origine1_idx` (`declared-origine_id`),
  ADD KEY `fk_Persons_Gender1_idx` (`born-gender_id`),
  ADD KEY `fk_Persons_Ages-group1_idx` (`age-group_id`),
  ADD KEY `fk_Persons_Gender2_idx` (`sexual-identity_id`),
  ADD KEY `fk_Persons_Genders1_idx` (`sexual-preference_id`);

--
-- Index pour la table `persons_has_intrevention`
--
ALTER TABLE `persons_has_intrevention`
  ADD PRIMARY KEY (`person_id`,`intrevention_id`,`thematic_id`),
  ADD KEY `fk_Persons_has_Intrevention_Intrevention1_idx` (`intrevention_id`),
  ADD KEY `fk_Persons_has_Intrevention_Persons1_idx` (`person_id`),
  ADD KEY `fk_Persons_has_Intrevention_Thematique1_idx` (`thematic_id`);

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
-- AUTO_INCREMENT pour la table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_Adresse_Ville1` FOREIGN KEY (`city`) REFERENCES `citys` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `intreventions`
--
ALTER TABLE `intreventions`
  ADD CONSTRAINT `fk_Intrevention_Intervenant1` FOREIGN KEY (`intervenant_id`) REFERENCES `intervenant` (`idi_ntervenant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intrevention_Lieu1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id_lieu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intrevention_programe1` FOREIGN KEY (`kind_id`) REFERENCES `intrevention_kinds` (`id_kind`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `material_has_intrevention`
--
ALTER TABLE `material_has_intrevention`
  ADD CONSTRAINT `fk_Material_has_Intrevention_Intrevention1` FOREIGN KEY (`intrevention_id`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Material_has_Intrevention_Material1` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id_material`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `origines`
--
ALTER TABLE `origines`
  ADD CONSTRAINT `parent_ik` FOREIGN KEY (`parent_id`) REFERENCES `origines` (`id_origine`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `fk_Persons_Ages-group1` FOREIGN KEY (`age-group_id`) REFERENCES `age_groups` (`id_ages_goup`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_Gender1` FOREIGN KEY (`born-gender_id`) REFERENCES `genders` (`id_gender`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_Gender2` FOREIGN KEY (`sexual-identity_id`) REFERENCES `genders` (`id_gender`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_Genders1` FOREIGN KEY (`sexual-preference_id`) REFERENCES `genders` (`id_gender`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_Origine1` FOREIGN KEY (`declared-origine_id`) REFERENCES `origines` (`id_origine`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `persons_has_intrevention`
--
ALTER TABLE `persons_has_intrevention`
  ADD CONSTRAINT `fk_Persons_has_Intrevention_Intrevention1` FOREIGN KEY (`intrevention_id`) REFERENCES `intreventions` (`id_intrevention`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_has_Intrevention_Persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id_Person`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persons_has_Intrevention_Thematique1` FOREIGN KEY (`thematic_id`) REFERENCES `thematics` (`id_thematic`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
