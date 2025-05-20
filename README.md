<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# programas a instalar para poder correr el sistema
- php 8.2
- composer
- mysql
- nodejs entre la version 20 o 22

# pasos de instalación

- 1 instalar las dependecias de la api laravel
```shell
composer install
```
- 2 instalar las dependecias del frontend
```shell
npm install
```
- 3 crear la base de datos en mysql
- 4 configurar el .env crear una copia del .env.example para usarlo en el archivo .env
- 5 procedemos a generar el key del proyecto para poder continuar
````shell
php artisan key:generate
````
- 6 en el .env se configurara las varaibles de entror del driver de conección de mysql de laravel
````env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=db_proyecto
DB_USERNAME=root
DB_PASSWORD=""
`````
- 7 ya teniendo nuestra configuración de conección de base de datos lista ejecutaremos las migraciones para poder crear las tablas en la base de dato configurada en el .env
````shell
php artisan migrate
````
- 8 ejecutaremos el comando seeder para poder tener el usurio root ya registrado en el sistema
````shell
php artisan db:seed --class="UserRootSeeder"
````
- 9 para poder en marcha el servidor de api laravel se usa el siguiente comando
````shell
php artisan serve
````
- 10 para poder en marcha el servidor de desarrollo del frontend se usa el siguiente comando
````shell
npm run dev
````
- 11 las credenciales para poder entrar al sistema son las siguientes
````shell
email=root@gmail.com
password=12345678
````
