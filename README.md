# User authentication
Basic user login API with static data.

## Requirements

- PHP v8.1
- Composer

## Installation

- Copy .env.example content into .env file
- Create a new database and import `user_auth.sql` file
- Fill .env file with database connections data
- Run the `composer install` command in the command line to install dependencies

## Usage
- Run `php -S 127.0.0.1:8000 -t public` command to start as a server - you can run it with any free port. !Important to set the `public` folder as document root.
- Now you can check the page, type `127.0.0.1:8000` in your browser. You will see a JSON with available routes and static user's data.

### Try with curl
- Open command line and type for example `curl -X POST http://127.0.0.1:8000/users/login -d "username=john_doe90" -d "password=CustomPw1"`
- You will see a success JSON response with user data

## API Routes
- `/users/login`
> Method: POST

> Params: form-data
> - username - required, string
> - password - required, string

> Responses:
> - 200: OK - User object
> - 400: Bad request - missing required parameters
> - 422: Unprocessable entity - incorrect parameters

## Author
* Gábor Farkas
## License
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
