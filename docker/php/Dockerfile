FROM php:8.3-fpm-alpine3.19


# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zlib-dev \ 
    libicu-dev \
    libsqlite3-dev \
    libxml2-dev \
    libonig-dev \
    libbz2-dev 

# Install PHP extensions
RUN docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install node and npm
RUN apk add --no-cache nodejs npm

# Copiar o código da aplicação para o contêiner
WORKDIR /var/www

EXPOSE 9000
