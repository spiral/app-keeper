IF NOT EXIST .env copy .env.sample .env
docker-compose up -d --build
docker cp keeper:/var/www/.env .
docker cp keeper:/var/www/vendor .
docker cp keeper:/var/www/composer.lock ./composer.lock
docker cp keeper-nginx:/usr/share/nginx/html/generated ./public
docker-compose -f docker-compose.yml -f docker-compose-local.yml -f docker-compose-custom-front-local.yml up -d
docker exec keeper bash -c "php app.php migrate:init"
docker exec keeper bash -c "php app.php migrate"
