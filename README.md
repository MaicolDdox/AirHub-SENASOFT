
<p align="center">
    <a href="https://github.com/MaicolDdox/AirHub-SENASOFT/tree/main"_blank>
      <img src="docs/assets/logoTipo.png" width="260" alt="Logo de CrediSeal API">
    </a>
</p>

[![GitHub](https://img.shields.io/badge/GitHub-MaicolDdox-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/MaicolDdox)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/maicol-duvan-gasca-rodas-4483923a4/?trk=public-profile-join-page)
[![Instagram](https://img.shields.io/badge/Instagram-@maicolddox__-E4405F?style=for-the-badge&logo=instagram&logoColor=white)](https://www.instagram.com/maicolddox_?utm_source=qr&igsh=cTV6enRlMW05bjY3)
[![Discord](https://img.shields.io/badge/Discord-5865F2?style=for-the-badge&logo=discord&logoColor=white)](https://discordapp.com/users/1425631850453270543)
[![Facebook](https://img.shields.io/badge/Facebook-1877F2?style=for-the-badge&logo=facebook&logoColor=white)](https://www.facebook.com/profile.php?id=61586710675179&sk=about_contact_and_basic_info)

<div align="center">
  <h1>AirHub</h1>
  <p>Plataforma de gestion y compra de vuelos desarrollada para la competencia SenaSoft.</p>
</div>

---

## Descripcion

AirHub es una aplicacion web para administrar vuelos y permitir reservas de forma clara y segura. Incluye un panel de administracion para gestionar rutas, modelos, aerolineas y disponibilidad, junto con la experiencia del usuario final para consultar y comprar vuelos.

## Caracteristicas principales

**Usuario**

-   Busqueda y visualizacion de vuelos disponibles.
-   Reservas con flujo guiado y generacion de tickets.
-   Acceso a historial de reservas y soporte.

**Administrador**

-   Panel admin con dashboard de indicadores.
-   Gestion de vuelos (listado, estados, disponibilidad).
-   Creacion y administracion de rutas, modelos y aerolineas.

## Tecnologias

-   Laravel 12
-   Livewire + Volt
-   TailwindCSS
-   Flux (starter kit)
-   ApexCharts
-   Vite

## Requisitos

-   PHP 8.2+
-   Composer
-   Node.js 18+
-   Base de datos (MySQL o SQLite)

## Instalacion

```bash
composer install
npm install
```

## Configuracion

```bash
cp .env.example .env
php artisan key:generate
```

Configura las variables de entorno necesarias en `.env`, especialmente las relacionadas con la base de datos.

## Ejecutar migraciones + seeders

Demo con datos cargados:

```bash
php artisan migrate --seed
```

O ejecuta por separado:

```bash
php artisan migrate
php artisan db:seed
```

## Credenciales demo (panel administrador)

-   URL: `http://127.0.0.1:8000/dashboard`
-   Email: `admin@gmail.com`
-   Password: `admin123456`

## Autores

-   MaicolDdox
-   deujeanx
