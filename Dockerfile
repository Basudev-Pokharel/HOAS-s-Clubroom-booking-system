# ---------- Build stage ----------
FROM php:8.2-fpm AS build

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip curl zip nodejs npm\
    libzip-dev libonig-dev libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath xml

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# ---------- Runtime stage ----------
FROM php:8.2-fpm

WORKDIR /var/www/html
ENV PORT=10000

RUN apt-get update && apt-get install -y \
    nginx supervisor curl gettext-base libpq-dev \
    && docker-php-ext-install pdo_pgsql


# Copy built app
COPY --from=build /var/www/html /var/www/html

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Nginx template
COPY docker/nginx/default.conf.template /etc/nginx/templates/default.conf.template

# Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start container: generate Nginx config, run migrations & seed, then supervisord
CMD envsubst '$PORT' < /etc/nginx/templates/default.conf.template > /etc/nginx/sites-available/default && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    #  php artisan migrate:fresh --force --seed && \
     php artisan migrate --force && \
    /usr/bin/supervisord -n
