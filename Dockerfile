FROM php:8.3-apache

COPY --from=composer/composer:2.7-bin /composer /usr/bin/composer

RUN apt update && apt install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

COPY . /too-long-to-read

WORKDIR /too-long-to-read

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install

RUN touch data/hit-counter.txt

ENV NASA_TOKEN "DEMO_KEY"
ENV GOOGLEAPI_TOKEN "123456"

ENV APACHE_DOCUMENT_ROOT /too-long-to-read/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

EXPOSE 80