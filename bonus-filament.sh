#!/usr/bin/env bash
set -e

composer require filament/filament
php artisan filament:install --panels

sed -i 's/^class User extends Authenticatable$/class User extends Authenticatable implements \\Filament\\Models\\Contracts\\FilamentUser/' app/Models/User.php

composer require bezhansalleh/filament-shield
php artisan shield:setup
php artisan shield:install admin

php artisan make:filament-resource Product --generate
php artisan make:filament-resource Category --generate
php artisan make:filament-resource Order --generate
php artisan shield:generate --all
