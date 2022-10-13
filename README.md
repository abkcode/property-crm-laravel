## Server Requirements

- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

- sqlite3 PHP Extension
- gd PHP Extension

## Setup

composer install
cp example.env .env
touch database/database.sqlite
php artisan key:generate
php artisan storage:link
mkdir storage/app/public/image && mkdir storage/app/public/image/full && mkdir storage/app/public/image/thumbnails
php artisan serve
php artisan queue:work --timeout=6000