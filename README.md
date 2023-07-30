# Laravel Book CRUD API

A simple CRUD application for a user to manage his books.

## Config

After cloning the repository, run this to install dependencies

```bash
composer install
```

Generate a jwt secret and a application key

```bash
php artisan key:generate
php artisan jwt:secret
```

Then seed the database

```bash
php artisan migrate
php artisan bd:seed
```

Now you can launch the API

```bash
php artisan serve
```
