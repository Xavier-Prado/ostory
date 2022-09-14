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
| URL                      | HTTP Method | Controller             | Method   | Title                                        | Content       | Comment                                            |
| ------------------------ | ----------- | ---------------------- | -------- | -------------------------------------------- | ------------- | -------------------------------------------------- |
| `back/`                  | `GET`       | `Back/MainController`  | `home`   | Accueil                                      | story list    | -                                                  |
| `back/deconnexion`       | `POST`      | `Back/LoginController` | `logout` | -                                            | logout page   | A préciser sur le lien back/front si projet séparé |
| `back/story`             | `GET`       | `Back/StoryController` | `list`   | Liste des histoires                          | story list    | -                                                  |
| `back/story/add`         | `POST`      | `Back/StoryController` | `add`    | Ajouter une histoire                         | add a game    | -                                                  |
| `back/story/[id]`        | `GET`       | `Back/StoryController` | `show`   | [nom de l'histoire]                          | story page    | -                                                  |
| `back/story/[id]/edit`   | `POST`      | `Back/StoryController` | `edit`   | Editer l'histoire [nom de l'histoire]        | edit a game   | -                                                  |
| `back/story/[id]/delete` | `POST`      | `Back/StoryController` | `delete` | -                                            | delete a game | -                                                  |
| `back/user`              | `GET`       | `Back/UserController`  | `list`   | Liste des utilisateurs                       | user list     | -                                                  |
| `back/user/add`          | `POST`      | `Back/UserController`  | `add`    | Ajouter un utilisateur                       | add a user    | -                                                  |
| `back/user/[id]`         | `GET`       | `Back/UserController`  | `show`   | [nom de l'utilisateur]                       | user page     | -                                                  |
| `back/user/[id]/edit`    | `POST`      | `Back/UserController`  | `edit`   | Editer un utilisateur [nom de l'utilisateur] | edit a user   | -                                                  |
| `back/user/[id]/delete`  | `POST`      | `Back/UserController`  | `delete` | -                                            | delete a user | -                                                  |
