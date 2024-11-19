# Usar a imagem oficial do PHP com extensões necessárias
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libsqlite3-dev \
    unzip \
    git \
    curl \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    libbz2-dev \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    pdo_mysql \
    intl \
    mbstring \
    zip \
    bcmath \
    opcache \
    exif \
    xml

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install node and npm
RUN apk add --no-cache nodejs npm

# Set working directory
WORKDIR /var/www

EXPOSE 9000