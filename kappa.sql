-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `choice`;
CREATE TABLE `choice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_to_redirect` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C1AB5A92401ADD27` (`pages_id`),
  CONSTRAINT `FK_C1AB5A92401ADD27` FOREIGN KEY (`pages_id`) REFERENCES `page` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `choice` (`id`, `pages_id`, `name`, `description`, `page_to_redirect`) VALUES
(39,	20,	'Rester à la maison',	'Je vais rester à la maison et regarder une bonne série. Peut-être y trouverai-je de l\'inspiration pour une prochaine histoire ? Guillaume a eu la sienne, mais... il en faut une pour Jérôme !',	22),
(40,	22,	'S’énerver',	'Ce kappa est quand même gonflé ! Votre colère ne cesse d\'augmenter !\r\n\"Dégage de chez moi, sale Yokai !\"',	24),
(41,	22,	'L\'offrande',	'Malgré votre colère, vous garder votre calme.\r\n\"Bonjour, que fais-tu là mon ami ? Tu as faim on dirait ? Puis-je t\'offrir un concombre ?\"',	23),
(42,	21,	'Saluer le Kappa',	'La situation peut être critique mais il faut que j\'évite de paniquer.\r\n\"Bonjour\"',	26),
(43,	21,	'L\'attaque est la meilleure défense',	'Je suis clairement en danger, l\'attaque est la meilleure des défenses, je vais l\'immobiliser en le prenant par surprise ! \"Yaaaaaaaaaaaaaaaaaaaaaaaaaaaaaahhhhhhhhhh\"',	27),
(44,	20,	'Faire une ballade le long de la rivière',	'Pfff... Y\'en a marre de rester toujours devant l\'ecran et d\'essayer de trouver des idées originales pour les prochaines histoires du projet ! J\'en rêve carrément la nuit. J\'ai besoin de prendre l\'air et de marcher le long de la rivière pour me ressourcer.',	21);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220929144140',	'2022-10-07 17:11:18',	228),
('DoctrineMigrations\\Version20221005133538',	'2022-10-07 17:11:18',	9),
('DoctrineMigrations\\Version20221007080500',	'2022-10-07 17:11:18',	23);

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:json)',
  `page_end` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_140AB620AA5D4036` (`story_id`),
  CONSTRAINT `FK_140AB620AA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `page` (`id`, `story_id`, `title`, `image`, `content`, `start`, `page_end`) VALUES
(20,	5,	'Enfin le week end',	'https://i.ibb.co/MGNXLzT/2.jpg',	'C\'est enfin le week end ! Cette semaine d\'apothéose fût intense et enrichissante ! Guillaume nous a bien mis la pression vendredi, il la voulait son histoire, et bien... là voilà !\r\nC\'est l\'heure de se reposer. Que faire ce week-end ?',	'true',	0),
(21,	5,	'Le long de la rivière',	'https://i.ibb.co/xM2h0ch/forest-sky-background.jpg',	'Quel plaisir de profiter de l\'air frais et du clapotis de la rivière ! Vous n\'avez cependant pas vu le panneau signalant la probable présence du kappa.\r\nManque de chance, vous tombez nez-à-nez avec lui. Vous savez également qu\'un Kappa peut être très dangereux. Vous auriez préféré croiser un Shirime !\r\n\r\nQue faites-vous ?',	'false',	0),
(22,	5,	'L\'heure du goûter',	'https://i.ibb.co/LJqKRb0/kappa.png',	'Vous enchaînez les épisodes mais un bon dev ne peut pas rester trop longtemps le ventre vide. Vous avez faim et besoin d\'un café.\r\nHorreur ! Un kappa a retourné votre cuisine ! Tout est sans dessus dessous ! Et en plus, il mange tranquillement le dernier cookie du paquet que vous aviez prévu de manger !\r\nVous êtes très énervé !',	'false',	0),
(23,	5,	'Le concombre',	'https://i.ibb.co/LJqKRb0/kappa.png',	'Le Kappa accepte le concombre que vous lui tendez et vous remercie gracieusement. \r\nTout en mangeant le concombre, il sort de votre maison.\r\n\r\nVous pouvez enfin terminer le dernier épisode de votre série avant d\'attaquer cette ultime semaine chez Oclock',	'false',	1),
(24,	5,	'Votre heure a sonné',	'https://i.ibb.co/LJqKRb0/kappa.png',	'Le kappa n\'apprécie pas du tout votre comportement et s\'élance sur vous !\r\nVous tentez de renverser le plat d\'eau qui se trouve sur sa tête. Vous échouez lamentablement. Le Kappa, affamé vous dévore les entrailles',	'false',	2),
(25,	5,	'Les salutations',	'https://i.ibb.co/LJqKRb0/kappa.png',	'Le Kappa vous salue en retour et continue son chemin.\r\nVous l\'avez échappé bel ! Vous continuez votre promenade et arrivez en forme lundi matin pour cette dernière semaine de cours chez Oclock',	'false',	1),
(26,	5,	'Politesse',	'https://i.ibb.co/LJqKRb0/kappa.png',	'Le Kappa vous salue en retour et continue son chemin.\r\nVous l\'avez échappé bel ! Heureusement, vous saviez que le Kappa est un yokai très poli. Vous continuez votre promenade et arrivez en forme lundi matin pour cette dernière semaine de cours chez Oclock',	'false',	1),
(27,	5,	'L\'attaque est la meilleure des défense',	'https://i.ibb.co/LJqKRb0/kappa.png',	'Perdant votre sang froid, vous vous ruez sur le Kappa dans l\'espoir de lui renvers son plat d\'eau dans le but de l\'immobiliser et de vous enfuir.\r\nMalheureusement, cela ne se passe pas comme prévu. Le Kappa vous envoie dans l\'eau de la rivière entraînant votre mort par noyade.',	'false',	2),
(28,	6,	'Kitsune',	'https://i.ibb.co/q7C2h9Y/kitsune.png',	'Il existe deux grandes variantes du kitsune. Les renards sacrés sont les serviteurs de la divinité shinto Inari, et les sanctuaires d\'Inari sont décorés de statues et d\'images de ces renards. Les légendes parlent de renards célestes apportant sagesse ou service aux humains bons et pieux. Ces renards sacrés agissent comme des messagers des dieux et des médiums entre les mondes céleste et humain. Ils protègent souvent les humains ou les lieux, portent chance et éloignent les mauvais esprits. Plus communs sont les renards sauvages qui se complaisent dans les méfaits, les farces ou le mal. Il y a des histoires dans lesquelles des renards sauvages trompent ou même possèdent des humains et les amènent à se comporter étrangement. Malgré cette nature méchante, même les renards sauvages tiennent leurs promesses, se souviennent de leurs amitiés et remboursent toutes les faveurs qui leur sont faites.',	'true',	0),
(29,	7,	'Oni',	'https://i.ibb.co/8bf1bCY/oni.png',	'Les Oni sont l\'une des plus grandes icônes du folklore japonais. Ils sont grands et effrayants, plus grands que l\'homme le plus grand et parfois plus grands que les arbres. Ils viennent dans de nombreuses variétés, mais sont le plus souvent représentés avec une peau rouge ou bleue, des cheveux sauvages, deux cornes ou plus et des défenses en forme de crocs. D\'autres variantes existent dans différentes couleurs et avec différents nombres de cornes, d\'yeux ou de doigts et d\'orteils. Ils portent des pagnes faits de peaux de grandes bêtes. Tous les oni possèdent une force et une constitution extrêmes, et nombre d\'entre eux sont des sorciers accomplis. Ce sont des démons féroces, porteurs de désastres, propagateurs de maladies et punisseurs des damnés en enfer.',	'true',	0),
(30,	8,	'Bakeneko',	'https://i.ibb.co/vk1Z7XN/bakeneko.png',	'Les Bakeneko possèdent de grandes capacités de changement de forme et se déguisent en petits chats ou humains, prenant même parfois la forme de leurs propres maîtres. Beaucoup apprennent à parler des langues humaines. Lorsqu\'ils sont déguisés, ils sont connus pour se déguiser en humains avec des serviettes enroulées autour de la tête. Sous cette forme, les bakeneko dansent joyeusement. Bien que cela semble frivole et même mignon, les bakeneko sont une menace pour toute maison dans laquelle ils vivent ou à proximité. Ils peuvent manger des choses beaucoup plus grosses qu\'eux et peuvent même consommer des choses vénéneuses sans difficulté. Il est possible pour un bakeneko de manger son propre maître puis de prendre sa forme, vivant à sa place. S\'ils ne tuent pas directement leurs propriétaires, ils peuvent faire tomber de grandes malédictions et des malheurs. Ils peuvent invoquer des boules de feu fantomatiques et sont connus pour déclencher accidentellement des incendies de maison, leurs queues agissent comme des torches enflammant tous les matériaux inflammables dans la maison. Bakeneko a également la capacité inquiétante de réanimer des cadavres frais et de les utiliser comme des marionnettes à leurs propres fins néfastes.',	'true',	0);

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `story`;
CREATE TABLE `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `story` (`id`, `title`, `content`, `slug`, `image`) VALUES
(5,	'Le Kappa',	'Les Kappa sont des humanoïdes aquatiques et reptiliens qui habitent les rivières et les ruisseaux qui traversent le Japon. Maladroits sur terre, ils sont à l\'aise dans l\'eau et prospèrent pendant les mois chauds. Les kappa ont généralement la taille et la forme d\'un enfant humain, mais malgré leur petite taille, ils sont physiquement plus forts qu\'un homme adulte. Leur peau écailleuse varie d\'un vert terreux profond à des rouges vifs et même bleus. Les corps Kappa sont construits pour la natation ; ils ont des mains et des pieds palmés, sans pouce, un bec et une carapace en forme de tortue, et une peau élastique et imperméable qui sent le poisson et qui est censée être amovible. D\'autres traits inhumains incluent trois anus qui leur permettent de faire passer trois fois plus de gaz que les humains, et des avant-bras attachés les uns aux autres à l\'intérieur de leurs coquilles - tirer sur un bras l\'allonge tandis que l\'autre bras se contracte. Mais leur caractéristique la plus distinctive est une dépression en forme de plat qui se trouve au sommet de leur crâne. Ce plat est la source du pouvoir d\'un kappa et doit être maintenu rempli d\'eau à tout moment. Si l\'eau est renversée et que le plat s\'assèche, le kappa sera incapable de bouger. Il peut même mourir.',	'le-kappa',	'https://i.ibb.co/LJqKRb0/kappa.png'),
(6,	'Kitsune',	'Il existe deux grandes variantes du kitsune. Les renards sacrés sont les serviteurs de la divinité shinto Inari, et les sanctuaires d\'Inari sont décorés de statues et d\'images de ces renards. Les légendes parlent de renards célestes apportant sagesse ou service aux humains bons et pieux. Ces renards sacrés agissent comme des messagers des dieux et des médiums entre les mondes céleste et humain. Ils protègent souvent les humains ou les lieux, portent chance et éloignent les mauvais esprits. Plus communs sont les renards sauvages qui se complaisent dans les méfaits, les farces ou le mal. Il y a des histoires dans lesquelles des renards sauvages trompent ou même possèdent des humains et les amènent à se comporter étrangement. Malgré cette nature méchante, même les renards sauvages tiennent leurs promesses, se souviennent de leurs amitiés et remboursent toutes les faveurs qui leur sont faites.',	'kitsune',	'https://i.ibb.co/q7C2h9Y/kitsune.png'),
(7,	'Oni',	'Les Oni sont l\'une des plus grandes icônes du folklore japonais. Ils sont grands et effrayants, plus grands que l\'homme le plus grand et parfois plus grands que les arbres. Ils viennent dans de nombreuses variétés, mais sont le plus souvent représentés avec une peau rouge ou bleue, des cheveux sauvages, deux cornes ou plus et des défenses en forme de crocs. D\'autres variantes existent dans différentes couleurs et avec différents nombres de cornes, d\'yeux ou de doigts et d\'orteils. Ils portent des pagnes faits de peaux de grandes bêtes. Tous les oni possèdent une force et une constitution extrêmes, et nombre d\'entre eux sont des sorciers accomplis. Ce sont des démons féroces, porteurs de désastres, propagateurs de maladies et punisseurs des damnés en enfer.',	'oni',	'https://i.ibb.co/8bf1bCY/oni.png'),
(8,	'Bakeneko',	'Les Bakeneko possèdent de grandes capacités de changement de forme et se déguisent en petits chats ou humains, prenant même parfois la forme de leurs propres maîtres. Beaucoup apprennent à parler des langues humaines. Lorsqu\'ils sont déguisés, ils sont connus pour se déguiser en humains avec des serviettes enroulées autour de la tête. Sous cette forme, les bakeneko dansent joyeusement. Bien que cela semble frivole et même mignon, les bakeneko sont une menace pour toute maison dans laquelle ils vivent ou à proximité. Ils peuvent manger des choses beaucoup plus grosses qu\'eux et peuvent même consommer des choses vénéneuses sans difficulté. Il est possible pour un bakeneko de manger son propre maître puis de prendre sa forme, vivant à sa place. S\'ils ne tuent pas directement leurs propriétaires, ils peuvent faire tomber de grandes malédictions et des malheurs. Ils peuvent invoquer des boules de feu fantomatiques et sont connus pour déclencher accidentellement des incendies de maison, leurs queues agissent comme des torches enflammant tous les matériaux inflammables dans la maison. Bakeneko a également la capacité inquiétante de réanimer des cadavres frais et de les utiliser comme des marionnettes à leurs propres fins néfastes.',	'bakeneko',	'https://i.ibb.co/vk1Z7XN/bakeneko.png');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649A188FE64` (`nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nickname`) VALUES
(1,	'user@user.com',	'[\"ROLE_USER\"]',	'$2y$13$qqr7mZlJfTiRbJV3djPwCO2Y.nUET93AJVqdrJsAG0k..dZTGkZwy',	'user'),
(2,	'manager@manager.com',	'[\"ROLE_MANAGER\"]',	'$2y$13$QAGGpcC70IoLQ9mmR7fB8.YOkLg5EIcXC1IMpkeYXFbfh5Eccvp7C',	'manager'),
(3,	'admin@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$RDUpxYUHRNWBN5lLBCS6AOFK9rixdWmF/RXglnLOv4uRSLaL5fUDe',	'admin'),
(4,	'admin1@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$aIwNIJfGInPGUVP77H249u8PoxpIOFEM/1fvC5g31LXdiikzT2jA6',	'admin1');

DROP TABLE IF EXISTS `user_story`;
CREATE TABLE `user_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `stories_id` int(11) NOT NULL,
  `start_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_994FF6067B3B43D` (`users_id`),
  KEY `IDX_994FF60BF2402DE` (`stories_id`),
  CONSTRAINT `FK_994FF6067B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_994FF60BF2402DE` FOREIGN KEY (`stories_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-10-10 08:29:03