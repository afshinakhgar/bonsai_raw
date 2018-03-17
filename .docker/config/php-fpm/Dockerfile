FROM php:7.1-fpm-alpine
RUN docker-php-ext-install pdo pdo_mysql

#CMD ["tail", "-f", "/var/log/php_errors.log"]
CMD ["php bonsai migrate"]
CMD ["php bonsai seed"]