FROM php:5.6-apache

RUN docker-php-ext-install pdo_mysql && docker-php-ext-install mysqli && docker-php-ext-enable mysqli