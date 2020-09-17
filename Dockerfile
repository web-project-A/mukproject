# Dockerfile
FROM php:7.3-apache

RUN apt-get update -y && apt-get install -y git zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql

WORKDIR /app
COPY . /app

RUN composer install

CMD ["/app/scripts/start.sh"]