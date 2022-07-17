# Local

local-start:
	docker-compose -f Docker/docker-compose.yml up -d

local-build:
	docker-compose -f Docker/docker-compose.yml build

local-stop:
	docker-compose -f Docker/docker-compose.yml stop

local-down:
	docker-compose -f Docker/docker-compose.yml down

local-bash:
	docker exec -it library_api_php bash

local-db:
	docker exec -it library_api_db bash