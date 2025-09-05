FROM php:8.3-fpm-alpine

# Instala as extensões PHP e dependências de sistema necessárias
RUN apk add --no-cache git \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    oniguruma-dev \
    autoconf \
    g++ \
    make \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Inicia o servidor de desenvolvimento do Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
