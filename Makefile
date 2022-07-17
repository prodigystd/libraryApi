# Local

local-start:
	docker-compose -f Docker/docker-compose.yml up -d

local-start-v:
	docker-compose -f Docker/docker-compose.yml up

local-build:
	docker-compose -f Docker/docker-compose.yml build

local-stop:
	docker-compose -f Docker/docker-compose.yml stop

local-down:
	docker-compose -f Docker/docker-compose.yml down

local-bash:
	docker exec -it library_api_php bash

local-test:
	docker exec -it library_api_db bash -c "mysql -u root -p'library' < /var/www/html/test_dump.sql"
	docker exec -it library_api_php bash -c "composer install; php vendor/bin/phpunit Tests/Feature/"
	docker exec -it library_api_db bash -c "mysql -u root -p'library' -e 'DROP DATABASE library_test'"

local-db:
	docker exec -it library_api_db bash

