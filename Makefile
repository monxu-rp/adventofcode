.PHONY: up down unit-test acceptance-test

.DEFAULT_GOAL := help

help:
	@echo "Available options:"
	@echo "  start                   Start the containers & Install dependencies"
	@echo "  stop                    Stop the containers"
	@echo "  down                    Stop and remove the containers"
	@echo "  install                 Install project dependencies"
	@echo "  shell                   Access into the apache container"
	@echo "  help                    List all available options "

start:
	docker-compose up -d && docker-compose exec apache composer install

stop:
	docker-compose stop

down:
	docker-compose down

install:
	docker-compose exec apache composer install

shell:
	docker-compose exec apache /bin/bash

