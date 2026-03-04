#!/bin/bash

# Create SQLite database if missing
mkdir -p database
touch database/database.sqlite

# Fix permissions
chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache database

# Run migrations
php artisan migrate --force

# Start Apache
apache2-foreground