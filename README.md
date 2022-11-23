# User authentication
Basic user login API with static data.

## Requirements

- PHP v8.1
- Composer

## Installation

- Copy .env.example content into .env file
- Fill database connections data in .env file
- Run the `composer install` command in the command line to install dependencies

## Usage
- Run `php -S 127.0.0.1:8000 -t public` command to start as a server - you can run it with any free port. !Important to set the `public` folder as document root.
- Now you can check the page, type `127.0.0.1:8000` in your browser. You will see a JSON with available routes and static user's data.

## API Routes
- /users/login
> method: POST

> params: form-data
> - username[string]
> - password[string]


## Author
* Gábor Farkas
## License
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
