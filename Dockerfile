# Dockerfile
FROM php:7.2-apache

WORKDIR /var/www

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

ADD . /var/www
ADD ./public /var/www/html

RUN chown -R www-data:www-data /var/www