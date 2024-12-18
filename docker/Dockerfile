FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libzip-dev unzip && \
    docker-php-ext-install mysqli zip && \
    a2enmod rewrite

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80