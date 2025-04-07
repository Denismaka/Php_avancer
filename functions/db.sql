-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour departement_science_informatique
CREATE DATABASE IF NOT EXISTS `departement_science_informatique` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `departement_science_informatique`;

-- Listage de la structure de table departement_science_informatique. cours
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int NOT NULL AUTO_INCREMENT,
  `intitule` text,
  PRIMARY KEY (`id_cours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.cours : ~0 rows (environ)

-- Listage de la structure de table departement_science_informatique. enseignant_etudiant
CREATE TABLE IF NOT EXISTS `enseignant_etudiant` (
  `id_etudiant` int DEFAULT NULL,
  `id_enseignant` int DEFAULT NULL,
  KEY `id_etudiants` (`id_etudiant`),
  KEY `id_enseignat` (`id_enseignant`),
  CONSTRAINT `id_enseignat` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignat` (`id_enseignat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_etudiants` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.enseignant_etudiant : ~0 rows (environ)

-- Listage de la structure de table departement_science_informatique. enseignat
CREATE TABLE IF NOT EXISTS `enseignat` (
  `id_enseignat` int NOT NULL AUTO_INCREMENT,
  `nom_enseignat` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom_enseignat` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `matricule_enseignat` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_enseignat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.enseignat : ~0 rows (environ)

-- Listage de la structure de table departement_science_informatique. etudiant
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` int NOT NULL AUTO_INCREMENT,
  `nom_etudiant` varchar(25) DEFAULT NULL,
  `prenom_etudiant` varchar(25) DEFAULT NULL,
  `matricule_etudiant` varchar(25) DEFAULT NULL,
  `date_naissance_etudiant` date DEFAULT NULL,
  `id_promotion` int DEFAULT NULL,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`),
  KEY `id_promotion` (`id_promotion`),
  CONSTRAINT `id_promotion` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.etudiant : ~4 rows (environ)
INSERT INTO `etudiant` (`id_etudiant`, `nom_etudiant`, `prenom_etudiant`, `matricule_etudiant`, `date_naissance_etudiant`, `id_promotion`, `created`) VALUES
	(19, 'ngoma', 'josue', '1', '2024-08-31', 2, '2024-08-31'),
	(20, 'ngoma', 'josue', '1', '2024-08-31', 2, '2024-08-31'),
	(21, 'ngoma', 'josue', '1', '2024-08-01', 2, '2024-08-31'),
	(23, 'love2', 'lovin2', '1', '2024-08-20', 2, '2024-08-31');

-- Listage de la structure de table departement_science_informatique. etudiant_cours
CREATE TABLE IF NOT EXISTS `etudiant_cours` (
  `id_etudiant` int DEFAULT NULL,
  `id_cours` int DEFAULT NULL,
  KEY `id_etudiant` (`id_etudiant`),
  KEY `id_cours` (`id_cours`),
  CONSTRAINT `id_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_etudiant` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.etudiant_cours : ~0 rows (environ)

-- Listage de la structure de table departement_science_informatique. promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promotion` int NOT NULL AUTO_INCREMENT,
  `nombre_etudiant` varchar(25) DEFAULT NULL,
  `faculte` varchar(25) DEFAULT NULL,
  `departement` varchar(25) DEFAULT NULL,
  `nombre_cours` varchar(25) DEFAULT NULL,
  `nom_promotion` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_promotion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.promotion : ~2 rows (environ)
INSERT INTO `promotion` (`id_promotion`, `nombre_etudiant`, `faculte`, `departement`, `nombre_cours`, `nom_promotion`) VALUES
	(1, '9', 'sciences', 'maths-info', NULL, 'deportivo'),
	(2, '10', 'Informatique', 'informatique de gestion', NULL, 'vclub');

-- Listage de la structure de table departement_science_informatique. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table departement_science_informatique.roles : ~2 rows (environ)
INSERT INTO `roles` (`id_role`, `nom_role`) VALUES
	(1, 'admin'),
	(2, 'modo'),
	(3, 'simple');

-- Listage de la structure de table departement_science_informatique. users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom_user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `prenom_user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email_user` varchar(25) DEFAULT NULL,
  `cle_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `token_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `motpass_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `id_role` int DEFAULT '3',
  `confirmation_user` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `role_user` (`id_role`),
  CONSTRAINT `role_user` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
