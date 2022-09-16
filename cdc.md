# Cahier des charges du projet de site (modele)

## Contexte

### Présentation / Proposition initiale

Proposition de nom du projet : _O'story book_.  

Dans une première version du projet, il est prévu d’afficher à l’utilisateur connecté une liste d’histoires. L’utilisateur pourra démarrer une histoire et tenter d’aller jusqu’à la fin. Pour cela, il devra effectuer des choix qui le conduiront à d’autres pages.

Les utilisateurs avec au moins le rôle de modérateur, pourront accéder au backoffice et administrer la liste des utilisateurs.

Dans une version ultérieure, l’utilisateur pourra créer un personnage, combattre des monstres. Les modérateurs pourront ajouter de nouvelles histoires pour étoffer le contenu de l’application web. Il sera également possible d’administrer les histoires via le backoffice.


### Objectif / Contextualisation

Dans le cadre de la formation développement web de l’école O’clock, nous avons pour objectif de créer un projet de fin d’étude afin de mettre en pratique ce que l’on a appris pendant 5 mois de cours.

### Public visé
Dans un premier temps, les cibles sont les élèves de la promotion Einstein. Dans un second temps, l'application web sera diffusée au grand public.
L'équipe de développement aimerait faire évoluer l'application  pour permettre à tous de l'utiliser (accessibilité).

### Délai

Trois semaines à compter de la validation du projet.

### L'équipe
- Product Owner : Xavier Prado
- Scrum Master : Delphine De Alba
- Lead dev front : Camille Yamamoto
- Lead dev back : Coralie Fleury
- Reférent technique git : Camille Yamamoto
- Référent technique techno : Thomas Chantreuil

## Spécifications fonctionnelles

### Apparence

- Ambiance mythologie japonaise (Yokai).
- Site responsive, _mobile-first_.

### Contenus

- Des histoires
- Un backOffice.
- Des images, des personnages, des lieux, des actions (en v2)

Les histoires seraient créées _à terme_ via une interface d'administration et d'utilisateur.

### Interactions services

- Service de contact par email (page contact).
- Liens vers les reseaux des collaborateurs sur la (page crédit)

### Langue(s)

En français uniquement.

### Arborescence

- Accueil
- Connexion/déconnexion
- Jouer
  - Histoire [id]
    - Page[id]
- Conditions générales
- Contact
- Mentions légales
- Régles du jeu

- Back-office
- Accueil
  - Users (liste)
    - Détails
    - Ajout
    - Edition

### Liste des routes

#### Front-office

