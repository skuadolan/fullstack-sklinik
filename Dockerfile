# Gunakan image PHP dengan Apache versi 8.2
FROM php:8.2-apache

# Install dependencies dan ekstensi PHP dalam satu layer
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql && \
    a2enmod rewrite && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    # Install Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    # Set permissions dan bersihkan cache
    rm -rf /var/lib/apt/lists/*

# Salin file proyek Laravel ke dalam container
COPY . /var/www/html

# Ubah kepemilikan file menjadi www-data
RUN chown -R www-data:www-data /var/www/html

# Set working directory ke /var/www/html
WORKDIR /var/www/html

# Install dependencies Laravel dengan Composer (pastikan Composer sudah ada)
# RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Set permission untuk storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Sesuaikan konfigurasi Apache untuk Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Jalankan Apache
CMD ["apache2-foreground"]
