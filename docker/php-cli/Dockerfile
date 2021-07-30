FROM php:8.0-cli-alpine3.13

RUN apk add --no-cache autoconf g++ make

#install PG
RUN apk add --no-cache postgresql-dev bash coreutils \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN apk add --no-cache unzip
RUN docker-php-ext-install pdo_pgsql pcntl opcache
RUN docker-php-ext-install bcmath fileinfo

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /app