
![enter image description here](https://i.ibb.co/P9nxc8K/online-auction.png)
# Online Auction Application

The Online Auction Application is a platform that allows users to buy goods through this application. This application provides a convenient and user-friendly way for individuals and businesses to participate in online auctions.

## Features

-   Create auctions for items with starting prices
-   Bid on auctions
-   Search for items
-   Get audits for bidding activity and auction status updates
-   Useful administrator tools to manage the site effectively
-   User friendly and beautiful interface

## Prerequirement

 - PHP **8.1+**
 - Composer **2.5.5**
 - Mysql Server


## Installation

To install the Online Auction Application (dev), follow these steps:

    $ git clone https://github.com/Maru-Yasa/UKK-Auction
    $ cd UKK-Auction
    $ composer install
    $ cp .env.example .env
    $ php artisan migrate --seed
    $ php artisan key:generate
    $ php artisan serve
*note : configure your own .env file!*

## Usage

To use the Online Auction Application, follow these steps:

1.  Register for an account or log in
2.  Create an auction or bid on an existing auction
3.  Communicate with the other party through the messaging system
4.  Complete the transaction using the integrated payment system

## Technologies Used

-   Laravel 10
-   Jquery
-   Bootstrap
-   MySQL

## License

The Online Auction Application is licensed under the [MIT License](https://opensource.org/licenses/MIT).