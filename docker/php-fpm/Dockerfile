FROM php:8.0-fpm-alpine

#install PG
RUN apk add --no-cache postgresql-dev bash coreutils \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

#enable extensions
RUN docker-php-ext-install pdo_pgsql opcache bcmath fileinfo

WORKDIR /app