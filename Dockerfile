# Etapa 1: Construcción de dependencias
FROM node:17.9.1 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# Etapa 2: Backend con PHP y Composer
FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev mariadb-client \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

RUN a2enmod rewrite

# Evitar warning de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Cambiar DocumentRoot a /public para Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY .env .env  # <--- Asegúrate de copiar el .env

COPY --from=frontend /app/public/build ./public/build

RUN composer install && composer require laravel/legacy-factories

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan key:generate --force

EXPOSE 80

CMD ["apache2-foreground"]
