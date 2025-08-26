# Stockify Starter (Laravel + Flowbite)

## Langkah Setup
1. Buat project Laravel 10 baru (mis: `laravel new stockify` atau `composer create-project laravel/laravel stockify`).
2. Copy isi zip ini ke root project, **replace** file yang sama.
3. Install Breeze & frontend:
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install
   npm install
   npm install flowbite
   npm install -D tailwindcss postcss autoprefixer
   ```
4. Build assets:
   ```bash
   npm run dev
   ```
5. Migrasi & seeder:
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminSeeder
   ```
6. Login: **admin@example.com / password**

## Tambahan
- Pastikan di `app/Http/Kernel.php` tambahkan route middleware:
  ```php
  protected $routeMiddleware = [
      // ...
      'admin' => \App\Http\Middleware\AdminMiddleware::class,
  ];
  ```

- Storage link untuk upload gambar:
  ```bash
  php artisan storage:link
  ```
