# Shortlister - PHP web application

This is Mihail Petrushevski's solution for the take a home tast from shortlister. The task is to create a form to add users and display all the users in a table. 
There are bonus points if you add form validation and pagination.

## Implemented features

 - Adding users
 - Ability to see all added users
 - 'Mail to' functionality for each user's email
 - Form validation
 - Pagination of 10 records per page
 - Success and error toast messages
 - Automated test for testing functionalities

## Starting the project

### 1. Install dependencies

composer install

npm install

### 2. Set up database

 - set up database info: (name,host,port,username,pass)

 - run migrations using 'php artisan migrate'

### 3. Run dev server

 php artisan serve

## How to use

 - Fill in all the fields in the form
 - Click 'Add User' button
 - Success toast message should pop up on your screen
 - The user should be visible in the table

## Running test

php artisan  test

 


