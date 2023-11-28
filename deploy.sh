#!/bin/bash

echo "Starting deployment process..."

# Enable stop on errors and treat unset variables as errors
set -eu

echo "Changing directory to /home/bookstore/bookstore/bookstore-app"
cd /home/bookstore/bookstore/bookstore-app

echo "Pulling latest changes from Git repository"
sudo -u bookstore git pull

echo "Installing Composer dependencies"
sudo -u bookstore php8.2 /usr/bin/composer install --optimize-autoloader --no-dev

echo "Installing Node.js dependencies"
sudo -u bookstore npm install

echo "Running Laravel migrations"
sudo -u bookstore php8.2 artisan migrate --no-interaction --force

echo "Optimizing Laravel application"
sudo -u bookstore php8.2 artisan optimize

echo "Building the application using npm"
sudo -u bookstore npm run build

echo "Caching the application's routes"
sudo -u bookstore php8.2 artisan route:cache

echo "Caching the application's events"
sudo -u bookstore php8.2 artisan event:cache

echo "Restarting the application's queue workers"
sudo -u bookstore php8.2 artisan queue:restart

echo "Caching the application's views"
sudo -u bookstore php8.2 artisan view:cache

echo "Deployment process completed successfully!"
