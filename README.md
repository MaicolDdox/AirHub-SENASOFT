#  Air Hub

**Air Hub** es una aplicación web desarrollada en **Laravel** que permite buscar, reservar y comprar boletos de vuelo de manera rápida y sencilla.  
El proyecto incluye autenticación de usuarios, gestión de asientos y administración mediante roles y permisos.

---

##  Requisitos previos

Antes de ejecutar el proyecto, asegúrate de tener instaladas las siguientes dependencias:

- [Composer](https://getcomposer.org/)
- [Node.js y NPM](https://nodejs.org/)
- [Laravel](https://laravel.com/)
- [Laravel Permission](https://spatie.be/docs/laravel-permission)

---

##  Instalación

Sigue los pasos a continuación para configurar el entorno de desarrollo:

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/flyhub.git
cd flyhub
```
2. Instalar dependencias de PHP y Node
bash
Copiar código
````bash
composer install
npm install
````
3. Configurar el archivo .env
Copia el archivo de ejemplo y edítalo según tu entorno:


Copiar código
````bash
cp .env.example .env
````
Luego, modifica las variables de conexión a base de datos y otras configuraciones según corresponda:

env
Copiar código
```bash
APP_NAME=FlyHub
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flyhub
DB_USERNAME=root
DB_PASSWORD=
````
Finalmente, genera la clave de aplicación:

bash
Copiar código
```bash
php artisan key:generate
```
 Migraciones y Seeders
Ejecuta las migraciones y seeders para crear las tablas y poblar los datos iniciales:


Copiar código
````
php artisan migrate --seed
````
Esto creará las tablas necesarias y cargará los roles, permisos y usuarios base del sistema.

 Ejecución del proyecto
Para iniciar el entorno de desarrollo, ejecuta los siguientes comandos en dos terminales separadas:

Terminal 1 – Servidor de Laravel

Copiar código

````
php artisan serve
````
Terminal 2 – Compilación de assets

bash
Copiar código
````
npm run dev
````
En algunos entornos también puedes usar:

Copiar código
````
composer run dev
````
✅ Listo
Abre tu navegador y visita:

👉 http://localhost:8000

Tu aplicación Fly Hub debería estar ejecutándose correctamente.

     Dependencias principales
Laravel 10+

Laravel Permission (Spatie)

Tailwind (según el entorno configurado)

Vite + NPM

