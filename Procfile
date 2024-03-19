web: vendor/bin/heroku-php-apache2 public/
js-install: npm install
build: npm run build
notifications: php artisan queue:listen --queue=default,notifications
