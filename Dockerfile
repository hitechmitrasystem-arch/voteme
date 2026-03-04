FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Enable apache rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Set Laravel public folder as Apache root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Create SQLite database
RUN mkdir -p database && touch database/database.sqlite

# Permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 storage bootstrap/cache database

# Laravel setup
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan migrate --force

EXPOSE 80