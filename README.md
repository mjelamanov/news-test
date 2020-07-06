# The laravel boilerplate

## Requirements

* PHP 7.3 or above
* Laravel 7 or above
* Any relational db supported by laravel
* Node.js 8 or above

## Installation

```bash
git clone git@github.com:mjelamanov/laravel-boilerplate.git
```

Copy .env file

```bash
cp .env.example .env
```

Set your DB connection in copied .env file above

```
DB_CONNECTION=mysql
```

Install dependencies

``` bash
composer install && npm i
```

Set application key

``` bash
php artisan key:generate
```

Migrate and seeding DB

``` bash
php artisan migrate --seed
```

Run built-in server

``` bash
php artisan serve --host=localhost --port=8000
```

Done! Open the application at http://localhost:8000

## Docker

Using docker-compose

```bash
git clone git@github.com:mjelamanov/laravel-boilerplate.git
```

```bash
cd laravel-boilerplate
```

``` bash
docker-compose up -d
```

If you build at first time, or you want to rebuild it you need to set the environment variables before

``` bash
DOCKER_USER_ID=$(id -u)
DOCKER_GROUP_ID=$(id -g)
```

Then run the command

``` bash
docker-compose up -d --build
```

Done! Open the application at http://localhost:8080

## Tests

Run via console

```bash
php vendor/bin/phpunit
```

Run via docker

```bash
docker-compose exec app php vendor/bin/phpunit
```
