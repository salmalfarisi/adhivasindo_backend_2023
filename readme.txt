1. buat database berdasarkan data yang berasal dari .env (DB_DATABASE)
2. lakukan command berikut ini : 
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan migrate:fresh
php artisan db:seed
php artisan key:generate
php artisan passport:install --force
php artisan passport:client --personal (isi dengan "--personal")
php artisan serve --port=8000

note:
- untuk pengetesan API, hanya bisa dilakukan via POSTMAN. berikut ini merupakan langkah-langkahnya :
1. login via postman
2. ambil token yang didapat dari hasil API
3. pastikan variable di dalam collection sudah terupdate ke dalam postman