FROM php:7.1-fpm-alpine
WORKDIR /var/www/html
CMD ["tail", "-f", "/var/log/php_errors.log"]
CMD ["php bonsai migrate"]
CMD ["php bonsai seed"]

