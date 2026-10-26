#!/bin/sh
set -eu
cd /var/www/html
if [ ! -f .env ]; then cp .env.example .env; fi
composer install --no-interaction --prefer-dist --no-progress
if ! grep -Eq '^APP_KEY=base64:.+' .env; then php artisan key:generate --force; fi
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache
exec docker-php-entrypoint "$@"