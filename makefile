.PHONY: start
start: stop composer up db

.PHONY: stop
stop: ## stop environment
		docker-compose stop

.PHONY: composer
composer: ## spin up environment
		docker-compose run php php composer.phar install

.PHONY: up
up: ## up docker
		docker-compose up -d

.PHONY: db
db: ## up db
		docker-compose exec php bin/console d:d:d --if-exists --force
		docker-compose exec php bin/console d:d:c
		docker-compose exec php bin/console d:s:c
		docker-compose exec php bin/console d:f:l -n

.PHONY: php
php: ## login to php container
		docker-compose exec php /bin/bash

.PHONY: require
require: ## require to composer
		docker-compose exec php php composer.phar require $(m)


.PHONY: style
style: ## executes php analizers
		docker-compose exec php ./vendor/bin/phpstan analyse -l 7 -c phpstan.neon src

.PHONY: cs
cs: ## executes php analizers
		docker-compose exec php ./vendor/bin/php-cs-fixer fix --allow-risky=yes

.PHONY: layer
layer: ## layer
		docker-compose exec php ./vendor/bin/deptrac

.PHONY: phpunit
phpunit: ## test
		docker-compose exec php ./vendor/bin/phpunit

.PHONY: test
test: cs layer style phpunit