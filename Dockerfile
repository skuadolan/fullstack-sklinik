# Gunakan image PHP dengan Apache versi 8.2
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Aktifkan mod_rewrite untuk Apache
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Izinkan Composer berjalan sebagai superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

# Salin file proyek Laravel ke dalam container
COPY . /var/www/html

# Ubah kepemilikan file menjadi www-data
RUN chown -R www-data:www-data /var/www/html

# Set working directory ke /var/www/html
WORKDIR /var/www/html

# Install dependencies Laravel dengan Composer
# RUN composer install

# Set permission untuk storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Jalankan Apache
CMD ["apache2-foreground"]
