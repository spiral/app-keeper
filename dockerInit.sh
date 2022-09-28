[ ! -f .env ] && cp .env.sample .env
docker-compose up -d --build && \
docker cp keeper:/var/www/.env . && \
docker cp keeper:/var/www/vendor . && \
docker cp keeper-nginx:/usr/share/nginx/html/generated ./public && \
docker-compose -f docker-compose.yml -f docker-compose-local.yml -f docker-compose-custom-front-local.yml up -d
docker exec keeper bash -c "php app.php encrypt:key -m .env"
docker exec keeper bash -c "php app.php configure -vv"
docker exec keeper bash -c "php app.php migrate:init"
docker exec keeper bash -c "php app.php migrate"
