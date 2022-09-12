# Run app
composer update
php artisan:key generate
php artisan migrate:fresh --seed
php artisan test
php artisan serve