# Etapa 1: Construcción de dependencias
FROM node:17.9.1 as frontend

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos de package.json y lock
COPY package*.json ./

# Instalar dependencias de Node.js
RUN npm install

# Copiar el resto del proyecto (solo recursos frontend)
COPY . .

# Compilar los assets de Laravel (Vite/Mix)
RUN npm run build


# Etapa 2: Backend con PHP y Composer
FROM php:8.1-apache

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev mariadb-client \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto al contenedor
COPY . .

# Copiar assets construidos en la primera etapa
COPY --from=frontend /app/public/build ./public/build

# Instalar dependencias de Laravel
RUN composer install && composer require laravel/legacy-factories

# Configurar permisos para Laravel (storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generar key de Laravel
RUN php artisan key:generate

# Ejecutar migraciones y seeders (opcional, puedes mover esto a docker-compose para evitar problemas en producción)
RUN php artisan migrate:fresh --seed || true

# Exponer el puerto de Apache
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
