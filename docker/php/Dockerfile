FROM php:7.3.6-fpm

RUN docker-php-ext-install pdo_mysql

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN apt-get install -y \
        libzip-dev \
        unzip \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip