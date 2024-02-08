
# Test Penjualan V-Kool

Aplikasi Penjualan Sederhana, Build With Laravel 10, Livewire 3, MySQL, Bootstrap 5

## Requirements

- PHP 8.1
- MySQL

## Table of Contents

- [Test Penjualan V-Kool](#test-penjualan-v-kool)
  - [Requirements](#requirements)
  - [Table of Contents](#table-of-contents)
  - [Installation](#installation)
  - [Setting up](#setting-up)
    - [1. Install Composer Dependencies](#1-install-composer-dependencies)
    - [2. Setup .env](#2-setup-env)
      - [Example](#example)
    - [Database Configuration](#database-configuration)
    - [3. Generate an application key](#3-generate-an-application-key)
    - [4. Import the database](#4-import-the-database)
  - [Deployment](#deployment)
  - [Login](#login)
  - [Authors](#authors)

## Installation

Clone the repository

```bash
 git clone https://github.com/mocfaisal/test_vkool.git
```

Go to the repository directory

```bash
cd /test_vkool
```

## Setting up

### 1. Install Composer Dependencies

```bash
composer install
```

### 2. Setup .env

- Duplicate the `.env.example` file and rename it to `.env`
- Open the `.env` file and set your database connection details.

#### Example

```bash
APP_URL=http://127.0.0.1:your_port
```

to

```bash
APP_URL=http://127.0.0.1:8000
```

### Database Configuration

```bash
# MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tes_vkool
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Generate an application key

```bash
php artisan key:generate
```

### 4. Import the database

import file `tes_vkool.sql` to your database

## Deployment

Start the Development Server

```bash
  php artisan serve
```

## Login

```bash
Username : admin
Password : admin
```

## Authors

- [@mocfaisal](https://github.com/mocfaisal/)
