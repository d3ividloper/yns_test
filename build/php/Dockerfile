FROM php:7.4-fpm-alpine

LABEL maintainer=<acampderros@multiestetica.com>

RUN apk add --no-cache --virtual .deps zlib-dev libzip-dev zip git sqlite-dev bash \
    #&& docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip pdo_sqlite

ADD start.sh /start.sh

RUN chmod 775 /start.sh

CMD ["/start.sh"]
