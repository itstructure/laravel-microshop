# Laravel microshop application 

## Introduction

A simple internet shop.

**Based on Laravel 7**

## Requirements

- php >= 7.2.5
- composer

## Installation

1. Clone project.

    `SSH SOURCE: git@github.com:itstructure/laravel-microshop.git`
    
    `HTTPS SOURCE: https://github.com/itstructure/laravel-microshop.git`
    
2. Install dependencies by running from the project root `composer install`

3. Copy and rename file `.env.example` to `.env`.

4. Generate `APP_KEY` in `.env` file, run: `php artisan key:generate`

5. Set a database connect options in `.env` file.

6. Run migrations: `php artisan migrate`

7. Run seeders: `php artisan db:seed`

## Usage

To go to the admin panel, register in a system and log-in.

There is no a role control (without RBAC).

You can:

- Manage product categories.
- Manage products.
- See new orders.