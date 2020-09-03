# News test app

## Requirements

* PHP 7.4 or above
* Laravel 7 or above
* Any relational db supported by laravel
* Node.js 10 or above

## Installation

```bash
git clone git@github.com:mjelamanov/news-test.git
```

Copy .env file

```bash
cp .env.example .env
```

Set environment vars in .env

```
APP_URL=http://localhost:8080
DB_CONNECTION=mysql
DB_PASSWORD=yourpassword
# etc...
```

Install dependencies

``` bash
composer install && npm i
```

Set application key

``` bash
php artisan key:generate
```

Create storage link

``` bash
php artisan storage:link
```

Migrate and seeding DB

``` bash
php artisan migrate --seed
```

Build frontend scripts

``` bash
npm run dev
```

Run built-in server

``` bash
php artisan serve --host=localhost --port=8000
```

Done! Open the application at http://localhost:8000

## Docker

Using docker-compose

```bash
git clone git@github.com:mjelamanov/news-test.git
```

```bash
cd news-test
```

You may set any environment variables in .env

``` bash
APP_URL=http://localhost:8080
DB_HOST=db
DB_USERNAME=username
DB_PASSWORD=password
DOCKER_USER_ID=1000 # $(id -u)
DOCKER_GROUP_ID=1000 # $(id -g)
REDIS_HOST=redis
```

Then run the command

``` bash
docker-compose up -d
```

Inside the container:

* Install dependencies
* Generate an application key
* Generate a storage link
* Migrate and seed database
* Build frontend scripts

``` bash
docker-compose exec app sh
```

``` bash
composer install && php artisan key:generate && php artisan storage:link && php artisan migrate --seed && npm i && npm run dev
```

To login into admin pages `/admin/*`, select an user in the `users` table and log-in using password `123456`.

Done! Open the application at http://localhost:8080
