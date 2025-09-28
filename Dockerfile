# ---------- STAGE 1: composer (instalar dependencias PHP) ----------
FROM composer:2 AS composer_stage

WORKDIR /app

# Instalar dependencias del sistema necesarias para Composer
RUN apk add --no-cache git unzip libzip-dev

# Copiar composer.json y composer.lock primero para aprovechar la cache de Docker
COPY composer.json composer.lock ./

# Instalar dependencias de PHP (sin autoloader, sin dev, sin scripts)
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-progress \
    --no-interaction


# ---------- STAGE 2: node (build de frontend con Vite o Mix) ----------
FROM node:18 AS frontend

WORKDIR /app

# Copiar package.json y lock para aprovechar cache
COPY package.json package-lock.json* yarn.lock* ./

# Instalar dependencias de Node
RUN npm install

# Copiar el resto del proyecto y compilar frontend
COPY . .
RUN npm run build


# ---------- STAGE 3: php-apache (runtime de Laravel) ----------
FROM php:8.2-apache AS app

WORKDIR /var/www/html

# Instalar dependencias de sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite en Apache para Laravel
RUN a2enmod rewrite

# Copiar dependencias de Composer desde stage composer
COPY --from=composer_stage /app/vendor ./vendor

# Copiar build de frontend desde stage node
COPY --from=frontend /app/public/build ./public/build

# Copiar el resto del proyecto
COPY . .

# Crear directorios de Laravel con permisos correctos
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Generar autoloader optimizado de Composer
RUN composer dump-autoload --optimize

# Entrypoint para generar APP_KEY si no existe y ejecutar migrations
COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
