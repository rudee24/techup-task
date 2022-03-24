# TaskManager
## Features

- Register New User
- Login Existing User
- View Existing Tasks with Notes
    - order_by : 'priority','notes'
    - filters : status, due_date, priority
- Create task with multiple notes and attachments

## Tech

Application uses a number of requirements to work properly:

- [PHP]  >= 8.1
- [Laravel] - 9.*
- [laravel/sanctum] - For API authentication

## Installation

Clone the repository to your server then execule following commands from the root directory of the application

```sh
composer install
cp .env.example .env
php artisan key:generarte
```

After executing the above command just update your db credentials in ".env" file. 
After adding your db credentials to the .env file, execute the following commands

```sh
php artisan migrate
php artisan db:seed
php artisan serve
```
Your application may run on http://localhost:8000

## Api Endpoints

The application utilizes fillowing API routes for various tasks

| Method | Endpoint | Usage
| ------ | ------ |  -------
| POST | [api/register] | To register a new user
| POST | [api/login] | To login an existing user
| GET | [api/tasks] | To retrieve all tasks
| POST | [api/tasks] | To create new tasks
| POST | [api/logout] | To logout the user

Note: All API request must contain following header 
        `Accept : application/json`


## API Endpoint parameters

#### api/register

| Variable Name | Type | Nullable 
|---------------|-------|--------
name|string|N
email|email|N
password|string,min:6|N
password_confirmation|string,min:6|N

#### api/login

| Variable Name | Type | Nullable 
|---------------|-------|--------
email|email|N
password|string|N

#### /api/tasks - GET

| Variable Name | Type (Value) | Optional 
|---------------|-------|--------
status| String ('New', 'Complete', 'Incomplete')|Y
priority|String ('High', 'Medium', 'Low')|Y
due_date|date (Y-m-d)|Y
notes|int|Y
order_by|String ('priority', 'notes')|Y

#### /api/tasks - POST

| Variable Name | Type  | Optional 
|---------------|-------|--------
subject|string|N
description|string|N
start_date|date (Y-m-d)|N
due_date | date(y-m-d) | N
satus | enum (New, Incomplete, Complete)|N
priority | enum(High, Medium, Low) |N
notes|array()|N

`notes` can be an empty array [] or may contain following subarray
[
{"subject":'',"attachment[]":'',"note":''},
{"subject":'',"attachment[]":'',"note":''}
.....
]

where `attachment[]` can be `NULL` or may contain array of files to be attached (max:2mb)

NOTE :
    - api/tasks - GET/POST
    - api/logout - POST
    
These are secured routes and require access token provided during login or registration to access them.

## Test Credentilas 

 Username : test@abc.com
 Password : password