FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libmysqlclient-dev \
    zip unzip curl \
    && docker-php-ext-install intl mbstring pdo pdo_mysql mysqli curl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev --no-interaction

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
