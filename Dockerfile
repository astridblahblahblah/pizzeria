# PHP 8.3 FPM
FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zip libzip-dev npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files and create folders expected by autoload
COPY composer.json ./
RUN mkdir -p database/seeders database/factories
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy the rest of the app
COPY . .

# Regenerate optimized autoload without running artisan scripts
RUN composer dump-autoload --optimize --no-scripts

EXPOSE 9000
CMD ["php-fpm"]
