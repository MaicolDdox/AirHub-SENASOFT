<div align="center">
  <!-- TODO: agregar logo -->
  <img src="" alt="AirHub logo" width="140" height="140" />
  <h1>AirHub</h1>
  <p>Plataforma de gestion y compra de vuelos desarrollada para la competencia SenaSoft.</p>
</div>

---

## Descripcion
AirHub es una aplicacion web para administrar vuelos y permitir reservas de forma clara y segura. Incluye un panel de administracion para gestionar rutas, modelos, aerolineas y disponibilidad, junto con la experiencia del usuario final para consultar y comprar vuelos.

## Caracteristicas principales
**Usuario**
- Busqueda y visualizacion de vuelos disponibles.
- Reservas con flujo guiado y generacion de tickets.
- Acceso a historial de reservas y soporte.

**Administrador**
- Panel admin con dashboard de indicadores.
- Gestion de vuelos (listado, estados, disponibilidad).
- Creacion y administracion de rutas, modelos y aerolineas.

## Tecnologias
- Laravel 12
- Livewire + Volt
- TailwindCSS
- Flux (starter kit)
- ApexCharts
- Vite

## Requisitos
- PHP 8.2+
- Composer
- Node.js 18+
- Base de datos (MySQL o SQLite)

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
- URL: `http://127.0.0.1:8000/dashboard`
- Email: `admin@gmail.com`
- Password: `admin123456`

## Autores
- MaicolDdox
- deujeanx
