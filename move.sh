#!/bin/bash

set -e

echo "================================="
echo "Laravel Hosting Deployment"
echo "================================="

# Masuk ke source Laravel

cd core

echo "[1/6] Pull repository..."
git fetch --all
git reset --hard origin/master

echo "[2/6] Install composer..."
composer install --no-dev --optimize-autoloader

echo "[3/6] Clear cache..."
php artisan optimize:clear

echo "[4/6] Build cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

cd ..

echo "[5/6] Copy public assets..."

cp -rf core/public/css . 2>/dev/null || true
cp -rf core/public/js . 2>/dev/null || true
cp -rf core/public/images . 2>/dev/null || true

cp -f core/public/favicon.ico . 2>/dev/null || true
cp -f core/public/robots.txt . 2>/dev/null || true
cp -f core/public/index.php .

echo "[6/6] Fix index.php path..."

sed -i "s|../storage/framework/maintenance.php|core/storage/framework/maintenance.php|g" index.php

sed -i "s|../vendor/autoload.php|core/vendor/autoload.php|g" index.php

sed -i "s|../bootstrap/app.php|core/bootstrap/app.php|g" index.php

echo "================================="
echo "DEPLOYMENT SUCCESS"
echo "================================="
