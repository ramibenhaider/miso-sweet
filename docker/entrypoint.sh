set -e

PORT=${PORT:-80}
sed -i "s/PORT_PLACEHOLDER/${PORT}/g" /etc/nginx/conf.d/laravel.conf

php artisan storage:link --no-interaction || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

if [ -n "$DB_HOST" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || true
fi

php-fpm -D

echo "Starting Nginx on port ${PORT}..."
exec nginx -g "daemon off;"
