FROM php:8.2-fpm

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libicu-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
