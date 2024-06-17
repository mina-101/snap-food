<p align="center"><a href="https://laravel.com" target="_blank"><img 
src="storage/app/public/logo/snappfood.png" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Snapp Food

Snapp food project is a web application which designs and implements a simple delivery system. There are plenty of entities such as Vendor, Agent, Order, Trip, etc. 

## Installation

- make sure you have git and docker installed
- git clone project from [https://github.com/mina-101/snapp-food.git]
- go to project directory:
    ```bash
  cd snapp-food/
  ```
- execute this command to build and run project: 
    ```bash
  docker-compose up -d
  ```
- go to project container:
  ```bash
  docker exec -it snapp-food-laravel.test-1 bash
    ```
- install composer 
  ```bash
  composer install
    ```
- to create tables run:
   ```bash
   php artisan migrate
   ```

## Run Tests

  - ```bash
    docker exec -it snapp-food-laravel.test-1 bash
    ```
  - ```bash
    php artisan test
    ```
       
    
## Api Documentation

- see route /docs/api#/ on your host for api docs
