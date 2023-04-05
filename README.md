
  
![enter image description here](https://i.ibb.co/P9nxc8K/online-auction.png)
# Online Auction Application

The Online Auction Application is a platform that allows users to buy goods through this application. This application provides a convenient and user-friendly way for individuals and businesses to participate in online auctions.

## Features

-  Create auctions for items with starting prices
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

### For client
1.  Register for an account or log in
2.  Create an auction or bid on an existing auction
3.  Wait till admin closed the auction
4.  Check on your dashboard page if you won or not

### For staff/admin
1.  Log in
2.  Create an auction
3.  Close or open auction
4.  Complete the auction
5.  Calls client who won

## Technologies Used

-   Laravel 10
-   Jquery
-   Bootstrap
-   MySQL

## Environtments
Each environtments had a database itself (except for the **Local** and **Staging**). Also each environtments had a marker in top of website except **Production**
 - **Local** (develpment)
 - **Staging**
 - **Production**
 - 
## Contributing

When contributing to this repository, please first discuss the change you wish to make via issue,
email, or any other method with the owners of this repository before making a change. 

Please note we have a code of conduct, please follow it in all your interactions with the project.

### Pull Request Process

1. Ensure any install or build dependencies are removed before the end of the layer when doing a 
   build.
2. Update the README.md with details of changes to the interface, this includes new environment 
   variables, exposed ports, useful file locations and container parameters.
3. Increase the version numbers in any examples files and the README.md to the new version that this
   Pull Request would represent. The versioning scheme we use is [SemVer](http://semver.org/).
4. You may merge the Pull Request in once you have the sign-off of two other developers, or if you 
   do not have permission to do that, you may request the second reviewer to merge it for you.

## License

The Online Auction Application is licensed under the [MIT License](https://opensource.org/licenses/MIT).