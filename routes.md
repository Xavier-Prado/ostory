## Front-office
| URL                            | HTTP Method | Controller              | Method       | Title                  | Content            | Comment |
| ------------------------------ | ----------- | ----------------------- | ------------ | ---------------------- | ------------------ | ------- |
| `/`                            | `GET`       | `Front/MainController`  | `home`       | Accueil                | homepage           | -       |
| `/connexion`                   | `POST`      | `Front/LoginController` | `login`      | Connexion              | login page         | -       |
| `/inscription`                 | `POST`      | `Front/LoginController` | `sign-in`    | Inscription            | sign-in page       | -       |
| `/deconnexion`                 | `POST`      | `Front/LoginController` | `logout`     | -                      | logout page        | -       |
| `/histoires`                   | `GET`       | `Front/StoryController` | `list`       | Les histoires          | story list         | -       |
| `/histoires/[slug]/[id]`       | `GET`       | `Front/StoryController` | `show`       | [Nom de l'histoire]    | story page         | -       |
| `/histoires/[slug]/[id]/jouer` | `GET`       | `Front/StoryController` | `play`       | [Nom de l'histoire]    | story page game    | -       |
| `/mentions-legales`            | `GET`       | `Front/MainController`  | `legals`     | Mentions légales       | legals mentions    | -       |
| `/conditions-generales`        | `GET`       | `Front/MainController`  | `conditions` | Conditions générales   | general conditions | -       |
| `/contact`                     | `GET`       | `Front/MainController`  | `contact`    | Nous contacter         | contact            | -       |
| `/credits`                     | `GET`       | `Front/MainController`  | `credit`     | Crédits                | credits            | -       |
| `/histoire/ajout`              | `POST`      | `Front/StoryController` | `add`        | Ajouter une histoire   | add a story        | V2      |
| `/histoire/[id]/modifier`      | `POST`      | `Front/StoryController` | `edit`       | Editer une histoire    | edit a story       | V2      |
| `/histoire/[id]/supprimer`     | `POST`      | `Front/StoryController` | `delete`     | Supprimer une histoire | delete a story     | V2      |

## Back-office
| URL                          | HTTP Method | Controller                 | Method   | Title                                        | Content            | Comment                                            |
| ---------------------------- | ----------- | -------------------------- | -------- | -------------------------------------------- | ------------------ | -------------------------------------------------- |
| `back/`                      | `GET`       | `Back/MainController`      | `home`   | Accueil                                      | story list         | -                                                  |
| `back/deconnexion`           | `POST`      | `Back/LoginController`     | `logout` | -                                            | logout page        | A préciser sur le lien back/front si projet séparé |
| `back/story`                 | `GET`       | `Back/StoryController`     | `list`   | Liste des histoires                          | story list         | -                                                  |
| `back/story/add`             | `POST`      | `Back/StoryController`     | `add`    | Ajouter une histoire                         | add a game         | -                                                  |
| `back/story/[id]`            | `GET`       | `Back/StoryController`     | `show`   | [nom de l'histoire]                          | story page         | -                                                  |
| `back/story/[id]/edit`       | `POST`      | `Back/StoryController`     | `edit`   | Editer l'histoire [nom de l'histoire]        | edit a game        | -                                                  |
| `back/story/[id]/delete`     | `POST`      | `Back/StoryController`     | `delete` | -                                            | delete a game      | -                                                  |
| `back/user`                  | `GET`       | `Back/UserController`      | `list`   | Liste des utilisateurs                       | user list          | -                                                  |
| `back/user/add`              | `POST`      | `Back/UserController`      | `add`    | Ajouter un utilisateur                       | add a user         | -                                                  |
| `back/user/[id]`             | `GET`       | `Back/UserController`      | `show`   | [nom de l'utilisateur]                       | user page          | -                                                  |
| `back/user/[id]/edit`        | `POST`      | `Back/UserController`      | `edit`   | Editer un utilisateur [nom de l'utilisateur] | edit a user        | -                                                  |
| `back/user/[id]/delete`      | `POST`      | `Back/UserController`      | `delete` | -                                            | delete a user      | -                                                  |
| `back/character`             | `GET`       | `Back/CharacterController` | `list`   | Liste des personnages                        | character list     | -                                                  |
| `back/character/add`         | `POST`      | `Back/CharacterController` | `add`    | Ajouter un personnage                        | add a character    | -                                                  |
| `back/character/[id]`        | `GET`       | `Back/CharacterController` | `show`   | [nom du personnage]                          | character page     | -                                                  |
| `back/character/[id]/edit`   | `POST`      | `Back/CharacterController` | `edit`   | Editer un personnage [nom du personnage]     | edit a character   | -                                                  |
| `back/character/[id]/delete` | `POST`      | `Back/CharacterController` | `delete` | -                                            | delete a character | - -                                                |
| `back/image`                 | `GET`       | `Back/ImageController`     | `list`   | Liste des images                             | user list          | -                                                  |
| `back/image/add`             | `POST`      | `Back/ImageController`     | `add`    | Ajouter une image                            | add an image       | -                                                  |
| `back/image/[id]`            | `GET`       | `Back/ImageController`     | `show`   | [nom de l'image]                             | image page         | -                                                  |
| `back/image/[id]/edit`       | `POST`      | `Back/ImageController`     | `edit`   | Editer une image [nom de l'utilisateur]      | edit an image      | -                                                  |
| `back/location`              | `GET`       | `Back/LocationController`  | `list`   | Liste des lieux                              | Location list      | -                                                  |
| `back/location/add`          | `POST`      | `Back/LocationController`  | `add`    | Ajouter un lieu                              | add an location    | -                                                  |
| `back/location/[id]`         | `GET`       | `Back/LocationController`  | `show`   | [nom du lieu]                                | location page      | -                                                  |
| `back/location/[id]/edit`    | `POST`      | `Back/LocationController`  | `edit`   | Editer un lieu [nom du lieu]                 | edit an location   | - |
| `back/image`                 | `GET`       | `Back/ActionController`     | `list`   | Liste des images                             | user list          | -                                                  |
| `back/image/add`             | `POST`      | `Back/ImageController`     | `add`    | Ajouter une image                            | add an image       | -                                                  |
| `back/image/[id]`            | `GET`       | `Back/ImageController`     | `show`   | [nom de l'image]                             | image page         | -                                                  |
| `back/image/[id]/edit`       | `POST`      | `Back/ImageController`     | `edit`   | Editer une image [nom de l'utilisateur]      | edit an image      | -                                                  |
| `back/action`              | `GET`       | `Back/ActionController`  | `list`   | Liste des lieux                              | action list      | -                                                  |
| `back/action/add`          | `POST`      | `Back/ActionController`  | `add`    | Ajouter un lieu                              | add an action    | -                                                  |
| `back/action/[id]`         | `GET`       | `Back/ActionController`  | `show`   | [nom du lieu]                                | action page      | -                                                  |
| `back/action/[id]/edit`    | `POST`      | `Back/ActionController`  | `edit`   | Editer un lieu [nom du lieu]                 | edit an action   |
