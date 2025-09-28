# ---------- STAGE 1: composer (instala dependencias PHP) ----------
FROM php:8.1-cli AS composer_stage

# Instalar dependencias necesarias para composer
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer manualmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copiar composer.json y composer.lock primero para aprovechar cache
COPY composer.json composer.lock ./

# Instalar dependencias (sin autoloader, sin dev)
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-progress \
    --no-interaction


# ---------- STAGE 2: node (build de frontend si usas Vite) ----------
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build


# ---------- STAGE 3: app final (PHP + Apache) ----------
FROM php:8.1-apache AS app

# Habilitar extensiones y mod_rewrite
RUN apt-get update && apt-get install -y \
    libzip-dev unzip \
    && docker-php-ext-install zip pdo pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copiar dependencias PHP desde la etapa composer
COPY --from=composer_stage /app/vendor ./vendor

# Copiar código de la app
COPY . .

# Copiar build del frontend desde la etapa node
COPY --from=frontend /app/public/build ./public/build

# Dar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Ajustar DocumentRoot a /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
