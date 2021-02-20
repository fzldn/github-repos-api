FROM php:7.3-fpm-alpine

# Install Packages
RUN apk add --no-cache \
    composer

WORKDIR /var/www/html
COPY . /var/www/html

# RUN composer install
