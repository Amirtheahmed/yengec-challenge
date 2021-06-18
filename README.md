# Yengeç Backend developer challenge project

This is a small Laravel Api project intended for an interview challenge @ **Yengeç**. The project focuses on basic Api development with *TDD*. It uses Laravel 8 with *Passport* for authentication.
Project by **Amir Ahmed**.


# Installation
Clone project from git

    $ git clone https://github.com/Amirtheahmed/yengec-challenge.git
### Install Required dependencies

    $ cd yengec-challenge
    $ composer install

Create empty **databse.sqlite** and **test.sqlite** files in database folder
Make sure you have **set database type to sqlite** on `.env` file and then **and pointed DB_DATABASE to absolute path of above sqlite dbs we created above**, then :

    $ php artisan migrate
	$ php artisan serve


