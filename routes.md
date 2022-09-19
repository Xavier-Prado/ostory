# Routes

## Front-office

| URL                               | HTTP Method | Controller              | Method       | Title                | Content            | Comment |
| --------------------------------- | ----------- | ----------------------- | ------------ | -------------------- | ------------------ | ------- |
| `/`                               | `GET`       | `Front/MainController`  | `home`       | Accueil              | homepage           | -       |
| `/connexion`                      | `POST`      | `Front/LoginController` | `login`      | Connexion            | login page         | -       |
| `/inscription`                    | `POST`      | `Front/LoginController` | `sign-in`    | Inscription          | sign-in page       | -       |
| `/deconnexion`                    | `POST`      | `Front/LoginController` | `logout`     | -                    | logout page        | -       |
| `/user/[id]`                      | `GET`       | `Front/UserController`  | `show`       | -                    | Show user page     | -       |
| `/user/[id]/edit`                 | `POST`      | `Front/UserController`  | `edit`       | -                    | Edit user page     | -       |
| `/user/[id]/delete`               | `POST`      | `Front/UserController`  | `delete`     | -                    | Delete user        | -       |
| `/credits`                        | `GET`       | `Front/MainController`  | `credits`    | Page des crédits     | links              | -       |
| `/histoire`                       | `GET`       | `Front/StoryController` | `list`       | Les histoires        | story list         | -       |
| `/histoire/[slug]/[id]/[page:id]` | `GET`       | `Front/StoryController` | `play`       | [Nom de l'histoire]  | story page game    | -       |
| `/mentions-legales`               | `GET`       | `Front/MainController`  | `legals`     | Mentions légales     | legals mentions    | -       |
| `/conditions-generales`           | `GET`       | `Front/MainController`  | `conditions` | Conditions générales | general conditions | -       |
| `/contact`                        | `GET`       | `Front/MainController`  | `contact`    | Nous contacter       | contact            | -       |
| `/regles-du-jeu`                  | `GET`       | `Front/MainController`  | `rules`      | Règles du jeu        | rules of the game  | -       |

## Back-office

| URL                     | HTTP Method   | Controller             | Method   | Title                                        | Content       | Comment                                            |
| ----------------------- | ------------- | ---------------------- | -------- | -------------------------------------------- | ------------- | -------------------------------------------------- |
| `back/`                 | `GET`         | `Back/MainController`  | `home`   | Accueil                                      | story list    | -                                                  |
| `back/deconnexion`      | `POST`        | `Back/LoginController` | `logout` | -                                            | logout page   | A préciser sur le lien back/front si projet séparé |
| `back/user`             | `GET`         | `Back/UserController`  | `list`   | Liste des utilisateurs                       | user list     | -                                                  |
| `back/user/add`         | `POST`        | `Back/UserController`  | `add`    | Ajouter un utilisateur                       | add a user    | -                                                  |
| `back/user/[id]`        | `GET`         | `Back/UserController`  | `show`   | [nom de l'utilisateur]                       | user page     | -                                                  |
| `back/user/[id]/edit`   | `PUT` `PATCH` | `Back/UserController`  | `edit`   | Editer un utilisateur [nom de l'utilisateur] | edit a user   | -                                                  |
| `back/user/[id]/delete` | `DELETE`      | `Back/UserController`  | `delete` | -                                            | delete a user | -                                                  | - |

