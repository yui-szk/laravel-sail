FROM composer
WORKDIR /var/www/html
COPY . .
RUN composer install
CMD ["php", "artisan", "serve"]
