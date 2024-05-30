FROM composer
WORKDIR /var/www/html
COPY . .
CMD ["php", "artisan", "serve"]