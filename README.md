# laravel-starter
A Laravel Starter Application with Passport Authentication.

## Installation

Use the package manager composer for installing

1. Do the following commands for installing
```bash
git clone https://github.com/ericwidhiantara/laravel-starter.git
cd laravel-starter
composer install
copy .env.example .env
php artisan key:generate
```

2. Create a database 
3. Setting database name, username, and password in your .env file
4. Do the following instructions if you're done setting database in .env
```bash
php artisan migrate
php artisan passport:install
php artisan db:seed
php artisan config:cache
```

## To run the application
```bash
php artisan serve
```

## To test the API using Postman
Make sure you have Postman installed on your machine

a. Login
1. Create a new request (POST)
2. Enter url http://localhost:8000/api/login
3. Set the body request using formdata (username : admin , password: admin)
4. Send request

b. Get User Detail
1. Create a new request (GET)
2. Enter url http://localhost:8000/api/user
3. Set the header (Authorization : Bearer *)
4. Change the * with access token from the login API
5. Send request

## Demo Account
1.  Username: **admin**
    Password: **admin** 
    
## License
[MIT](https://choosealicense.com/licenses/mit/)
