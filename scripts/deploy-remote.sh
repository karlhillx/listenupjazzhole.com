#!/usr/bin/env bash
# Build and optimize inside the app container after code is synced.
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

echo "→ Installing PHP dependencies"
composer install --no-dev --optimize-autoloader --no-interaction

echo "→ Installing JS dependencies and building assets"
npm ci --include=dev
npm run build

echo "→ Optimizing Laravel"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "→ Fixing runtime permissions"
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

echo "→ Reopening site"
php artisan up --no-interaction || true

echo "✓ Deploy complete"
