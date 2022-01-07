## Requirements

You need to have symfony, npm and a WAMP/MAMP/XAMP environnement.

## Before launching

Start your mamp/wamp.
Install all dependencies with

    npm install

Copy .env to .env.local

Change the username, password and database name in this line :

     DATABASE_URL="mysql://root:@127.0.0.1:3306/api-test?serverVersion=5.7"



Create and make migration

    php bin/console make:migration

    php bin/console doctrine:migrations:migrate



## Launch project



    symfony serve

    localhost:8000/api


## Get token

Create directory for token

    mkdir config/jwt

Use openssl to generate private key

     openssl genrsa -out config/jwt/private.pem -aes256 4096

Enter a passphrase of your choice.

Then create public key.

    openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

Change JWT_PASSPHRASE variable to your passphrase in env.local


Use Thunder or any https client. And create a POST request to login:

    POST // http://localhost:8000/api/login

In body, send json content

    {
    "login": "login",
    "password": "password"
    }

In response, you get the token.

In API swagger UI (localhost:8000/api/), click on button Authorize.

In value, write:

    Bearer YOUR-TOKEN-HERE

Now you're authentified with a token.


## URI pattern

When you POST an experience, in user value, send:

    "api/users/{id}"

