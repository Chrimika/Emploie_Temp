-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 07 fév. 2024 à 16:16
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_emploie_temp`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEnseignant` (IN `p_first_name` VARCHAR(255), IN `p_last_name` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255), IN `p_id_ue` INT)   BEGIN
    INSERT INTO enseignant (first_name, last_name, email, password, id_ue)
    VALUES (p_first_name, p_last_name, p_email, p_password, p_id_ue);
END$$

--
-- Fonctions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `CountMatchingAdmin` (`p_email` VARCHAR(255), `p_password` VARCHAR(255)) RETURNS INT(11)  BEGIN
    DECLARE count INT;

    SELECT COUNT(*)
    INTO count
    FROM chef_departement
    WHERE email = p_email AND password = p_password;

    RETURN count;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `CountMatchingTeachers` (`p_email` VARCHAR(255), `p_password` VARCHAR(255)) RETURNS INT(11)  BEGIN
    DECLARE count INT;

    SELECT COUNT(*)
    INTO count
    FROM enseignant
    WHERE email = p_email AND password = p_password;

    RETURN count;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `chef_departement`
--

CREATE TABLE `chef_departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chef_departement`
--

INSERT INTO `chef_departement` (`id`, `nom`, `password`, `email`) VALUES
(1, 'Mika', '123456', 'gt@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `nbr_places` int(11) NOT NULL,
  `localisation` varchar(50) NOT NULL,
  `id_departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `nom`, `nbr_places`, `localisation`, `id_departement`) VALUES
(1, 'S008', 250, 'R0', 1),
(2, 'S003', 100, 'R0', 1);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_faculte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`, `id_faculte`) VALUES
(1, 'Informatique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `dispenser`
--

CREATE TABLE `dispenser` (
  `id_enseignant` int(11) NOT NULL,
  `heure_debut` time NOT NULL,
  `jour` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_ue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `first_name`, `password`, `last_name`, `email`, `id_ue`) VALUES
(26, 'TADDIO', '$2y$10$fhBvf4pXc5iLPCDCCtbuNuPXxK4z0Nq2T7pY31wJXs3OBr2WesbzO', 'LEO', 'sdkjhsd@gmail.com', 0),
(36, 'TCHINDA MBA', '$2y$10$.O.1byvonQFnS6s/V7MhZexvNweFHGgswJEa7Gr8CJ1rYJbugShva', 'CHRISTIAN MIKA', 'mbachristian58@gmail.com', 0),
(37, 'TCHINDA MBA', 'mxgojq9T2j', 'CHRISTIAN MIKA', 'mbachristian58@gmail.com', 0),
(41, 'TADDIO', '$2y$10$tmeKuvngLCe1./iLwmCOeuK0MUNXFGsNk9mmIdauJ8wfW.nw6pDna', 'LEO', 'mbachristian58@gmail.com', 3),
(42, 'TCHINDA MBA', '$2y$10$TyPCONqsrrVEfB2U80kMaOuiy3/dn0KkK.MpsHmsozo2W5dnDRjcu', 'CHRISTIAN MIKA', 'mbachristian58@gmail.com', 1),
(43, 'TCHINDA MBA', '$2y$10$COJYSJoXLdtz9rkKI8w1FOVEkWR/Kj8Q.Q3KvVXNIkGbx0u68zIOi', 'CHRISTIAN MIKA', 'sdkjhsd@gmail.com', 4);

-- --------------------------------------------------------

--
-- Structure de la table `faculte`
--

CREATE TABLE `faculte` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `localisation` varchar(50) NOT NULL,
  `id_universite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `faculte`
--

INSERT INTO `faculte` (`id`, `nom`, `localisation`, `id_universite`) VALUES
(1, 'Sciences', 'apres centre calcule', 1);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `id_departement`) VALUES
(1, 'ICD4D', 1),
(2, 'Informatique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `heurs_debuts`
--

CREATE TABLE `heurs_debuts` (
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `heurs_debuts`
--

INSERT INTO `heurs_debuts` (`heure`) VALUES
('07:30:00'),
('09:45:00'),
('12:00:00'),
('14:15:00');

-- --------------------------------------------------------

--
-- Structure de la table `jours`
--

CREATE TABLE `jours` (
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jours`
--

INSERT INTO `jours` (`nom`) VALUES
('Jeudi'),
('Lundi'),
('Mardi'),
('Mercredi'),
('Vendredi');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_filiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `nom`, `id_filiere`) VALUES
(1, 'L2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE `semestre` (
  `numero` int(11) NOT NULL,
  `debut` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `semestre`
--

INSERT INTO `semestre` (`numero`, `debut`) VALUES
(1, '2023-09-29 03:14:12'),
(2, '2024-04-01 03:14:12');

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

CREATE TABLE `ue` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `numero_semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ue`
--

INSERT INTO `ue` (`id`, `nom`, `id_niveau`, `id_classe`, `numero_semestre`) VALUES
(1, 'ICT-201', 1, 1, 1),
(2, 'ICT-203', 1, 1, 1),
(3, 'ICT-205', 1, 1, 1),
(4, 'ICT-207', 1, 1, 1),
(5, 'ICT-213', 1, 2, 1),
(6, 'ICT-217', 1, 2, 1),
(7, 'FRA-201', 1, 2, 1),
(8, 'ENG-201', 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `universite`
--

CREATE TABLE `universite` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `addresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `universite`
--

INSERT INTO `universite` (`id`, `nom`, `addresse`) VALUES
(1, 'UY1', 'Ngoa-Ekele');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chef_departement`
--
ALTER TABLE `chef_departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departement` (`id_departement`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculte` (`id_faculte`);

--
-- Index pour la table `dispenser`
--
ALTER TABLE `dispenser`
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `jour` (`jour`),
  ADD KEY `heure_debut` (`heure_debut`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faculte`
--
ALTER TABLE `faculte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_universite` (`id_universite`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departement` (`id_departement`);

--
-- Index pour la table `heurs_debuts`
--
ALTER TABLE `heurs_debuts`
  ADD PRIMARY KEY (`heure`);

--
-- Index pour la table `jours`
--
ALTER TABLE `jours`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_filiere` (`id_filiere`);

--
-- Index pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_niveau` (`id_niveau`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `numero_semestre` (`numero_semestre`);

--
-- Index pour la table `universite`
--
ALTER TABLE `universite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chef_departement`
--
ALTER TABLE `chef_departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `faculte`
--
ALTER TABLE `faculte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `semestre`
--
ALTER TABLE `semestre`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ue`
--
ALTER TABLE `ue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `universite`
--
ALTER TABLE `universite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id`);

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`id_faculte`) REFERENCES `faculte` (`id`);

--
-- Contraintes pour la table `dispenser`
--
ALTER TABLE `dispenser`
  ADD CONSTRAINT `dispenser_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `dispenser_ibfk_2` FOREIGN KEY (`jour`) REFERENCES `jours` (`nom`),
  ADD CONSTRAINT `dispenser_ibfk_3` FOREIGN KEY (`heure_debut`) REFERENCES `heurs_debuts` (`heure`);

--
-- Contraintes pour la table `faculte`
--
ALTER TABLE `faculte`
  ADD CONSTRAINT `faculte_ibfk_1` FOREIGN KEY (`id_universite`) REFERENCES `universite` (`id`);

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id`);

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`);

--
-- Contraintes pour la table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id`),
  ADD CONSTRAINT `ue_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `ue_ibfk_3` FOREIGN KEY (`numero_semestre`) REFERENCES `semestre` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
