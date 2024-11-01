CLI = docker compose -f docker-compose-cli.yml

.PHONY: startup
startup:
	$(MAKE) build_dev install run

.PHONY: run
run:
	docker compose -f docker-compose.yml up -d

.PHONY: stop
stop:
	docker compose -f docker-compose.yml down

.PHONY: restart
restart:
	$(MAKE) stop
	$(MAKE) run

.PHONY: teardown
teardown:
	-docker compose -f  docker-compose.yml down
	docker compose -f  docker-compose.yml rm -f
	docker compose -f  docker-compose.yml rm -f
	docker compose -f  docker-compose.yml run --rm mysql-service sh -c 'rm -rf /var/lib/mysql || true'
	rm -rf database

.PHONY: reset
reset:
	$(MAKE) teardown
	$(MAKE) startup

.PHONY: unit-test
unit-test:
	docker compose -f docker-compose.yml run --rm --no-deps -e XDEBUG_MODE=coverage php-service php \
        vendor/bin/phpunit --coverage-clover tests/reports/phpunit.coverage.xml --coverage-html tests/reports/ \
        --configuration tests/phpunit.xml tests/unit/

.PHONY: update
update:
	$(CLI) run --rm --no-deps php_cli-service php -d memory_limit=-1 /usr/bin/composer update

.PHONY: require
require:
	$(CLI) run --rm --no-deps php_cli-service php -d memory_limit=-1 /usr/bin/composer require

.PHONY: autoloader
autoloader:
	$(CLI) run --rm --no-deps php_cli-service php -d memory_limit=-1 /usr/bin/composer dump-autoload

.PHONY: build_dev
build_dev:
	docker build -f chess-backend/docker/php/Dockerfile . \
		-t chess-backend-php-fpm:dev
	docker build -f chess-backend/docker/nginx/Dockerfile . \
		-t chess-backend-nginx:dev
	docker build -f chess-backend/docker/mysql/Dockerfile . \
		-t chess-backend-mysql:dev
	docker build -f chess-backend/docker/php_cli/Dockerfile . \
		-t chess-backend-php_cli:dev
	docker build -f chess-frontend/Dockerfile . \
		-t chess-vue-frontend:dev


.PHONY: install
install:
	$(CLI) run --rm --no-deps php_cli-service php -d memory_limit=-1 /usr/bin/composer install
