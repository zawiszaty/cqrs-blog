FROM php:7.3.9-fpm-alpine3.10

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.7.2 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo_mysql

RUN apk update && \
    apk add git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN apk add \
        libzip-dev \
        unzip \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip

