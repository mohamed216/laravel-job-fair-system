FROM php:8.2-cli

RUN apt-get update && apt-get install -y libzip-dev libpq-dev unzip zip git \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chmod -R 775 storage bootstrap/cache

CMD php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
