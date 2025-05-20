docker-compose build app
docker-compose up -d
docker-compose exec app docker-php-ext-install pdo pdo_mysql mbstring
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
