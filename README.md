## Currency Exchanging App

run:
```
git clone git@github.com:andreafilipovic/currency_exchange.git
composer update
composer install
cp .env.example .env
php artisan key:generate
```

create locally mysql database
add all needed credentials for database in .env

run:
```
php artisan migrate
php artisan seed
php artisan serve
```