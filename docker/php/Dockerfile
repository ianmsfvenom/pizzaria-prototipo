# Usar a imagem oficial do PHP com extensões necessárias
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libsqlite3-dev \
    unzip \
    git \
    nodejs \
    npm \
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

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar o código da aplicação
WORKDIR /var/www
COPY . .

# Configurar permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Set working directory
WORKDIR /var/www

EXPOSE 9000
CMD ["php-fpm"]