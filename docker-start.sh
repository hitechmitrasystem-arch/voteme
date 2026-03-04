#!/bin/bash

echo "Starting Laravel container..."

# Create SQLite database if not exists
mkdir -p database
touch database/database.sqlite

# Fix permissions
chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache database

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate --force

# Start Apache
apache2-foreground