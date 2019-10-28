# Booki Backend

Backend to booki application (coming soon)

## Folder Structure

    +-- nginx // nginx configuration
    +-- src // (app) laravel project
    +-- docker-compose.yml
    +-- Dockerfile

## Docker

Up

    docker-compose build
    docker-compose up -d

Down

    docker-compose down

Composer install

    docker-compose exec php /usr/local/bin/composer install

Key generate

    docker-compose exec php php /var/www/artisan key:generate

Migrate

    docker-compose exec php php /var/www/artisan migrate

Migrate

    docker-compose exec php php /var/www/artisan db:seed

