# VnxeBlog

An open-source Vnxe Blog web application using Laravel and Vue.

### Tech Stack

- [Vue](https://vuejs.org/)
- [Laravel 7](https://laravel.com/docs/7.x)
- [MySQL](https://www.mysql.com/)

### Features

- Login
- Register
- CRUD of Categories with Image Upload
- CRUD of Posts with Image Upload
- Display all Users
- Update User's Profile
- Update User's Account

### Preview

<p align="center"><img src="https://github.com/Vincexx/VnxeBlog/blob/master/public/img/Dashboard.PNG" width="100%"></p>

<p align="center"><img src="https://github.com/Vincexx/VnxeBlog/blob/master/public/img/profile.PNG" width="100%"></p>

<p align="center"><img src="https://github.com/Vincexx/VnxeBlog/blob/master/public/img/Users.PNG" width="100%"></p>

<p align="center"><img src="https://github.com/Vincexx/VnxeBlog/blob/master/public/img/Categories.PNG" width="100%"></p>

<p align="center"><img src="https://github.com/Vincexx/VnxeBlog/blob/master/public/img/Posts.PNG" width="100%"></p>

<p align="center"><img src="https://github.com/Vincexx/VnxeBlog/blob/master/public/img/account.PNG" width="100%"></p>

### Installation

### Dependencies

- Node.js (comes with a bundles npm)
- Yarn (if you prefer not to use npm)
- Composer
- Git
- Docker (Optional)
- PHP 7.2.5 and up

## Build Setup

Create .env file from .env.example and update the variables to your configurations

```bash
# install dependencies
$ composer install
$ npm install

# generate application key
$ php artisan key:generate

# serve at localhost:8000
$ php artisan serve
```