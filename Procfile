web: vendor/bin/heroku-php-apache2 public/
notifications: npm install && npm run build && php artisan queue:listen --queue=default,notifications
