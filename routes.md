# Routes

## Front-office

| URL                 | HTTP Method   | Controller | Method | Title                | Content            | Comment |
| ------------------- | ------------- | ---------- | ------ | -------------------- | ------------------ | ------- |
| `/`                 | `GET`         | -          | -      | Accueil              | homepage           | -       |
| `/connexion`        | `GET`         | -          | -      | Connexion            | login page         | -       |
| `/inscription`      | `POST`        | -          | -      | Inscription          | register page      | -       |
| `/mon-compte`       | `GET`         | -          | -      | -                    | Show user page     | -       |
| `/mon-compte/edit`  | `PUT / PATCH` | -          | -      | -                    | Edit user page     | -       |
| `/histoires`        | `GET`         | -          | -      | Les histoires        | story list         | -       |
| `/histoire`         | `GET`         | -          | -      | -                    | story page game    | -       |
| `/credits`          | -             | -          | -      | Page des crédits     | links              | -       |
| `/mentions-legales` | -             | -          | -      | Mentions légales     | legals mentions    | -       |
| `/cgu`              | -             | -          | -      | Conditions générales | general conditions | -       |
| `/nous-contacter`   | `POST`        | -          | -      | Nous contacter       | contact            | -       |
| `/regles-du-jeu`    | -             | -          | -      | Règles du jeu        | rules of the game  | -       |

## Endpoint (API)

| URL                          | HTTP Method   | Controller            | Method     | Title       | Content         | Comment |
| ---------------------------- | ------------- | --------------------- | ---------- | ----------- | --------------- | ------- |
| `/api/login`                 | `POST`        | `Api/LoginController` | `login`    | login       | API connexion   | -       |
| `/api/register`              | `POST`        | `Api/LoginController` | `register` | Inscription | API register    | -       |
| `/api/histoire`              | `GET`         | `Api/StoryController` | `list`     | -           | API story list  | -       |
| `/api/histoire/[id]/page/id` | `GET`         | `Api/StoryController` | `page`     | -           | API story page  | -       |
| `/api/user/me`               | `GET`         | `Api/UserController`  | `show`     | -           | API user        | -       |
| `/api/user/me/edit`          | `PUT` `PATCH` | `Api/UserController`  | `edit`     | -           | API user edit   | -       |
| `/api/user/me/delete`        | `DELETE`      | `Api/UserController`  | `delete`   | -           | API user delete | -       |


## Back-office

| URL                     | HTTP Method  | Controller         | Method  | Title                                        | Content       | Comment |
| ----------------------- | ------------ | ------------------ | ------- | -------------------------------------------- | ------------- | ------- |
| `back/`                 | `GET`        | `HomeController`   | `home`  | Accueil                                      | story list    | -       |
| `back/user`             | `GET`        | `UserController`   | `index` | Liste des utilisateurs                       | user list     | -       |
| `back/user/new`         | `POST`       | `UserController`   | `add`   | Ajouter un utilisateur                       | add a user    | -       |
| `back/user/[id]`        | `GET`        | `UserController`   | `show`  | [nom de l'utilisateur]                       | user infos    | -       |
| `back/user/[id]/edit`   | `PUT, PATCH` | `UserController`   | `edit`  | Editer un utilisateur [nom de l'utilisateur] | edit a user   | -       |
| `back/story`            | `GET`        | `StoryController`  | `index` | Liste des histoires                          | story list    | -       |
| `back/story/new`        | `POST`       | `StoryController`  | `new`   | Ajouter une histoire                         | add a story   | -       |
| `back/story/[id]`       | `GET`        | `StoryController`  | `show`  | [nom de l'histoire]                          | story infos   | -       |
| `back/story/[id]/edit`  | `PUT, PATCH` | `StoryController`  | `edit`  | Editer une histoire [nom de l'utilisateur]   | edit a story  | -       |
| `back/page`             | `GET`        | `PageController`   | `index` | Liste des pages                              | page list     | -       |
| `back/page/new`         | `POST`       | `PageController`   | `new`   | Ajouter une page                             | add a page    | -       |
| `back/page/[id]`        | `GET`        | `PageController`   | `show`  | [nom de la page]                             | page infos    | -       |
| `back/page/[id]/edit`   | `PUT, PATCH` | `PageController`   | `edit`  | Editer une page [nom de la page]             | edit a page   | -       |
| `back/choice`           | `GET`        | `ChoiceController` | `index` | Liste des choix                              | choice list   | -       |
| `back/choice/new`       | `POST`       | `ChoiceController` | `new`   | Ajouter un choix                             | add a choice  | -       |
| `back/choice/[id]`      | `GET`        | `ChoiceController` | `show`  | [nom du choix]                               | choice  infos | -       |
| `back/choice/[id]/edit` | `PUT, PATCH` | `ChoiceController` | `edit`  | Editer un choix [nom du choix]               | edit a choice | -       |

