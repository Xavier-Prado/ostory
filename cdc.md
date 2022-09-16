# Cahier des charges du projet de site (modele)

## Contexte

### Présentation / Proposition initiale

Proposition de nom du projet : _O'story book_.  

Il s’agit de proposer aux lecteurs nostalgiques des “Livres dont vous êtes le héros” un jeu qui regroupe plusieurs petites histoires dont l’avancée se fait au gré des décisions du joueur sur le même principe que ces livres sur le thème des yokai et de la mythologie japonaise afin de lui faire découvrir ce monde assez méconnu du grand public.

### Objectif / Contextualisation

Dans le cadre de la formation développement web de l’école O’clock, nous avons pour objectif de créer un projet de fin d’étude afin de mettre en pratique ce que l’on a appris pendant 5 mois de cours.

### Délai

Trois semaines à compter de la validation du projet.

## Spécifications fonctionnelles

### Apparence

- Ambiance "japon" (Yokai).
- Site responsive, _mobile-first_.

### Contenus

- Des histoires
- Un backOffice pour la gestion du contenu.
- Des images, des personnages, des lieux, des actions.

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
- Conditions générales
- Contact
- Mentions légales
- Régles du jeu

- Back-office
- Accueil
  - Histoires (liste)
    - Détails
    - Ajout
    - Edition
  - Pages (liste)
    - Détails
    - Ajout
    - Edition
  - Users (liste)
    - Détails
    - Ajout
    - Edition
  - Lieux (liste)
    - Détails
    - Ajout
    - Edition
  - Personnages (liste)
    - Détails
    - Ajout
    - Edition
  
  

### Navigation sur le site

- Un menu principal (_responsive_) vers les catégories et l'accueil.
  - petits écrans : un menu « burger » dans lequel se trouvent les liens
  - sinon : liste de liens visibles
- On clique sur le titre ou l'extrait de texte de l'article pour en afficher le contenu complet.
- On peut cliquer sur une catégorie pour aller sur une page listant tous les articles de cette catégorie.
- Un menu secondaire (dans le footer ou ailleurs) pour lier vers Contact, Mentions légales & Admin.

### Templates / charte graphique

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
- Compatibilité uniquement avec les dernières versions des navigateurs (Chrome, Firefox, Microsoft Internet Explorer 11 et Edge).

## Spécifications techniques

### Architecture logicielle choisie

Le site sera conçu avec :

#### Côté front

- HTML5 : le code respectera une sémantique correcte.
- CSS : dans sa version 2 ou 3, pour rester compatible avec Internet Explorer 11. L'utilisation d'un framework pour le _responsive_/_mobile-first_ est envisagé.
- JavaScript : sera utilisé si besoin, avec parcimonie néanmoins (pas de fonctionnalités bloquantes).

#### Côté back

- PHP : PHP7 sera utilisé, ainsi que la classe `PDO` pour accéder aux données MySQL.
- MySQL : permettra de stocker & persister les données.

### Description des données

- Articles
  - Titre
  - Résumé
  - Date du publication
  - Nombre de vues
  - Auteur de l'article
  - Catégorie à laquelle appartient l'article
- Auteurs
  - Nom
  - Prénom
  - Image de profil
- Catégories
  - Intitulé