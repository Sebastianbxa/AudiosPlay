# ---------- STAGE 1: composer ----------
FROM php:8.2-cli AS composer_stage
# Copiar composer desde la imagen oficial
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./

# Usa PHP 8.2 para instalar dependencias
RUN composer install --no-dev --no-scripts --no-autoloader

# ---------- STAGE 2: node (build de frontend) ----------
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ---------- STAGE 3: PHP + Apache ----------
FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip git \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo pdo_mysql gd zip \
  && a2enmod rewrite \
  && rm -rf /var/lib/apt/lists/*

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
  && echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . .

# Copiar dependencias de Composer instaladas con PHP 8.2
COPY --from=composer_stage /app/vendor ./vendor

# Copiar assets compilados por Vite/Laravel Mix
COPY --from=frontend /app/public/build ./public/build

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
