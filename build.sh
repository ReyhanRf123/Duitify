#!/usr/bin/env bash
# Exit jika ada error
set -o errexit

composer install --no-dev --optimize-autoloader
npm install
npm run build

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Menjalankan migrasi database ke Aiven
php artisan migrate --force