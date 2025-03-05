php artisan db:seed --class=UserSeeder
Remove-Item -Recurse -Force vendor
Remove-Item composer.lock
composer install
https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://localhost:8000/quizzes/create/O4ISakphhK2UuFkbmUtZ