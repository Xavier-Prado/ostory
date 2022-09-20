# Routes

## Front-office

| URL                                  | HTTP Method | Controller              | Method       | Title                | Content            | Comment |
| ------------------------------------ | ----------- | ----------------------- | ------------ | -------------------- | ------------------ | ------- |
| `/`                                  | `GET`       | `Front/MainController`  | `home`       | Accueil              | homepage           | -       |
| `/connexion`                         | `GET`       | `Front/LoginController` | `login`      | Connexion            | login page         | -       |
| `/inscription`                       | `GET`       | `Front/LoginController` | `signin`     | Inscription          | sign-in page       | -       |
| `/deconnexion`                       | `GET`       | `Front/LoginController` | `logout`     | -                    | logout page        | -       |
| `/user/[id]`                         | `GET`       | `Front/UserController`  | `show`       | -                    | Show user page     | -       |
| `/user/[id]/edit`                    | `GET`       | `Front/UserController`  | `edit`       | -                    | Edit user page     | -       |
| `/histoire`                          | `GET`       | `Front/StoryController` | `list`       | Les histoires        | story list         | -       |
| `/histoire/[slug]/[id]/[page:id]`    | `GET`       | `Front/StoryController` | `play`       | [Nom de l'histoire]  | story page game    | -       |
| `/credits`                           | `GET`       | `Front/MainController`  | `credits`    | Page des crédits     | links              | -       |
| `/mentions-legales`                  | `GET`       | `Front/MainController`  | `legals`     | Mentions légales     | legals mentions    | -       |
| `/conditions-generales`              | `GET`       | `Front/MainController`  | `conditions` | Conditions générales | general conditions | -       |
| `/contact`                           | `GET`       | `Front/MainController`  | `contact`    | Nous contacter       | contact            | -       |
| `/regles-du-jeu`                     | `GET`       | `Front/MainController`  | `rules`      | Règles du jeu        | rules of the game  | -       |

## Endpoint (API)

| URL                               | HTTP Method   | Controller            | Method   | Title       | Content            | Comment |
| --------------------------------- | ------------- | --------------------- | -------- | ----------- | ------------------ | ------- |
| `/api/connexion`                  | `POST`        | `Api/LoginController` | `login`  | login       | API connexion      | -       |
| `/api/inscription`                | `POST`        | `Api/LoginController` | `signin` | Inscription | sign-in page       | -       |
| `/api/histoire`                   | `GET`         | `Api/StoryController` | `list`   | -           | API story list     | -       |
| `/api/histoire/[id]/[page:id]`    | `GET`         | `Api/StoryController` | `page`   | -           | API story page     | -       |
| `/api/user/[id]`                  | `GET`         | `Api/UserController`  | `show`   | -           | API user           | -       |
| `/api/user/add`                   | `POST`        | `Api/UserController`  | `add`    | -           | API user add       | -       |
| `/api/user/[id]/edit`             | `PUT` `PATCH` | `Api/UserController`  | `edit`   | -           | API user edit      | -       |
| `/api/user/[id]/delete`           | `DELETE`      | `Api/UserController`  | `delete` | -           | API user delete    | -       |


## Back-office

| URL                   | HTTP Method | Controller            | Method | Title                                        | Content     | Comment |
| --------------------- | ----------- | --------------------- | ------ | -------------------------------------------- | ----------- | ------- |
| `back/`               | `GET`       | `Back/MainController` | `home` | Accueil                                      | story list  | -       |
| `back/user`           | `GET`       | `Back/UserController` | `list` | Liste des utilisateurs                       | user list   | -       |
| `back/user/add`       | `GET`       | `Back/UserController` | `add`  | Ajouter un utilisateur                       | add a user  | -       |
| `back/user/[id]`      | `GET`       | `Back/UserController` | `show` | [nom de l'utilisateur]                       | user page   | -       |
| `back/user/[id]/edit` | `GET`       | `Back/UserController` | `edit` | Editer un utilisateur [nom de l'utilisateur] | edit a user | -       |


