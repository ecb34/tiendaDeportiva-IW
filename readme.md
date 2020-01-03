# Tienda Deportiva

## Instalacion proyecto laravel:

### Requisitos:
* Composer
* NPM
* Laravel 6.5
* PHP
* Mysql

### Pasos
1. Clonar el repositorio de github y acceder a la carpeta del proyecto.
2. Ejecutar composer install/composer update para instalar las dependencias del proyecto laravel.
3. Duplicar archivo .env.example y renombrarlo a .env.
4. Ejecutar php artisan key:generate. 
5. Añadir a .env las credenciales de la base de datos.
6. Ejecutar php artisan migrate:refresh --seed para migrar y rellenar la base de datos con datos de prueba.
7. Ejecutar php artisan passport:install.
8. Ejecutar php artisan passport:keys.
9. Ejecutar npm install.
10. Ejecutar npm run watch-poll.
11. Ejecutar php artisan serve para ponerlo en marcha en localhost:8000 en una terminal diferente.

#Errores
1. Ejecutar composer dump-autoload y seguido punto 6 de arriba
