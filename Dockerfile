FROM composer:2.4 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

FROM php:8.1-apache-buster as production

ENV APP_ENV=production
ENV APP_DEBUG=false

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=build /app /var/www/html/
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.prod /var/www/html/.env

RUN chown -R www-data:www-data /var/www/
RUN chown -R www-data:www-data /var/www/html/storage/
RUN chmod 777 /var/www/html/storage/ -R

RUN a2enmod rewrite

RUN php artisan storage:link