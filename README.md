# ChatRoom, le forum des aficionados de chats

## Description
ChatRoom est un forum dédié aux personnes voulant communiquer et partager au sujet des chats, le forum est accessible à tous, n'importe qui peut lire et créer des topics/écrire des messages sans avoir besoin de se connecter.

## Sitemap

![Texte alternatif](http://image.noelshack.com/fichiers/2018/07/4/1518695767-sitemap-chatroom.png)

## Base de données

| databaseSI    |     
| ------------- |
| categories    |
| topics        |
| replies       |
| users         |

#### categories

| Nom | Type | Extra |
| --- | --- | --- |
| category_id_ | int(11) | |
| name | varchar(30) | AUTO-INCREMENT |

#### topics

| Nom | Type | Extra |
| --- | --- | --- |
| topic_id_ | int(11) | AUTO-INCREMENT |
| category_id_ | int(11) | |
| subject | varchar(255) | |
| date | datetime | CURRENTTIMESTAMP |

#### replies

| Nom | Type | Extra |
| --- | --- | --- |
| reply_id_ | int(11) | AUTO-INCREMENT |
| topic_id_ | int(11) |  |
| category_id_ | int(11) | |
| content | text | |
| date | datetime | CURRENTTIMESTAMP |
| author | varchar(255) | |

#### users

| Nom | Type | Extra |
| --- | --- | --- |
| id | int(11) | AUTO-INCREMENT |
| username | varchar(255) |  |
| email | varchar(255) | |
| password | varchar(255) | |
| admin | tinyint(1) |  |

## Fonctionnement du site

### index.php

- Récupère et affiche les tables **Topics** du plus récent au plus ancien.

### category.php

- Récupère et affiche la table **Categories** correspondant au **$_GET['category']**.
- Récupère et affiche les tables **Topics** correspondant à la catégorie ciblé.
- Permet d'ajouter un topic (et son premier message) à la catégorie ciblé.

### topic.php

- Récupère et affiche la table **Topics** correspondant au **$_GET['topic']**.
- Récupère et affiche les tables **Replies** correspondant au topic ciblé.
- Permet d'ajouter un commentaire au topic ciblé.

.
___
### Espace Admin

#### login.php

- Récupère les informations entrés dans le **$_POST['username']** et dans le **$_POST['password']** et les compare avec la table **Users**.
- Si les informations concordent avec la table **Users**, le **$_SESSION['login']** est initialisé.

#### verification-login.php

- Vérifie si le **$_SESSION['login']** est initialisé
    - Si oui : Il affiche le contenu des pages du répertoire **"/admin"**
    - Si non : Il redirige vers la page **login.php**

#### logout.php

- Détruit toutes les sessions initialisées

#### index.php

- Récupère et affiche toutes les tables **Categories**.
- Permet d'accéder à la page **editCategory.php**, **deleteCategory.php** ainsi qu'à la page **addCategory.php**.

#### addCategory.php

- Récupère l'information entré dans le **$_POST['name']** et l'utilise pour ajouter une table dans **Categories** avec le **$_POST['username']** comme **name**.

#### editCategory.php

- Récupère et affiche la table **Categories** correspondant au **$_GET['edit']**.
- Récupère et affiche les tables **Topics** de la catégorie ciblée.
- Permet d'accéder à la page **editTopic.php** et à la page **deleteTopic.php**.
- Permet de modifier le nom de la catégorie en le remplaçant par **$_POST['name']**.

#### deleteCategory.php

- Récupère et affiche la table **Categories** correspondant au **$_GET['delete']**.
- Permet de supprimer la table ciblé avant de revenir à la page **index.php**.

#### editTopic.php

- Récupère et affiche la table **Topics** correspondant au **$_GET['edit']**.
- Récupère et affiche les tables **Replies** du topic ciblée.
- Permet d'accéder à la page **editReply.php** et à la page **deleteReply.php**.
- Permet de modifier le nom du topic en le remplaçant par **$_POST['subject']**.

#### deleteTopic.php

- Récupère et affiche la table **Topics** correspondant au **$_GET['delete']**.
- Permet de supprimer la table ciblé avant de revenir à la page **editCategory.php** du topic supprimé.

#### editReply.php

- Récupère et affiche la table **Replies** correspondant au **$_GET['edit']**.
- Permet de modifier le message et l'auteur en les remplaçant par **$_POST['content']** et **$_POST['author']**.

#### deleteReply.php

- Récupère et affiche la table **Topics** correspondant au **$_GET['delete']**.
- Permet de supprimer la table ciblé avant de revenir à la page **editCategory.php** du topic supprimé.

___

#### Informations complémentaires :

- La connexion à la base de donnée, le header et le footer du projet sont stockés dans le répertoire **/layouts**.

- Les feuilles de style sont stockés dans le répertoire **/ressources**.

- Il n'y a pas d'espace pour s'inscrire, pour avoir accès à l'espace Admin il faut insérer manuellement un **username** et un **password** dans la table **Users**.

## SQL

### Initialisation de la base de données

```SQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `databasesi`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL DEFAULT 'Anonymous',
  PRIMARY KEY (`reply_id`),
  KEY `repliesTOcategories` (`category_id`),
  KEY `repliesTOtopics` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`),
  KEY `topicsTOcategoriesID` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`) VALUES
(1, 'admin', 'admin@mail.com', 'admin', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `repliesTOcategories` FOREIGN KEY (`category_id`) REFERENCES `topics` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repliesTOtopics` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topicsTOcategoriesID` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```