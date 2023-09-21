all: dist up

# Container management
up:
	docker-compose up -d

down:
	docker-compose down

# Dependency management
dist: composer-install node-install

composer-install:
	docker-compose run --rm composer
node-install:
	docker-compose run --rm composer

# Setup local dev environment
local/setup:
	mkdir -p storage/logs/nginx
	cat .env.example > .env
	make composer-install
	make up
	docker-compose exec -ti php-fpm php artisan key:generate
	docker-compose exec -ti php-fpm php artisan migrate --seed

local/reset:
	docker-compose down -v
	make up

mysql-cli:
	include .env
	export
	docker-compose exec mysql mysql -u root -p${DB_PASSWORD} ${DB_DATABASE}

# Testing
phpunit: up
	docker-compose exec -ti php-fpm php artisan test
