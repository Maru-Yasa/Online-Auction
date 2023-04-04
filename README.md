
# Online Auction

  
## Prerequirement

 - PHP **8.1+**
 - Composer **2.5.5**
 - Browser
 - Mysql Server


## Instalation

    $ git clone https://github.com/Maru-Yasa/UKK-Auction
    $ composer install
    $ cp .env.example .env
    $ php artisan migrate --seed
    $ php artisan key:generate
    $ php artisan serve
note : configure your own .env file!