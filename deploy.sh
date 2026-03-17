#!/bin/bash
# Deployment script for cPanel
# Run this after files are uploaded

cd ~/public_html  # Adjust to your app path

# Install/update dependencies
php composer.phar install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if not exists
php artisan storage:link

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs storage/framework

echo "Deployment complete!"
