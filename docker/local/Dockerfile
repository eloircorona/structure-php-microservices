FROM php:7.4-apache-buster

RUN apt-get update \
        && apt-get install -y \
            libzip-dev \
            zip \
        && docker-php-ext-install zip mysqli pdo pdo_mysql

WORKDIR /var/www/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/

COPY ./public/ /var/www/html

RUN composer install

RUN chown -R www-data:www-data /var/www/logs

EXPOSE 80

RUN a2enmod rewrite