# ---------- STAGE 1: composer (instala dependencias PHP) ----------
FROM composer:2.7 AS composer_stage

WORKDIR /app

# Copiar solo composer.json y composer.lock para aprovechar la cache
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader

# ---------- STAGE 2: node (build de frontend si usas Laravel Mix/Vite) ----------
FROM node:18 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ---------- STAGE 3: PHP + Apache (runtime) ----------
FROM php:8.2-apache

# Habilitar módulos necesarios
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo pdo_mysql gd zip \
  && a2enmod rewrite \
  && rm -rf /var/lib/apt/lists/*

# Configurar DocumentRoot para Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
  && echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copiar código de la app
COPY . .

# 🚫 NO copiamos .env (se debe montar o pasar como env vars)
# COPY .env .env  <-- ❌ eliminado para no "hornear" credenciales en la imagen

# Copiar dependencias instaladas
COPY --from=composer_stage /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# Dar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
