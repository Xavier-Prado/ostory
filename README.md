# Welcome to O'Story Book

To run the project you need to (git clone obviously)

1- then you need to

```bash
    composer install
```

2- create .env.local (this file won't be commited)
    and add `DATABASE_URL="mysql://username:password@127.0.0.1:3306/BDDname?serverVersion=mariadb-10.3.25"`

3- When this is done, run the following command to create your DB
you should see 

```bash
    bin/console doctrine:database:create
```

4- Apply migrations

```bash
    bin/console doctrine:migrations:migrate
```

5- Run the fixtures

```bash
    bin/console doctrine:fixtures:load
```

6- Add keypair security to generate token

```bash
    bin/console lexik:jwt:generate-keypair
```

7- To run the php server 

```bash
    php -S 0.0.0.0:8000 -t public
```
