# Structure Microservice

## DO NOT PUSH HERE

If you want to create a PHP Microservice just clone the repo and create new one for your development.

### Slim Framework 4

Use this skeleton application to quickly setup and start working on a service for App Menita. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger, Illuminate Database and Firebase Php Jwt.

## Install the Application

To install the dependencies from composer, you can run this command
```bash
composer require
```

## Run the Application

To run the application in development, you can run this commands 

```bash
composer start
```

Or you can use `docker` to build the image and run the container, so you can run these commands:
```bash
docker build . -f .\docker\local\Dockerfile -t php-microservice-structure
docker run -d -p 8001:80 php-microservice-structure --name php-microservice-structure
```
After that, open `http://localhost:8080` in your browser.

# Dependencies

- [ORM illuminate/database](https://packagist.org/packages/illuminate/database)
- [JWT firebase/php-jwt](https://packagist.org/packages/firebase/php-jwt)
- [ENV vlucas/phpdotenv](https://packagist.org/packages/vlucas/phpdotenv)

## Stay in touch

- [Eloir Corona](https://eloircorona.com)