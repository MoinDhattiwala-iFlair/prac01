# Laravel Contacts CRUD with XML Import

A simple Laravel application to manage contacts (CRUD) with the ability to bulk import contacts from an XML file stored on the server.

## ✨ Features

- List, create, update, and delete contacts
- Import contacts from an XML file in the backend
- Clean UI using Tailwind CSS
- Built with Laravel 12+

---

## 🛠 Requirements

- PHP 8.2+
- Composer
- MySQL or PostgreSQL
- Node.js and npm (for asset build)
- Laravel 12

---

## 🚀 Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/MoinDhattiwala-iFlair/prac01.git contacts-crud
cd contacts-crud

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm ci
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
composer run dev
```

You're ready to go! Url in your browser, and login with:

- **Username:** text@example.com
- **Password:** password
