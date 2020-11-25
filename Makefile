uplocal:
	docker-compose -f docker-compose.yml -f docker-compose-local.yml -f docker-compose-custom-front-local.yml up -d

bash:
	docker-compose exec php bash
logs:
	docker logs keeper --tail=10 -f

migrate:
	php app.php migrate:init && php app.php migrate
