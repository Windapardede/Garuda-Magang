FROM php:8.2-cli

# Install ekstensi PHP dan utilitas
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www

# Salin semua file ke dalam container
COPY . .

# Install dependensi Laravel
RUN composer install

# Expose port yang digunakan
EXPOSE 8080

# Jalankan Laravel dengan port yang bisa dibaca Railway
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]
