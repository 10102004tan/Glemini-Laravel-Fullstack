php artisan db:seed --class=UserSeeder
Remove-Item -Recurse -Force vendor
Remove-Item composer.lock
composer install