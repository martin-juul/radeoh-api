APP_NAME=martin-juul/radeoh-api

.PHONY: build dive clean

build:
	docker build --tag ${APP_NAME} .

dive: clean
	dive build .

clean:
	php artisan clear-compiled
	php artisan cache:clear
	php artisan event:clear
	php artisan optimize:clear
	php artisan route:clear
	php artisan view:clear
