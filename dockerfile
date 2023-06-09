FROM php:7.3-apache

RUN apt-get update                                  \
    && apt-get install -y                           \
    && docker-php-ext-install mysqli pdo pdo_mysql  \
    && a2enmod rewrite                              \
    && chmod 777 -R -c /var/www