init: down build up composer-install
up:
	docker-compose -f docker-compose.yaml -f up -d
down:
	docker-compose -f docker-compose.yaml -f down -v --remove-orphans
composer-install:
	docker-compose -f docker-compose.yaml run --rm php-cli composer install
composer-update:
	docker-compose -f docker-compose.yaml run --rm php-cli composer update
build:
	docker-compose -f docker-compose.yaml -f build