
<p align="center">
    <a href="https://github.com/MaicolDdox/AirHub-SENASOFT/tree/main"_blank>
      <img src="docs/assets/logoTipo.png" width="260" alt="Logo de CrediSeal API">
    </a>
</p>

<p align="center">
  <a href="https://www.linkedin.com/in/maicol-duvan-gasca-rodas-4483923a4/?trk=public-profile-join-page" target="_blank" title="LinkedIn" style="text-decoration:none;">
    <img src="docs/assets/social/linkedin.png" height="22" alt="LinkedIn" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">LinkedIn</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://www.instagram.com/maicolddox_?utm_source=qr&igsh=cTV6enRlMW05bjY3" target="_blank" title="Instagram" style="text-decoration:none;">
    <img src="docs/assets/social/instagram.png" height="22" alt="Instagram" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">Instagram</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://github.com/MaicolDdox" target="_blank" title="GitHub" style="text-decoration:none;">
    <img src="docs/assets/social/github.png" height="22" alt="GitHub" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">GitHub</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://discordapp.com/users/1425631850453270543" target="_blank" title="Discord" style="text-decoration:none;">
    <img src="docs/assets/social/discord.png" height="22" alt="Discord" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">Discord</span>
  </a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="mailto:maicolindustriascode@gmail.com" target="_blank" title="Email" style="text-decoration:none;">
    <img src="docs/assets/social/gmail.png" height="22" alt="Email" style="vertical-align:middle;">
    <span style="margin-left:6px; vertical-align:middle;">Email</span>
  </a>
</p>

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
