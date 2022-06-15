# Test Symfony Messenger

Project from Grafikart Symfony Messenger tutorial

## Documentation

[Tutorial from Grafikart](https://grafikart.fr/tutoriels/symfony-messenger-async-1367)

## Requirements

* PHP>=8.0
* Mysql db
* Composer
* NodeJS
* Symfony CLI
* [Mailtrap.io](https://mailtrap.io/) account

## Installation

First, configure your mailtrap account into .env file (MAILER_DSN) and your database connection (DATABASE_URL)

```bash
# install packages and dependencies
composer install
npm install
npm run dev

# run servers & workers
symfony server:start -d
symfony run -d symfony console messenger:consume async -vv
```