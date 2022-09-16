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
