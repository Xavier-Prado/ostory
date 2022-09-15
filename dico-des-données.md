## Histoire (`story`)

| Champ      | Type          | Spécificités                                    | Description                                    |
| ---------- | ------------- | ----------------------------------------------- | ---------------------------------------------- |
| id         | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'histoire                    |
| title      | VARCHAR(255)  | NOT NULL                                        | Le nom de l'histoire                           |
| content    | LONGTEXT      | NOT NULL                                        | Résumé de l'histoire                           |
| slug       | VARCHAR(255)  | NOT NULL                                        | Slug                                           |
| image      | VARCHAR(2083) | NOT NULL                                        | L'URL de l'image de l'histoire                 |
| status     | TINYINT(1)    | NOT NULL, DEFAULT 0                             | Le statut de l'histoire (1=dispo, 2=pas dispo) |
| created_at | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'histoire              |
| updated_at | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de l'image  |
| step       | entity        | NOT NULL                                        | Les étapes (autre entité) de l'histoire        |


## Action (`action`)

| Champ      | Type         | Spécificités                                    | Description                                    |
| ---------- | ------------ | ----------------------------------------------- | ---------------------------------------------- |
| id         | INT          | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'action                      |
| name       | VARCHAR(255) | NOT NULL                                        | Le nom de l'action                             |
| created_at | TIMESTAMP    | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'action                |
| updated_at | TIMESTAMP    | NULL                                            | La date de la dernière mise à jour de l'action |

## Personnage (`character`)

| Champ      | Type        | Spécificités                                    | Description                                      |
| ---------- | ----------- | ----------------------------------------------- | ------------------------------------------------ |
| id         | INT         | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant du personnage                      |
| name       | VARCHAR(50) | NOT NULL                                        | Le nom du personnage                             |
| image      | entity      | NULL                                            | Avatar de l'utilisateur                          |
| created_at | TIMESTAMP   | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création du personnage                |
| updated_at | TIMESTAMP   | NULL                                            | La date de la dernière mise à jour du personnage |


## Lieu (`location`)

| Champ       | Type          | Spécificités                                    | Description                                |
| ----------- | ------------- | ----------------------------------------------- | ------------------------------------------ |
| id          | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant du lieu                      |
| name        | VARCHAR(50)   | NOT NULL                                        | Le nom du lieu                             |
| description | LONGTEXT      | NOT NULL                                        | Description du lieu                        |
| image       | VARCHAR(2083) | NOT NULL                                        | L'url de l'image du lieu                   |
| created_at  | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création du lieu                |
| updated_at  | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour du lieu |

## utilisateurs (`users`)

| Champ      | Type          | Spécificités                                    | Description                                         |
| ---------- | ------------- | ----------------------------------------------- | --------------------------------------------------- |
| id         | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'utilisteur                       |
| nickname   | VARCHAR(50)   | NOT NULL                                        | Le pseudo de l'utilisateur                          |
| image      | VARCHAR(2083) | NULL                                            | L'url de l'image de l'utilisateur                   |
| email      | VARCHAR(255)  | NOT NULL                                        | Email de l'utilisateur                              |
| password   | VARCHAR(2083) | NOT NULL                                        | Mot de passe de l'utilisateur                       |
| role       | VARCHAR(50)   | NOT NULL                                        | Le rôle de l'utilisateur                            |
| created_at | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'utilisateur                |
| updated_at | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de l'utilisateur |
| image      | entity        | NULL                                            | Avatar de l'utilisateur                             |

## image (`image`)

| Champ      | Type          | Spécificités                                    | Description                                   |
| ---------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id         | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'image                      |
| name       | VARCHAR(50)   | NOT NULL                                        | Le nom de l'image                             |
| image      | VARCHAR(2083) | NOT NULL                                        | L'url de l'image                              |
| created_at | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'image                |
| updated_at | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de l'image |


## step (`step`)

| Champ      | Type          | Spécificités                                    | Description                                             |
| ---------- | ------------- | ----------------------------------------------- | ------------------------------------------------------- |
| id         | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'étape                                |
| title      | VARCHAR(128)  | NOT NULL                                        | Le nom de l'image                                       |
| content    | VARCHAR(2083) | NOT NULL                                        | L'url de l'image                                        |
| created_at | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'image                          |
| updated_at | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de l'image           |
| location   | entity        | NOT NULL                                        | Informations sur le lieu (info, images, etc) de l'étape |
| character  | entity        | NULL                                            | Les personnages (autre entité) liées à l'étape          |
| action     | entity        | NOT NULL                                        | Les actions (autre entité) liées à l'étape              |
| story      | entity        | NOT NULL                                        | Les histoires (autre entité) liées à l'étape            |
