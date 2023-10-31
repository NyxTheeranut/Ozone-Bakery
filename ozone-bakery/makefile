build:
	@docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(shell pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
composer install --ignore-platform-reqs
	@cp .env.example .env
	@./vendor/bin/sail up -d
	@./vendor/bin/sail composer require laravel/breeze --dev 
	@./vendor/bin/sail artisan breeze:install blade
	@./vendor/bin/sail yarn install
	@./vendor/bin/sail composer require spomky-labs/otphp
	@./vendor/bin/sail composer require bacon/bacon-qr-code
