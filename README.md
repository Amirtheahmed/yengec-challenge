# Yengeç Backend developer challenge project

This is a small Laravel Api project intended for an interview challenge @ **Yengeç**. The project focuses on basic Api development with *TDD* and it uses Laravel 8 with *Passport* for authentication.

# Installation
Clone project from git

    $ git clone https://github.com/Amirtheahmed/yengec-challenge.git
### Install Required dependencies

    $ cd yengec-challenge
    $ composer install

1. Create empty **databse.sqlite** and **test.sqlite** files in database folder
   Make sure you have set database type to **sqlite** on `.env`  and then point **DB_DATABASE** to absolute path of **database.sqlite** file
2. Copy `.env.example` to `env.testing` and make sure you have set database type to **sqlite** on `.env.testing` then, point **DB_DATABASE** to **absolute path** of **test.sqlite**

then run these commands:

    $ php artisan migrate
    $ php artisan serve

## Testing
To run tests :

    $ composer run_test
or

    $ php artisan test
## Code Quality Analysis
I have included `[PHPInsights](https://github.com/nunomaduro/phpinsights)` library to simplify code quality analysis. run this command for analysis

    $ php artisan insights
