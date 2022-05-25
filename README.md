## Currency Exchanging App

### Project requirements
 php version 8.0
 mysql version 8.0
 composer version 2.0

run:
```
git clone git@github.com:andreafilipovic/currency_exchange.git
composer install
cp .env.example .env
php artisan key:generate
```

create locally mysql database
add all needed credentials for database in .env

run:
```
php artisan migrate
php artisan db:seed
php artisan serve
```