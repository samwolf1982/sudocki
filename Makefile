docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

docker-cli:
	docker-compose exec php-cli /bin/bash
docker-cli-f:
	docker-compose exec  php-fpm /bin/bash
docker-cli-ng:
	docker-compose exec  nginx /bin/bash

docker-cli-redis:
	docker-compose exec redis /bin/bash

test:
	docker-compose exec php-cli vendor/bin/phpunit  --colors=always

migrate:
	docker-compose exec php-cli app/yii migrate

assets-install:
	docker-compose exec node yarn install

assets-dev:
	docker-compose exec node yarn run dev

assets-watch:
	docker-compose exec node yarn run watch
docker-art-reclear:
	docker-compose exec php-cli /bin/bash -c "php artisan migrate:rollback --step=4"
	docker-compose exec php-cli /bin/bash -c "php artisan migrate"
perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R
	if [-d "node-modules" ]; then sudo chown ${USER}:${USER} node-modules -R; fi
	if [-d "public-build" ]; then sudo chown ${USER}:${USER} public-build -R; fi