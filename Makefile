bash:
	docker-compose exec php bash

up:
	docker-compose -f docker-compose.yml -f docker-compose-local.yml up -d
