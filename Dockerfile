# Multi-stage build for the Laravel + Vite application

## Base PHP image with required extensions
FROM php:8.2-fpm AS php-base

# System dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        zip \
        bcmath \
    && rm -rf /var/lib/apt/lists/*

# Composer (copied from official image to keep layers small)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

## Composer dependencies (no dev)
FROM php-base AS vendor
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --optimize-autoloader
COPY . .
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader

## Frontend build with Vite
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci --quiet
COPY resources ./resources
COPY public ./public
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

## Final production image
FROM php-base AS production

ENV APP_ENV=production \
    APP_DEBUG=false \
    PORT=9000

# Copy backend dependencies and application code
COPY --from=vendor /var/www/html /var/www/html

# Copy built assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# Ensure runtime writable directories
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000
CMD php -S 0.0.0.0:$PORT -t public
