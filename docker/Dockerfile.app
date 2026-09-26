FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

# System dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev libzip-dev unzip curl git libpng-dev libjpeg-dev \
    libfreetype6-dev libonig-dev supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip bcmath sockets exif opcache \
    && pecl install redis \
    && docker-php-ext-enable redis opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ✅ CREATE USER (DEBIAN WAY)
RUN groupadd -g ${GID} wannacry021 \
    && useradd -u ${UID} -g ${GID} -m -s /bin/bash wannacry021

WORKDIR /var/www/laravel_app

USER wannacry021

CMD ["php-fpm"]
