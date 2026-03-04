FROM php:8.2-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable apache rewrite
RUN a2enmod rewrite

# Change Apache document root to Laravel public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80