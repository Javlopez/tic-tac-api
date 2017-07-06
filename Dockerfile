FROM nginx
MAINTAINER Javier Lopez Lopez <sjavierlopez@gmail.com>

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && \
    apt-get install -y curl vim supervisor && \
    apt-get install -y php7.0-fpm php7.0-mbstring php7.0-xml

COPY . /api

WORKDIR /api

RUN rm /etc/nginx/conf.d/default.conf && \
    cp server/api.conf /etc/nginx/conf.d/api.conf

RUN mkdir -p /var/log/supervisor && \
    mkdir -p /var/log/php-fpm

COPY server/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN usermod -aG www-data nginx

RUN service php7.0-fpm start

RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

RUN composer install

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]


