-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Mai 2019 à 21:01
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `recherche_emploi`
--

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id_demandeur` int(20) NOT NULL,
  `id_cv` int(11) NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nom_organisation` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `annee_experience` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'tunisia'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cv`
--

INSERT INTO `cv` (`id_demandeur`, `id_cv`, `description`, `profession`, `nom_organisation`, `annee_experience`, `pays`) VALUES
(1, 4, '<p>kk</p>', '1', '11', '5', 'tunisia');

-- --------------------------------------------------------

--
-- Structure de la table `demandeur`
--

CREATE TABLE `demandeur` (
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mot_passe` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_demandeur` int(11) NOT NULL,
  `prenom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nom_organisation` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `annee_experience` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `demandeur`
--

INSERT INTO `demandeur` (`email`, `mot_passe`, `id_demandeur`, `prenom`, `nom`, `adresse`, `telephone`, `profession`, `nom_organisation`, `annee_experience`, `photo`) VALUES
('vfr38405@cndps.com', '11', 1, '2', '2', 'post box number 139', '1', '2', '2', '2', '1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `employeur`
--

CREATE TABLE `employeur` (
  `nom_organisation` varchar(20) NOT NULL,
  `secteur_activite` varchar(20) NOT NULL,
  `adresse` varchar(20) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `site_web` varchar(40) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mot_passe` varchar(40) NOT NULL,
  `id_employeur` int(11) NOT NULL,
  `logo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `employeur`
--

INSERT INTO `employeur` (`nom_organisation`, `secteur_activite`, `adresse`, `pays`, `site_web`, `telephone`, `latitude`, `longitude`, `email`, `mot_passe`, `id_employeur`, `logo`) VALUES
('a', 's', 's', 'd', 'w', '1', '1', '1', 'ha@gmail.com', '123456', 1, '1.jpg'),
('GL', 'achat', 'post box number 139', 'tunis', 'www.3c.tn', '25143294', '1.8020', '1.5010', 'hassani20120@gmail.com', '123456', 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id_demandeur` int(25) NOT NULL,
  `secteur` varchar(30) NOT NULL,
  `id_favoris` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `favoris`
--

INSERT INTO `favoris` (`id_demandeur`, `secteur`, `id_favoris`) VALUES
(1, 'Ressources humaines', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifier`
--

CREATE TABLE `notifier` (
  `date_notification` date NOT NULL,
  `id_employeur` int(25) NOT NULL,
  `nom_organisation` varchar(25) NOT NULL,
  `reponse` varchar(25) NOT NULL,
  `id_demandeur` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `intitule` varchar(25) NOT NULL,
  `qualification_requise` varchar(25) NOT NULL,
  `type_contrat` varchar(25) NOT NULL,
  `date_publication` varchar(25) NOT NULL,
  `date_limite` varchar(25) NOT NULL,
  `lieu_depot` varchar(25) NOT NULL,
  `commentaire` text NOT NULL,
  `id_employeur` int(25) NOT NULL,
  `id_offre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `offre`
--

INSERT INTO `offre` (`intitule`, `qualification_requise`, `type_contrat`, `date_publication`, `date_limite`, `lieu_depot`, `commentaire`, `id_employeur`, `id_offre`) VALUES
('ingenieur', 'bac+5', 'cdd', '12/06/2019', '12/07/2019', 'sousse', '2010', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `postuler`
--

CREATE TABLE `postuler` (
  `id_demandeur` int(25) NOT NULL,
  `id_offre` int(25) NOT NULL,
  `date_postulation` date NOT NULL,
  `intitule` varchar(25) NOT NULL,
  `nom_organisation` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id_cv`),
  ADD KEY `id_demandeur` (`id_demandeur`),
  ADD KEY `id_demandeur_2` (`id_demandeur`);

--
-- Index pour la table `demandeur`
--
ALTER TABLE `demandeur`
  ADD PRIMARY KEY (`id_demandeur`);

--
-- Index pour la table `employeur`
--
ALTER TABLE `employeur`
  ADD PRIMARY KEY (`id_employeur`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id_favoris`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `id_employeur` (`id_employeur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `demandeur`
--
ALTER TABLE `demandeur`
  MODIFY `id_demandeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `employeur`
--
ALTER TABLE `employeur`
  MODIFY `id_employeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id_favoris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
