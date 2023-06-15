# Installation
Run the following commands to install all needed packages
* composer install
* npm install

Then setup your .env file and fill out needed settings (such as DB, ect)

## Run artisan commands
* php artisan key:generate
* php artisan migrate
* php artisan db:seed

## Additional NPM commands
* npm run <dev|prod|ect>

## Demo Credentials
**Admin:** admin@admin.com  
**Password:** secret

**User:** user@user.com  
**Password:** secret

# NCSC Registry
The NCSC Registry was setup using https://github.com/rappasoft/laravel-boilerplate (written by Anthony Rappa). 

## Background jobs
You can run the RetrieveFeed job manually by running `php artisan job:dispatch RetrieveFeed` - or as recommended, setup the Laravel's worker as documented on https://laravel.com/docs/10.x/scheduling#running-the-scheduler

## Configuration
You can set the minimum chance and/or damage level to be recorded in config/feedregistry.php. Default only H/H vulnerabilities are saved into the database. 