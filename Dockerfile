FROM php:8.3-apache AS base

FROM base AS deps
WORKDIR /too-long-to-read

RUN apt update && apt install -y \
    libzip-dev \
    zip \
    libcurl4-openssl-dev \
    curl \
    && docker-php-ext-install zip \
    && docker-php-ext-install curl

COPY --from=composer/composer:2.7-bin /composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install

FROM base as runner
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
WORKDIR /too-long-to-read

COPY --from=deps /too-long-to-read/vendor ./vendor
COPY . .

RUN touch data/hit-counter.txt data/accessedBooks.csv \
    && chown www-data:www-data data/hit-counter.txt data/accessedBooks.csv

ENV NASA_TOKEN "DEMO_KEY"

ENV APACHE_DOCUMENT_ROOT /too-long-to-read/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

EXPOSE 80