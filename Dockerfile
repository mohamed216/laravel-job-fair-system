FROM php:8.2-cli
RUN apt-get update && apt-get install -y libzip-dev unzip zip git \
    && docker-php-ext-install pdo pdo_mysql zip bcmath
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction
CMD php ...
