# Stockify (Fixed)

## Akun Login (Seeder)
- **Admin**: admin@stockify.test / password
- **Manager**: manager@stockify.test / password
- **Staff**: staff@stockify.test / password

## Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
# Atur koneksi DB di .env
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Catatan
- Middleware role ditambahkan sebagai alias `role`.
- Route baru ditambahkan (lihat `routes/web.php` bagian `// --- Stockify additions ---`). 
- UI sederhana menggunakan Tailwind + Flowbite via CDN.
- Service & Repository pattern telah ditambahkan minimal untuk Produk dan Stok.
