#FROM phpdockerio/php72-fpm:latest
# Install selected extensions and other stuff
WORKDIR "/var/www/html"
RUN apt-get update
RUN apt-get install pdo pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

#
#RUN apt-get update \
#    && apt-get -y --no-install-recommends install  php-memcached php7.2-mysql php-redis php-xdebug php7.2-gd \
#    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#
