FROM php:7.0.20-fpm
MAINTAINER Javier Lopez Lopez <sjavierlopez@gmail.com>

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /api

WORKDIR api

RUN apk add --update curl && \
    rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

RUN composer install

# Expose the app port
EXPOSE 8000

# Start the app
CMD php artisan serve --port=8000