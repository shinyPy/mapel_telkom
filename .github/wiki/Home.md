## Getting Started

### Dependencies

* [composer](http://composer.org/)

### Installing

* Clone this repository
```
git clone https://github.com/shinyPy/mapel_telkom
```
Get packages 
```
composer update
```
Or you can just use Github Desktop for cloning
* Copy .env.example and rename it to .env and configure the setting to your liking.
* Run this command to generate JWT Key
```
php artisan jwt:secret
```
* Migrate and seed the database.
```
php artisan migrate
```
Then run this command
```
php artisan serve
```