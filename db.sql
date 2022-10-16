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
(41,	22,	'L\'offrande',	'Malgré votre colère, vous gardez votre calme.\r\n\"Bonjour, que fais-tu là mon ami ? Tu as faim on dirait ? Puis-je t\'offrir un concombre ?\"',	23),
(42,	21,	'Saluer le Kappa',	'La situation peut être critique mais il faut que j\'évite de paniquer.\r\n\"Bonjour\"',	26),
(43,	21,	'L\'attaque est la meilleure défense',	'Je suis clairement en danger, l\'attaque est la meilleure des défenses, je vais l\'immobiliser en le prenant par surprise ! \"Yaaaaaaaaaaaaaaaaaaaaaaaaaaaaaahhhhhhhhhh\"',	27),
(44,	20,	'Faire une ballade le long de la rivière',	'Pfff... Y\'en a marre de rester toujours devant l\'ecran et d\'essayer de trouver des idées originales pour les prochaines histoires du projet ! J\'en rêve carrément la nuit. J\'ai besoin de prendre l\'air et de marcher le long de la rivière pour me ressourcer.',	21),
(45,	31,	'Le refus',	'Alors même qu’il était épuisé, il refusa poliment et décida de chercher une autre auberge.',	38),
(46,	31,	'Partager la chambre',	'Il accepta de partager sa chambre avec la jeune femme et demanda une séparation au milieu de la pièce pour éviter de l’importuner.',	33),
(47,	33,	'Suivre la femme',	'L\'homme décida de suivre la jeune femme discrètement.',	39),
(48,	33,	'Un sommeil léger',	'\"Je dois être somnambule\". L\'homme décida de rester dans son lit et de s’endormir.',	40),
(49,	39,	'Lui arracher la tête',	'L\'homme bondit sur Rokurokubi pour lui arracher la tête !',	35),
(50,	41,	'Un voyage à deux',	'L\'homme répondit : \r\n\"Super ! Puisque nous avons la chance d\'être ensemble, voyageons ensemble !\"',	37),
(51,	39,	'Rertourner à l\'auberge et dormir',	'Apeuré, l\'homme fit demi-tour, se précipita dans sa chambre et s\'endormit d\'un sommeil léger.',	41),
(52,	41,	'Tenter de fuir',	'La femme invita l\'homme à se joindre à lui pour voyage. L\'homme refusa et détourna la tête.',	36);

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
(20,	5,	'Enfin le week end',	'https://i.ibb.co/MGNXLzT/2.jpg',	'C\'est enfin le week-end ! Cette semaine d\'apothéose fût intense et enrichissante ! Guillaume nous a bien mis la pression vendredi, il la voulait son histoire; et bien... là voilà !\r\nC\'est l\'heure de se reposer. Que faire ce week-end ?',	'true',	0),
(21,	5,	'Le long de la rivière',	'https://i.ibb.co/xM2h0ch/forest-sky-background.jpg',	'Quel plaisir de profiter de l\'air frais et du clapotis de la rivière ! Vous n\'avez cependant pas vu le panneau signalant la probable présence du kappa.\r\nManque de chance, vous tombez nez-à-nez avec lui. Vous savez également qu\'un Kappa peut être très dangereux. Vous auriez préféré croiser un Shirime !\r\n\r\nQue faites-vous ?',	'false',	0),
(22,	5,	'L\'heure du goûter',	'https://i.ibb.co/MGNXLzT/2.jpg',	'Vous enchaînez les épisodes, mais un bon dev ne peut pas rester trop longtemps le ventre vide. Vous avez faim et besoin d\'un café.\r\nHorreur ! Un kappa a retourné votre cuisine ! Tout est sans dessus dessous ! Et en plus, il mange tranquillement le dernier cookie du paquet que vous aviez prévu de manger !\r\nVous êtes très énervé !',	'false',	0),
(23,	5,	'Le concombre',	'https://i.ibb.co/7y4tjwT/kappa.png',	'Le Kappa accepte le concombre que vous lui tendez et vous remercie gracieusement. \r\nTout en mangeant le concombre, il sort de votre maison.\r\n\r\nVous pouvez enfin terminer le dernier épisode de votre série avant d\'attaquer cette ultime semaine chez Oclock',	'false',	1),
(24,	5,	'Votre heure a sonné',	'https://i.ibb.co/7y4tjwT/kappa.png',	'Le kappa n\'apprécie pas du tout votre comportement et s\'élance sur vous !\r\nVous tentez de renverser le plat d\'eau qui se trouve sur sa tête. Vous échouez lamentablement. Le Kappa, affamé vous dévore les entrailles',	'false',	2),
(25,	5,	'Les salutations',	'https://i.ibb.co/7y4tjwT/kappa.png',	'Le Kappa vous salue en retour et continue son chemin.\r\nVous l\'avez échappé bel ! Vous continuez votre promenade et arrivez en forme lundi matin pour cette dernière semaine de cours chez Oclock',	'false',	1),
(26,	5,	'Politesse',	'https://i.ibb.co/7y4tjwT/kappa.png',	'Le Kappa vous salue en retour et continue son chemin.\r\nVous l\'avez échappé bel ! Heureusement, vous saviez que le Kappa est un yokai très poli. Vous continuez votre promenade et arrivez en forme lundi matin pour cette dernière semaine de cours chez Oclock',	'false',	1),
(27,	5,	'L\'attaque est la meilleure des défense',	'https://i.ibb.co/7y4tjwT/kappa.png',	'Perdant votre sang froid, vous vous ruez sur le Kappa dans l\'espoir de lui renverser son plat d\'eau dans le but de l\'immobiliser et de vous enfuir.\r\nMalheureusement, cela ne se passe pas comme prévu. Le Kappa vous envoie dans l\'eau de la rivière entraînant votre mort par noyade.',	'false',	2),
(28,	6,	'Kitsune',	'https://i.ibb.co/q7C2h9Y/kitsune.png',	'Il existe deux grandes variantes du kitsune. Les renards sacrés sont les serviteurs de la divinité shinto Inari, et les sanctuaires d\'Inari sont décorés de statues et d\'images de ces renards. Les légendes parlent de renards célestes apportant sagesse ou service aux humains bons et pieux. Ces renards sacrés agissent comme des messagers des dieux et des médiums entre les mondes céleste et humain. Ils protègent souvent les humains ou les lieux, portent chance et éloignent les mauvais esprits. Plus communs sont les renards sauvages qui se complaisent dans les méfaits, les farces ou le mal. Il y a des histoires dans lesquelles des renards sauvages trompent ou même possèdent des humains et les amènent à se comporter étrangement. Malgré cette nature méchante, même les renards sauvages tiennent leurs promesses, se souviennent de leurs amitiés et remboursent toutes les faveurs qui leur sont faites.',	'true',	0),
(29,	7,	'Oni',	'https://i.ibb.co/8bf1bCY/oni.png',	'Les Oni sont l\'une des plus grandes icônes du folklore japonais. Ils sont grands et effrayants, plus grands que l\'homme le plus grand et parfois plus grands que les arbres. Ils viennent dans de nombreuses variétés, mais sont le plus souvent représentés avec une peau rouge ou bleue, des cheveux sauvages, deux cornes ou plus et des défenses en forme de crocs. D\'autres variantes existent dans différentes couleurs et avec différents nombres de cornes, d\'yeux ou de doigts et d\'orteils. Ils portent des pagnes faits de peaux de grandes bêtes. Tous les oni possèdent une force et une constitution extrêmes, et nombre d\'entre eux sont des sorciers accomplis. Ce sont des démons féroces, porteurs de désastres, propagateurs de maladies et punisseurs des damnés en enfer.',	'false',	0),
(31,	9,	'L\'auberge',	'https://i.ibb.co/ZJt1CD4/night-sky-background.jpg',	'Il était une fois un homme qui voyageait seul.\r\n \r\nUn jour, alors que le soleil se couchait, il voulut s\'arrêter dans une auberge.\r\nCependant, l\'auberge était complète ce-jour là, il n\'y avait plus de place.\r\nUne belle et mystérieuse femme lui proposa de partager sa chambre',	'true',	0),
(32,	9,	'Une bonne nuit de sommeil',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png',	'Après une bonne nuit de sommeil, il continua son voyage.',	'false',	1),
(33,	9,	'La femme au long cou',	'https://i.ibb.co/ZJTSzvK/auberge-bedroom-background.jpg',	'Au crépuscule, il entendit la femme derrière les rideaux. Elle n’arrêtait pas de se tortiller… Elle non plus, n\'arrivait pas à trouver le sommeil\r\n\"Elle devait sûrement aller se rafraîchir un peu\", se dit-il.\r\n L\'homme était enfin sur le point de s\'endormir, quand il sentit soudain une brise chaude souffler.\r\n Il posa son regard par-dessus la séparation, et…\r\nLa tête d\'une femme flottait. Son cou blanc était étiré en longueur et en finesse.\r\n “ Qu’est-ce que…. Mais cette femme est Rokurokubi ! ”, réalisa-t-il !\r\n“ Si elle se met à faire quelque chose de bizarre, je l’attrape par le cou et lui arrache la tête…”, pensa-t-il.\r\nMais la femme au long cou s’envola à travers les volets et quitta la pièce tandis qu\'il faisait semblant de dormir.',	'false',	0),
(34,	9,	'Après la nuit',	'https://i.ibb.co/28c7qjZ/auberge-background-yosei.jpg',	'Le lendemain matin, la femme se réveille plus tôt que l\'homme et l\'appelle de derrière les rideaux.\r\n “ Il faisait très chaud et humide la nuit dernière, n\'est-ce pas ? Vous avez bien dormi ? “\r\n L\'homme a répondu en rangeant son futon et en ouvrant la séparation. \r\n“ … En effet. Il faisait chaud, mais je devais être très fatigué hier, car j\'ai dormi profondément et je n\'ai pas fait un seul rêve.”, dit délibérément l\'homme d\'un air blasé.\r\nLa femme rit et dit : \"Oh, mon cher, vous avez fait une chose si étrange.\r\n “ Qu\'ai-je fait de si étrange ? C\'est vous qui avez fait la chose étrange. ”\r\n La femme sourit.\r\n \"Ai-je fait une chose délicate ?\r\nOui. Sous l’apparence d’une belle femme, vous n’êtes en réalité qu’un monstre qui s\'est échappé de cette pièce pour aller boire l\'eau du lac.\r\nLorsque l\'homme a dit cela les yeux de la femme se sont rétrécis et répondit :\r\nTu as donc fini par le remarquer, n\'est-ce pas ?  \r\nEn entendant cela, l\'homme réalisa sa bêtise.\r\nQue faisons nous maintenant ?　Pourquoi ne pas voyager ensemble, rien que nous deux ?\"',	'false',	0),
(35,	9,	'Autour du cou',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png',	'Elle fonça sur l\'homme, s\'enroula autour de son cou.\r\nL\'homme gémit et mourut dans l\'obscurité de la nuit.',	'false',	2),
(36,	9,	'Fuir et voyager seul',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png',	'“ Non, non. Je vous remercie pour votre proposition, mais ......\" \r\nIl s\'empresse de faire ses bagages et de quitter l\'auberge.\r\nIl disparut au loin et continua son voyage seul.',	'false',	1),
(37,	9,	'Voyager à deux',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png',	'\"Super ! Puisque nous avons la chance d\'être ensemble, voyageons ensemble !\"\r\nL\'homme et la femme voyageaient ensemble en bons termes, comme deux vauriens.',	'false',	1),
(38,	9,	'Une autre auberge',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png',	'L\'homme trouva une chambre dans une autre auberge, à quelques kilomètres.\r\nAprès une bonne nuit de sommeil, il continua son voyage.',	'false',	1),
(39,	9,	'Le lac dans la forêt',	'https://i.ibb.co/Tcyw4CB/lac-garden-background-yosei.jpg',	'La jeune femme arriva dans une forêt où se trouve un lac.\r\nElle posa ses lèvres sur l’eau, tira sa longue langue et but.\r\n“ Oh, il fait si chaud aujourd\'hui, n\'est-ce pas ? J\'ai très soif… ”, dit-elle à voix haute\r\nL\'homme, caché derrière un arbre, se racle la gorge, conscient qu\'il avait été repéré. \r\nL’étrange femme se retourna, regarda en direction de l’arbre et se mis à glousser.',	'false',	0),
(40,	9,	'Après une bonne nuit, il se remet en route',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png',	'Après une bonne nuit de sommeil, il reprit son voyage comme ci rien ne s\'était produit.',	'false',	1),
(41,	9,	'Reveil aux aurores',	'https://i.ibb.co/28c7qjZ/auberge-background-yosei.jpg',	'Le lendemain matin, la femme se réveilla plus tôt que l\'homme et l’interpella de derrière les rideaux.\r\n “ Il faisait très chaud et humide la nuit dernière, n\'est-ce pas ? Vous avez bien dormi ? “\r\n L\'homme a répondit en rangeant son futon et en ouvrant la séparation. \r\n“ … En effet. Il faisait chaud, mais je devais être très fatigué hier, car j\'ai dormi profondément et je n\'ai pas fait un seul rêve.”, dit délibérément l\'homme d\'un air blasé.\r\nLa femme rit et dit : \"Oh, mon cher, vous avez fait une chose si étrange.\"\r\n “ Qu\'ai-je fait de si étrange ? C\'est vous qui avez un comportement étrange. ”\r\n La femme sourit.\r\n \"Ai-je fait une chose indélicate ?\r\n\"Oui. Sous l’apparence d’une belle femme, vous n’êtes en réalité qu’un monstre qui s\'est échappé de cette pièce pour aller boire l\'eau du lac.\"\r\nLes yeux de la femmes s’écarquillèrent. L\'homme ne réalisa que trop tard sa bêtise. Il était pris au piège :\r\n\"Tu as donc fini par le remarquer, n\'est-ce pas ? Que faisons nous maintenant ? Pourquoi ne pas voyager ensemble, rien que nous deux ? \", lança-t-elle d\'un air ravis.',	'false',	0);

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
(5,	'Le Kappa',	'Les Kappa sont des humanoïdes aquatiques et reptiliens qui habitent les rivières et les ruisseaux qui traversent le Japon. Maladroits sur terre, ils sont à l\'aise dans l\'eau et prospèrent pendant les mois chauds. Les kappa ont généralement la taille et la forme d\'un enfant humain, mais malgré leur petite taille, ils sont physiquement plus forts qu\'un homme adulte. Leur peau écailleuse varie d\'un vert terreux profond à des rouges vifs et même bleus. Les corps Kappa sont construits pour la natation ; ils ont des mains et des pieds palmés, sans pouce, un bec et une carapace en forme de tortue et une peau élastique et imperméable qui sent le poisson et qui est censée être amovible. D\'autres traits inhumains incluent trois anus qui leur permettent de faire passer trois fois plus de gaz que les humains, et des avant-bras attachés les uns aux autres à l\'intérieur de leurs coquilles - tirer sur un bras l\'allonge tandis que l\'autre bras se contracte. Mais leur caractéristique la plus distinctive est une dépression en forme de plat qui se trouve au sommet de leur crâne. Ce plat est la source du pouvoir d\'un kappa et doit être maintenu rempli d\'eau à tout moment. Si l\'eau est renversée et que le plat s\'assèche, le kappa sera incapable de bouger. Il peut même mourir.',	'le-kappa',	'https://i.ibb.co/7y4tjwT/kappa.png'),
(6,	'Kitsune',	'Il existe deux grandes variantes du kitsune. Les renards sacrés sont les serviteurs de la divinité shinto Inari, les sanctuaires d\'Inari sont décorés de statues et d\'images de ces renards. Les légendes parlent de renards célestes apportant sagesse ou service aux humains bons et pieux. Ces renards sacrés agissent comme des messagers des dieux et des médiums entre les mondes céleste et humain. Ils protègent souvent les humains ou les lieux, portent chance et éloignent les mauvais esprits. Plus communs sont les renards sauvages qui se complaisent dans les méfaits, les farces ou le mal. Il y a des histoires dans lesquelles des renards sauvages trompent ou même possèdent des humains et les amènent à se comporter étrangement. Malgré cette nature méchante, même les renards sauvages tiennent leurs promesses, se souviennent de leurs amitiés et remboursent toutes les faveurs qui leur sont faites.',	'kitsune',	'https://i.ibb.co/q7C2h9Y/kitsune.png'),
(7,	'Oni',	'Les Oni sont l\'une des plus grandes icônes du folklore japonais. Ils sont grands et effrayants, plus grands que l\'homme le plus grand et parfois plus grands que les arbres. Ils viennent dans de nombreuses variétés, mais sont le plus souvent représentés avec une peau rouge ou bleue, des cheveux sauvages, deux cornes ou plus et des défenses en forme de crocs. D\'autres variantes existent dans différentes couleurs et avec différents nombres de cornes, d\'yeux ou de doigts et d\'orteils. Ils portent des pagnes faits de peaux de grandes bêtes. Tous les oni possèdent une force et une constitution extrêmes et nombre d\'entre eux sont des sorciers accomplis. Ce sont des démons féroces, porteurs de désastres, propagateurs de maladies et punisseurs des damnés en enfer.',	'oni',	'https://i.ibb.co/8bf1bCY/oni.png'),
(9,	'Rokurokubi',	'De jour, les rokurokubi semblent être des femmes ordinaires. La nuit, cependant, leurs corps dorment tandis que leurs cous s\'étirent à des longueurs incroyables et se promènent librement. Parfois, leur tête attaque de petits animaux ; parfois ils lèchent de l\'huile à lampe avec leurs longues langues ; et parfois, ils causent simplement des méfaits en effrayant les personnes à proximité.',	'rokurokubi',	'https://i.ibb.co/yFS4Dzm/Rokurokubi.png');

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
(1,	'fifounette@gmail.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$Yp5NbtVsehxSexzSFJcrcOAu3zF5oPPE29RG.ZhW2lXewWco.IpUO',	'fifounette'),
(2,	'stanstan@gmail.com',	'[\"ROLE_MANAGER\"]',	'$2y$13$wWBwp9YHzj.Aki.V0GB/I.stDTR.QeKKN1hiu4Fy4iFvUnhCbkOCK',	'stanstan'),
(3,	'coco@outook.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$ks77GzqMEf2qWlAoHX49Iu0iyXiYz/kWPIgSd6AEk/MQJbcYANpna',	'eila'),
(4,	'thomC@gmail.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$Ovoc9rvEA8w0o/N/vSp6Kuys19JXBzzFMvbL9btRHKK0E9NwSo3t.',	'cli-king'),
(5,	'fabinou@yahoo.com',	'[\"ROLE_USER\"]',	'$2y$13$n0F.wjSkEfO1flLwnUYTXeRa3B.oBWZs7w1yG2RL7CHq.5mThuEzq',	'fabrizio'),
(6,	'elmaestro@yahoo.com',	'[\"ROLE_USER\"]',	'$2y$13$rJeiy/malX2B3g1vTqfdNe.QqUXuC9f2hmJpteRXr8COOb96SFLmm',	'maitrecanard'),
(7,	'guigui@gmail.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$ieHn2prNbMUxU3voyz8Ro.Zshh6SFcESjG7CZHxb/TIOTIwAeMReG',	'guiguiTheBoss'),
(8,	'xav@gmail.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$qYkMXE1Q4uV4PIXGuyinq.11a1lnjqTu90nGAmblKaGbObivpDdPW',	'xav');

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


-- 2022-10-16 14:51:24