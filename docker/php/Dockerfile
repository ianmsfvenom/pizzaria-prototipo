FROM php:8.2-fpm-alpine

# Instala dependências do PHP
RUN apk add --no-cache \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libxpm-dev \
    freetype-dev \
    libmcrypt-dev \
    && docker-php-ext-install zip pdo_sqlite gd && docker-php-ext-configure mysqli && docker-php-ext-install mysqli

# Copia os arquivos da aplicação para o container
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala dependências do Composer
RUN composer install --no-dev

# Executa o servidor web
CMD ["php-fpm"]