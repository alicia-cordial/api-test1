## Requirements

You need to have symfony, npm and a WAMP/MAMP/XAMP environnement.

## Before launching

Start your mamp/wamp.
Install all dependencies with

    npm install

Copy .env to .env.local

Change the username, password and database name in this line :

     DATABASE_URL="mysql://root:@127.0.0.1:3306/api-test?serverVersion=5.7"

Create JWT token and add passphrase.


Create and make migration

    php bin/console make:migration

    php bin/console doctrine:migrations:migrate





## Launch project



    symfony serve

    localhost:8000/api

