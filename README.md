<p align="center"><a href="https://laravel.com" target="_blank"><img 
src="storage/app/public/logo/snappfood.png" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Snap Food

Snap food project is a web application which designs and implements a simple delivery system. There are plenty of entities such as Vendor, Agent, Order, Trip, etc. 

## Installation

- make sure you have git and docker installed
- git clone project from [https://github.com/mina-101/snap-food.git]
- cd snap-food/
- run docker-compose up -d
- docker exec -it snap-food-laravel.test-1 bash
- php artisan migrate


## Run Tests

- docker exec -it snap-food-laravel.test-1 bash
- php artisan test

