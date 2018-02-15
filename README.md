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
| subjec_ | varchar(255) | |
| date | datetime | CURRENTTIMESTAMP |

#### replies

| Nom | Type | Extra |
| --- | --- | --- |
|reply_id_ | int(11) | AUTO-INCREMENT |
|topic_id_ | int(11) |  |
|category_id_ | int(11) | |
| content | text | |
| date | datetime | CURRENTTIMESTAMP |
| author | varchar(255) | |

#### users

| Nom | Type | Extra |
| --- | --- | --- |
|id | int(11) | AUTO-INCREMENT |
|username | varchar(255) |  |
|email | varchar(255) | |
| password | varchar(255) | |
| admin | tinyint(1) | . |

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
