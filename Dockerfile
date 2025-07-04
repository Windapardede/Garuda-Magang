FROM php:8.2-cli

# Install ekstensi
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd

# Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

RUN composer install

# ✅ Sesuaikan EXPOSE port
EXPOSE 8080

# ✅ Gunakan ini agar Railway bisa detect server kamu
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]
