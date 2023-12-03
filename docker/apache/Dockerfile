FROM php:8.2-apache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN apt update && apt install -y git && apt install -y vim && apt install -y libzip-dev zip unzip

COPY docker/apache/vhosts.conf /etc/apache2/sites-available/
COPY docker/apache/00_xdebug.ini /usr/local/etc/php/conf.d/

RUN a2enmod rewrite && a2ensite vhosts

EXPOSE 80

WORKDIR /var/www/html
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]