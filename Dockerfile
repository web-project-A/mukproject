# Dockerfile
FROM php:7.3-apache

# set working directory and copy files to it
WORKDIR /app
COPY . /app

# install additional required packages to image
RUN apt-get update -y && apt-get install -y git zip

# install mysql driver
RUN docker-php-ext-install pdo_mysql

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install dependencies
RUN composer install

# run script when container starts
CMD ["/app/scripts/start.sh"]