# BookShare

Web-based application to record book borrowing history

## Features

-   There are 2 types of users: admin and tenant
-   Renters can register on the registration page
-   The tenant account must be approved by admin to become active
-   Can search for books via title or category
-   Admin can add book data and book categories
-   Books can have many categories
-   Admin can see the books that are being borrowed

## Technology Stack

-   Laravel 10
-   MySql

## Installation

To use using BookShare you need to clone the repository first, you can use the command below on the terminal

```sh
git clone https://github.com/rochmadqolim/book-share.git
```

Switch to the directory you just cloned, and run the composer install command:

```sh
cd book-share
composer install
```

### Setup .env file and Database

-   Create your database
-   Setup .ENV Database configuration if using Postgres

    ```sh
    # Config to database
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=book_share
    DB_USERNAME=root
    DB_PASSWORD=
    ```

After setting the database settings and want to create the base tables do the following command in the terminal:

```sh
php artisan migrate
php artisan db:seed
```

## Running App

After the database setup is complete, then run the Apache and MySQL server with XAMPP or Laragon.

Finally, to run the Laravel development server, use the command:

```sh
php artisan serve
```

Point and run the server at the address to `http://127.0.0.1:8000/login` to log in
