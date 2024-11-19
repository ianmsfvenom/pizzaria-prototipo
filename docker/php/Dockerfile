# Usar a imagem oficial do PHP com extensões necessárias
FROM php:8.2-fpm

# Instalar dependências
# Instalar dependências do sistema
RUN apk add --no-cache \
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
    xml \
    bash

# Instalar extensões do PHP
RUN docker-php-ext-install gd \
    && docker-php-ext-install zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache nodejs npm

# Copiar o código da aplicação para o contêiner
WORKDIR /var/www

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

EXPOSE 9000
CMD ["php-fpm"]
