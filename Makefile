all: dist up

# Container management
up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

# Dependency management
dist: composer-install node-install

composer-install:
	docker-compose run --rm composer
node-install:
	docker-compose run --rm node
node-build:
	docker-compose run --rm node npm run build

# Setup local dev environment
local/setup:
	mkdir -p storage/logs/nginx
	cat .env.example > .env
	make composer-install
	make node-install
	make node-build
	make up
	docker-compose exec -ti php-fpm php artisan key:generate
	make migrate

local/reset:
	docker-compose down -v
	make up

mysql-cli:
	include .env
	export
	docker-compose exec mysql mysql -u root -p${DB_PASSWORD} ${DB_DATABASE}

migrate:
	docker-compose exec -ti php-fpm php artisan migrate --seed

# Testing
phpunit: up
	docker-compose exec -ti php-fpm php artisan test
