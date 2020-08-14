<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Project

This is a demo Application Programming Interface (API) build on laravel as the logo rightly suggest 😀 
This api does basic CRUD Operations in an elegant way and smart way.

With Key principle concepts such as SOLID, DRY.

## Setup

- Install [Composer](https://getcomposer.org)

- Install any server of your choice. I prefer [Mamp](https://downloads.mamp.info/MAMP-PRO/releases/5.7/MAMP_MAMP_PRO_5.7.pkg). If you use windows you can also checkout [xampp](https://www.apachefriends.org/xampp-files/7.4.8/xampp-windows-x64-7.4.8-0-VC15-installer.exe)

- Clone Repository

```bash
    git clone https://github.com/adedayojs/demo-book-api
```
- Navigate to project
```bash
    cd demo-book-api
```
- Create your own .env file

```bash
   cp .env.example .env
```

- Update the following on your .env file to reflect your local server config

```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=8889
    DB_DATABASE=booksdb
    DB_USERNAME=admin
    DB_PASSWORD=
```
- Start the application 

```bash
   php artisan serve
```

## Note

The following endpoint has been made available for consumption 😋😋

```js
    
    GET     api/v1/book

    POST    api/v1/book

    PATCH   api/v1/book/:id

    GET     api/external-book

    DELETE  api/v1/book/:id
```

## Testing
**Update:** To run your test run the command

```bash
        php artisan test
```
