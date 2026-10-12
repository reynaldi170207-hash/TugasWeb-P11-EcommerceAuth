# E-Commerce Auth

Laravel 11+ dengan Breeze (Blade), Eloquent, multi-role, dan Filament + Shield.

## Instalasi

    composer create-project laravel/laravel ecommerce-auth
    cd ecommerce-auth
    composer require laravel/breeze --dev
    php artisan breeze:install blade

Salin seluruh isi folder ini ke root proyek (timpa file yang ada), lalu:

    echo "APP_FAKER_LOCALE=id_ID" >> .env
    php artisan migrate:fresh --seed
    npm install
    npm run dev
    php artisan serve

## Akun Seeder

| Peran  | Email              | Password |
|--------|--------------------|----------|
| admin  | admin@gmail.com  | admin123 |
| editor | editor@example.com | password |
| user   | user@gmail.com   | user123 |

## Filament + Shield

    bash bonus-filament.sh

Panel tersedia di `/admin`. Halaman kelola kustom ada di `/manage`.
