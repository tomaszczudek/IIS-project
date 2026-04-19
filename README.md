# IIS Project

A school web application project built with the Laravel framework.

## Description
This repository contains a PHP web application developed as part of the IIS course.  
The project is based on Laravel and includes the standard application structure, routing, database layer, views, and public assets.

## Technologies
- PHP 8.2+
- Laravel 12
- Blade templates
- Vite / npm

## Setup
Install dependencies and prepare the project:

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build

## Run
Start the development server with:

php artisan serve

## Authors
Project created as part of the IIS course.
