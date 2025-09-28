#!/bin/bash
set -e

# Si no hay APP_KEY en el entorno, la generamos
if [ -z "$APP_KEY" ]; then
  echo "No APP_KEY set, generating one..."
  php artisan key:generate --force
fi

# Ejecutar migraciones si están habilitadas por variable de entorno
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "Running migrations..."
  php artisan migrate --force
fi

exec "$@"
