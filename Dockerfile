# ---------- Stage 1: Build ----------
FROM php:8.2-fpm AS build

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    zip \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath xml

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Run Laravel optimizations
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan event:cache

# ---------- Stage 2: Production ----------
FROM php:8.2-fpm

WORKDIR /var/www/html

# Copy built app from previous stage
COPY --from=build /var/www/html /var/www/html

# Set permissions for storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Install system dependencies for runtime
RUN apt-get update && apt-get install -y nginx supervisor curl

# Copy Nginx configuration
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Expose port 80
EXPOSE 80

# Start PHP-FPM and Nginx using Supervisor
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["/usr/bin/supervisord", "-n"]
