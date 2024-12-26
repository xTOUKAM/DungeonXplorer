-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 déc. 2024 à 23:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dungeonxplorer`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapter`
--

CREATE TABLE `chapter` (
  `chapter_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `treasure_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`chapter_id`, `content`, `image`, `treasure_id`) VALUES
(1, 'Le ciel est lourd ce soir sur le village du Val Perdu...', NULL, NULL),
(2, 'Vous franchissez la lisière des arbres...', NULL, NULL),
(3, 'Votre choix vous mène devant un vieux chêne aux branches tordues...', NULL, NULL),
(4, 'En progressant, le calme de la forêt est soudain brisé par un grognement...', NULL, NULL),
(5, 'Tandis que vous progressez, une voix humaine...', NULL, NULL),
(6, 'A mesure que vous avancez, un bruissement attire votre attention...', NULL, NULL),
(7, 'Après votre rencontre, vous atteignez une clairière étrange...', NULL, NULL),
(8, 'Essoufflé mais déterminé, vous arrivez près d\'un petit ruisseau...', NULL, NULL),
(9, 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée...', NULL, NULL),
(10, 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe...', NULL, NULL),
(11, 'Qu\'avez-vous fait, Malheureux !', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `base_pv` int(11) NOT NULL,
  `base_mana` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `initiative` int(11) NOT NULL,
  `max_items` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`class_id`, `name`, `description`, `base_pv`, `base_mana`, `strength`, `initiative`, `max_items`) VALUES
(1, 'Guerrier', 'Un combattant robuste sp?cialis? dans le combat physique.', 30, 0, 10, 2, 5),
(2, 'Voleur', 'Un agile guerrier qui privil?gie la vitesse et la discr?tion.', 20, 10, 6, 4, 10),
(3, 'Magicien', 'Un utilisateur de magie puissant mais fragile.', 15, 10, 4, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `encounter`
--

CREATE TABLE `encounter` (
  `encounter_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `monster_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `encounter`
--

INSERT INTO `encounter` (`encounter_id`, `chapter_id`, `monster_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `hero`
--

CREATE TABLE `hero` (
  `hero_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `pv` int(11) NOT NULL,
  `mana` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `initiative` int(11) NOT NULL,
  `armor` varchar(50) DEFAULT NULL,
  `primary_weapon` varchar(50) DEFAULT NULL,
  `secondary_weapon` varchar(50) DEFAULT NULL,
  `shield` varchar(50) DEFAULT NULL,
  `spell_list` text DEFAULT NULL,
  `xp` int(11) NOT NULL,
  `current_level` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hero`
--

INSERT INTO `hero` (`hero_id`, `name`, `class_id`, `image`, `biography`, `pv`, `mana`, `strength`, `initiative`, `armor`, `primary_weapon`, `secondary_weapon`, `shield`, `spell_list`, `xp`, `current_level`) VALUES
(1, 'Alakhazam', 1, NULL, NULL, 30, 0, 10, 2, NULL, NULL, NULL, NULL, NULL, 0, 1),
(2, 'Alakhazam', 1, NULL, NULL, 30, 0, 10, 2, NULL, NULL, NULL, NULL, NULL, 0, 1),
(3, 'SirResval', 2, NULL, NULL, 20, 10, 6, 4, NULL, NULL, NULL, NULL, NULL, 0, 1),
(4, 'SirResval', 2, NULL, NULL, 20, 10, 6, 4, NULL, NULL, NULL, NULL, NULL, 0, 1),
(5, 'Pipibox', 2, NULL, NULL, 20, 10, 6, 4, NULL, NULL, NULL, NULL, NULL, 0, 1),
(6, 'David', 1, NULL, NULL, 30, 0, 10, 2, NULL, NULL, NULL, NULL, NULL, 0, 1),
(7, 'Test', 2, NULL, NULL, 20, 10, 6, 4, NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `hero_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`) VALUES
(1, 'M?daille d\'honneur', 'Une m?daille r?compensant le courage du h?ros.'),
(2, '?p?e en argent', 'Une ?p?e l?g?re et aiguis?e, parfaite pour vaincre les cr?atures des t?n?bres.'),
(3, 'Potion de gu?rison', 'Une potion qui restaure une partie de la sant? du buveur.'),
(4, 'Amulette de protection', 'Une amulette qui offre une protection contre la magie.'),
(5, 'Carte de la for?t', 'Une carte d?taillant les chemins et les dangers de la for?t.'),
(6, 'Coffre ancien', 'Un coffre myst?rieux qui pourrait contenir des tr?sors oubli?s.'),
(7, 'Sauterelle dor?e', 'Un insecte rare qui porte chance ? celui qui le poss?de.'),
(8, 'Gemme enchant?e', 'Une gemme qui scintille d\'une lumi?re int?rieure, utilis?e dans les rituels magiques.'),
(9, 'Cloak of Shadows', 'Un manteau qui rend son porteur invisible dans l\'obscurit?.'),
(10, 'Bottes de vitesse', 'Des bottes qui augmentent la rapidit? de celui qui les porte.');

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `required_xp` int(11) NOT NULL,
  `pv_bonus` int(11) NOT NULL,
  `mana_bonus` int(11) NOT NULL,
  `strength_bonus` int(11) NOT NULL,
  `initiative_bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE `links` (
  `links_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `next_chapter_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `links`
--

INSERT INTO `links` (`links_id`, `chapter_id`, `next_chapter_id`, `description`) VALUES
(1, 1, 2, 'Commencer la quête dans la forêt'),
(2, 2, 3, 'Emprunter le chemin sinueux, bordé de vieux arbres noueux'),
(3, 2, 4, 'Choisir le sentier couvert de ronces épaisses'),
(4, 3, 5, 'Rester prudent en entendant les bruits'),
(5, 3, 6, 'Ignorer les bruits et poursuivre votre route'),
(6, 4, 8, 'Vous avez vaincu le sanglier et pouvez poursuivre'),
(7, 4, 10, 'Vous n\'avez pas vaincu le sanglier'),
(8, 5, 7, 'Continuer après avoir écouté le paysan'),
(9, 6, 7, 'Si vous survivez au loup'),
(10, 6, 10, 'Si le loup vous terrasse'),
(11, 7, 8, 'Prendre le sentier couvert de mousse'),
(12, 7, 9, 'Suivre le chemin tortueux à travers les racines'),
(13, 8, 11, 'Toucher la pierre gravée'),
(14, 8, 9, 'Ignorer la pierre et poursuivre votre route'),
(15, 11, 10, 'Le malheureux acte vous conduit vers le néant'),
(16, 10, 1, 'Reprendre l\'aventure depuis le début');

-- --------------------------------------------------------

--
-- Structure de la table `loot`
--

CREATE TABLE `loot` (
  `loot_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `loot`
--

INSERT INTO `loot` (`loot_id`, `name`, `item_id`, `quantity`) VALUES
(1, 'Peau de Sanglier', 1, 1),
(2, 'Croc de Loup', 2, 2),
(3, 'Sacoche du Gobelin', 3, 1),
(4, 'Potion de Sorcière', 4, 1),
(5, 'Masse de l\'Ogre', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `monster`
--

CREATE TABLE `monster` (
  `monster_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pv` int(11) NOT NULL,
  `mana` int(11) DEFAULT NULL,
  `initiative` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `attack` text DEFAULT NULL,
  `loot_id` int(11) DEFAULT NULL,
  `xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monster`
--

INSERT INTO `monster` (`monster_id`, `name`, `pv`, `mana`, `initiative`, `strength`, `attack`, `loot_id`, `xp`) VALUES
(1, 'Sanglier Sauvage', 20, 0, 5, 7, 'Charge puissante', 1, 50),
(2, 'Loup Féroce', 25, 0, 8, 6, 'Morsure', 2, 60),
(3, 'Gobelin Voleur', 15, 5, 6, 5, 'Coup furtif', 3, 40),
(4, 'Sorcière des Bois', 30, 20, 4, 5, 'Sort de confusion', 4, 70),
(5, 'Ogre Géant', 50, 0, 3, 10, 'Coup de massue', 5, 100);

-- --------------------------------------------------------

--
-- Structure de la table `quest`
--

CREATE TABLE `quest` (
  `quest_id` int(11) NOT NULL,
  `hero_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quest`
--

INSERT INTO `quest` (`quest_id`, `hero_id`, `chapter_id`) VALUES
(1, 4, 1),
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `treasure`
--

CREATE TABLE `treasure` (
  `treasure_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`) VALUES
(5, 'xTOUKAM', '947c1874d59f90766413ae29a3ee002b'),
(6, 'Tom', '0be1dc00c8cf18a0e71097a588b60b97'),
(7, 'testuser', 'b211a801e18ba09b6db0a1d54af68d08'),
(8, 'testuser1', '5d7b76503767c267ac110cb0fe8be0d1'),
(9, 'testuser2', '58dd024d49e1d1b83a5d307f09f32734'),
(10, 'SirResval', 'e050df4aaa9db3b68bde853b8808a7f6'),
(11, 'TOUKAMx', 'c6504e716661b0873b9f9f3bc1bea5ff');

-- --------------------------------------------------------

--
-- Structure de la table `user_hero`
--

CREATE TABLE `user_hero` (
  `user_id` int(11) NOT NULL,
  `hero_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_hero`
--

INSERT INTO `user_hero` (`user_id`, `hero_id`) VALUES
(9, 2),
(9, 4),
(10, 5),
(10, 6),
(11, 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `treasure_id` (`treasure_id`);

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Index pour la table `encounter`
--
ALTER TABLE `encounter`
  ADD PRIMARY KEY (`encounter_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `monster_id` (`monster_id`);

--
-- Index pour la table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`hero_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Index pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `hero_id` (`hero_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Index pour la table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Index pour la table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`links_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `next_chapter_id` (`next_chapter_id`);

--
-- Index pour la table `loot`
--
ALTER TABLE `loot`
  ADD PRIMARY KEY (`loot_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `monster`
--
ALTER TABLE `monster`
  ADD PRIMARY KEY (`monster_id`),
  ADD KEY `loot_id` (`loot_id`);

--
-- Index pour la table `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`quest_id`),
  ADD KEY `hero_id` (`hero_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Index pour la table `treasure`
--
ALTER TABLE `treasure`
  ADD PRIMARY KEY (`treasure_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `user_hero`
--
ALTER TABLE `user_hero`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hero_id` (`hero_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `encounter`
--
ALTER TABLE `encounter`
  MODIFY `encounter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `hero`
--
ALTER TABLE `hero`
  MODIFY `hero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
  MODIFY `links_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `loot`
--
ALTER TABLE `loot`
  MODIFY `loot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `monster`
--
ALTER TABLE `monster`
  MODIFY `monster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `quest`
--
ALTER TABLE `quest`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `treasure`
--
ALTER TABLE `treasure`
  MODIFY `treasure_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_1` FOREIGN KEY (`treasure_id`) REFERENCES `treasure` (`treasure_id`);

--
-- Contraintes pour la table `encounter`
--
ALTER TABLE `encounter`
  ADD CONSTRAINT `encounter_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`),
  ADD CONSTRAINT `encounter_ibfk_2` FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`);

--
-- Contraintes pour la table `hero`
--
ALTER TABLE `hero`
  ADD CONSTRAINT `hero_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Contraintes pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Contraintes pour la table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Contraintes pour la table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`),
  ADD CONSTRAINT `links_ibfk_2` FOREIGN KEY (`next_chapter_id`) REFERENCES `chapter` (`chapter_id`);

--
-- Contraintes pour la table `loot`
--
ALTER TABLE `loot`
  ADD CONSTRAINT `loot_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Contraintes pour la table `monster`
--
ALTER TABLE `monster`
  ADD CONSTRAINT `monster_ibfk_1` FOREIGN KEY (`loot_id`) REFERENCES `loot` (`loot_id`);

--
-- Contraintes pour la table `quest`
--
ALTER TABLE `quest`
  ADD CONSTRAINT `quest_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`);

--
-- Contraintes pour la table `treasure`
--
ALTER TABLE `treasure`
  ADD CONSTRAINT `treasure_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Contraintes pour la table `user_hero`
--
ALTER TABLE `user_hero`
  ADD CONSTRAINT `user_hero_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_hero_ibfk_2` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
