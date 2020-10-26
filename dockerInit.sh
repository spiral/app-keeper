docker-compose up -d --build && \
docker cp keeper:/var/www/.env . && \
docker cp keeper:/var/www/vendor . && \
docker-compose -f docker-compose.yml -f docker-compose-custom-front.yml -f docker-compose-local.yml up -d
docker exec keeper bash -c "php app.php migrate:init"
docker exec keeper bash -c "php app.php migrate"
