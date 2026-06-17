FROM php:8.3-fpm
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY app/ .

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

RUN chmod -R 777 storage bootstrap/cache

CMD ["php-fpm"]
