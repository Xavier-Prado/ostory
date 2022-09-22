## Utilisateur (`user`)

| Champ      | Type         | Spécificités                                    | Description                                         |
| ---------- | ------------ | ----------------------------------------------- | --------------------------------------------------- |
| id         | INT          | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'utilisteur                       |
| nickname   | VARCHAR(50)  | NOT NULL, UNIQUE                                | Le pseudo de l'utilisateur                          |
| email      | VARCHAR(255) | NOT NULL, UNIQUE                                | Email de l'utilisateur                              |
| password   | VARCHAR(255) | NOT NULL                                        | Mot de passe de l'utilisateur                       |
| role       | VARCHAR(50)  | NOT NULL                                        | Le rôle de l'utilisateur                            |
| created_at | TIMESTAMP    | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'utilisateur                |
| updated_at | TIMESTAMP    | NULL                                            | La date de la dernière mise à jour de l'utilisateur |

## Table d'association utilisateur et histoire (`user_story`)

| Champ    | Type      | Spécificités                    | Description                                      |
| -------- | --------- | ------------------------------- | ------------------------------------------------ |
| story    | ENTITY    | PRIMARY KEY, UNSIGNED, NOT NULL | L'identifiant de l'histoire                      |
| user     | ENTITY    | PRIMARY KEY, UNSIGNED, NOT NULL | L'identifiant de l'utilisateur                   |
| start_at | TIMESTAMP | NULL                            | La date de début de l'histoire par l'utilisateur |

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


## Page (`page`)

| Champ      | Type          | Spécificités                                    | Description                                                                       |
| ---------- | ------------- | ----------------------------------------------- | --------------------------------------------------------------------------------- |
| id         | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de la page                                                          |
| title      | VARCHAR(128)  | NOT NULL                                        | Le nom de la page                                                                 |
| image      | VARCHAR(2083) | NOT NULL                                        | L'url de l'image de la page                                                       |
| content    | LONGTEXT      | NOT NULL                                        | Le contenu de la page                                                             |
| start      | INT           | NOT NULL                                        | Page de début de l'histoire                                                       |
| page_end   | ENUM          | NOT NULL                                        | Type de fin de l'histoire  [0 : histoire continue, 1: fin victoire, 2: fin perte] |
| created_at | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de la page                                                    |
| updated_at | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de la page                                     |
| story      | ENTITY        | NOT NULL                                        | L'histoire liée à la page                                                         |

## Choix (`choice`)

| Champ       | Type        | Spécificités                                    | Description                        |
| ----------- | ----------- | ----------------------------------------------- | ---------------------------------- |
| id          | INT         | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant du choix             |
| name        | VARCHAR(50) | NOT NULL                                        | Le nom du choix                    |
| page_id     | INT         | NOT NULL                                        | Page vers laquelle renvoi le choix |
| description | LONGTEXT    | NOT NULL                                        | Description du choix               |
| page        | ENTITY      | NOT NULL                                        | La page liée au choix              |