| URL                               | HTTP Method | Controller              | Method       | Title                | Content            | Comment |
| --------------------------------- | ----------- | ----------------------- | ------------ | -------------------- | ------------------ | ------- |
| `/`                               | `GET`       | `Front/MainController`  | `home`       | Accueil              | homepage           | -       |
| `/connexion`                      | `POST`      | `Front/LoginController` | `login`      | Connexion            | login page         | -       |
| `/inscription`                    | `POST`      | `Front/LoginController` | `sign-in`    | Inscription          | sign-in page       | -       |
| `/deconnexion`                    | `POST`      | `Front/LoginController` | `logout`     | -                    | logout page        | -       |
| `/histoire`                       | `GET`       | `Front/StoryController` | `list`       | Les histoires        | story list         | -       |
| `/histoire/[slug]/[id]/[page:id]` | `GET`       | `Front/StoryController` | `play`       | [Nom de l'histoire]  | story page game    | -       |
| `/mentions-legales`               | `GET`       | `Front/MainController`  | `legals`     | Mentions légales     | legals mentions    | -       |
| `/conditions-generales`           | `GET`       | `Front/MainController`  | `conditions` | Conditions générales | general conditions | -       |
| `/contact`                        | `GET`       | `Front/MainController`  | `contact`    | Nous contacter       | contact            | -       |
| `/regles-du-jeu`                  | `GET`       | `Front/MainController`  | `rules`      | Règles du jeu        | rules of the game  | -       |

#### Back-office

| URL                     | HTTP Method   | Controller             | Method   | Title                                        | Content       | Comment                                            |
| ----------------------- | ------------- | ---------------------- | -------- | -------------------------------------------- | ------------- | -------------------------------------------------- |
| `back/`                 | `GET`         | `Back/MainController`  | `home`   | Accueil                                      | story list    | -                                                  |
| `back/deconnexion`      | `POST`        | `Back/LoginController` | `logout` | -                                            | logout page   | A préciser sur le lien back/front si projet séparé |
| `back/user`             | `GET`         | `Back/UserController`  | `list`   | Liste des utilisateurs                       | user list     | -                                                  |
| `back/user/add`         | `POST`        | `Back/UserController`  | `add`    | Ajouter un utilisateur                       | add a user    | -                                                  |
| `back/user/[id]`        | `GET`         | `Back/UserController`  | `show`   | [nom de l'utilisateur]                       | user page     | -                                                  |
| `back/user/[id]/edit`   | `PUT` `PATCH` | `Back/UserController`  | `edit`   | Editer un utilisateur [nom de l'utilisateur] | edit a user   | -                                                  |
| `back/user/[id]/delete` | `DELETE`      | `Back/UserController`  | `delete` | -                                            | delete a user | -                                                  | - |


### User story

- En tant que visiteur, je veux pouvoir naviguer entre plusieurs pages
- En tant que visiteur, je veux pouvoir me connecter à un compte utilisateur via l'email ou le pseudonyme
- En tant que visiteur, je veux pouvoir créer un compte utilisateur
- En tant que modérateur, je veux pouvoir avoir accès au BackOffice
- En tant qu'utilisateur, je veux pouvoir supprimer mon compte
- En tant qu'utilisateur, je veux pouvoir naviguer entre les pages spécifiques à l'utilisateur
- En tant qu'utilisateur, je veux pouvoir modifier ses informations sur mon profil
- En tant qu'utilisateur, je veux pouvoir lancer une histoire
- En tant qu'utilisateur, je veux pouvoir me déconnecter de mon compte
- En tant qu'utilisateur, je veux pouvoir contacter un administrateur
- En tant qu'utilisateur, je veux pouvoir avoir le choix entre plusieurs actions
- En tant qu'utilisateur, je veux pouvoir avoir accès à la liste des histoires
- En tant qu'admin, je veux pouvoir voir un utilisateur
- En tant qu'admin, je veux pouvoir supprimer un utilisateur
- En tant qu'admin, je veux pouvoir editer un utilisateur
- En tant qu'admin, je veux pouvoir ajouter un utilisateur
- En tant qu'admin, je veux pouvoir accéder à la liste des utilisateurs

### Navigation sur le site

- Un menu principal (_responsive_) vers le backoffice et le bouton de connexion/déconnexion.
  - petits écrans : un menu « burger » dans lequel se trouvent les liens
- On clique sur `Commencer` pour accéder à la liste des histoires
- On peut cliquer sur une histoire pour la démarrer.
- Un menu secondaire (dans le footer) vers Contact, Mentions légales, règles du jeu, conditions générales. Pour la version responsive, les liens se trouveront dans le menu burger décrit ci-dessus.

### Wireframes

#### Layout global

- Un menu avec :
  - Titre/logo
  - Liens vers les catégories
- Une image d'en-tête avec titre + slogan (baseline)
- "Sidebar" à droite qui regroupe :
  - Champ de recherche
  - Liste des catégories
  - Liste des auteurs
- Pied de page :
  - Liens vers les réseaux sociaux
  - Liens vers admin, contact, mentions légales

#### Liste des articles

- La page d'accueil liste les derniers articles (nombre exact à déterminer).
- Pagination "Précédente" et "Suivante".
- Un article présente :
  - Un titre (cliquable)
  - Un résumé (cliquable)
  - Une date
  - Un auteur
  - Une catégorie

### Contraintes techniques

- Site _responsive_ en _mobile-first_.
- Compatibilité uniquement avec les dernières versions des navigateurs (Chrome, Firefox et Edge...).

## Spécifications techniques

### Architecture logicielle choisie

Le site sera conçu avec :

#### Côté front

- HTML5 : le code respectera une sémantique correcte.
- CSS : dans sa version 3
- React : react-redux, axios, react router dom, Sass, React Model, Redux dev tools
- Javascript

#### Côté back

- PHP : PHP7 sera utilisé.
- Adminer/PhpMyAdmin et Mysql/MariaDb
- Symfony : Bundle Security, Bundle validator, Doctrine, Doctrine annotation, SensioFrameworkExtraBundle,  doctrinefixtureBundle, FakerPhp, debug-bundle, profiler-pack, forms

### Description des données

## utilisateur (`user`)

| Champ      | Type         | Spécificités                                    | Description                                         |
| ---------- | ------------ | ----------------------------------------------- | --------------------------------------------------- |
| id         | INT          | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'utilisteur                       |
| nickname   | VARCHAR(50)  | NOT NULL                                        | Le pseudo de l'utilisateur                          |
| email      | VARCHAR(255) | NOT NULL                                        | Email de l'utilisateur                              |
| password   | VARCHAR(50)  | NOT NULL                                        | Mot de passe de l'utilisateur                       |
| role       | VARCHAR(50)  | NOT NULL                                        | Le rôle de l'utilisateur                            |
| created_at | TIMESTAMP    | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'utilisateur                |
| updated_at | TIMESTAMP    | NULL                                            | La date de la dernière mise à jour de l'utilisateur |


## Histoire (`story`)

| Champ      | Type          | Spécificités                                    | Description                                      |
| ---------- | ------------- | ----------------------------------------------- | ------------------------------------------------ |
| id         | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'histoire                      |
| title      | VARCHAR(255)  | NOT NULL                                        | Le nom de l'histoire                             |
| content    | LONGTEXT      | NOT NULL                                        | Résumé de l'histoire                             |
| slug       | VARCHAR(255)  | NOT NULL                                        | Slug                                             |
| image      | VARCHAR(2083) | NOT NULL                                        | L'URL de l'image de l'histoire                   |
| created_at | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'histoire                |
| updated_at | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de l'histoire |


## page (`page`)

| Champ             | Type          | Spécificités                                    | Description                                   |
| ----------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de la page                      |
| title             | VARCHAR(128)  | NOT NULL                                        | Le nom de la page                             |
| image             | VARCHAR(2083) | NOT NULL                                        | L'url de l'image de la page                   |
| content           | LONGTEXT      | NOT NULL                                        | L'url de la page                              |
| choice_pages      | VARCHAR(50)   | NULL                                            | Les identifiants des pages de choix suivantes |
| description_pages | LONGTEXT      | NOT NULL                                        | Texte de description des choix                |
| created_at        | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de la page                |
| updated_at        | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de la page |