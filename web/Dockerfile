FROM php:7.1-apache
MAINTAINER docker-web

RUN apt-get update \
    && apt-get -y install vim wget lsb-release libicu-dev mysql-client libfreetype6-dev libjpeg62-turbo-dev libpng12-dev \
    && docker-php-ext-install pdo_mysql mysqli intl gd
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
RUN ln -s /etc/apache2/mods-available/vhost_alias.load /etc/apache2/mods-enabled

COPY ./php.ini /usr/local/etc/php/
