<?php

require "../bootstrap.php";

use UserAuth\App\Controllers\UserController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER["REQUEST_METHOD"];
$uriParts = explode('/', $uri);

$routes = [
    'users' => [
        'method'     => 'POST',
        'expression' => '/^\/users\/login\/?$/',
        'controller' => 'UserAuth\App\Controllers\UserController',
        'action'     => 'login',
    ],
];

$routeFound = null;

foreach ($routes as $route) {
    if ($route['method'] == $requestMethod && preg_match($route['expression'], $uri)) {
        $routeFound = $route;
        break;
    }
}

if (!$routeFound) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(['success' => false, 'data' => [
        'message' => 'This route is does not exist, but you can try login on /users/login with a POST request.',
        'users' => [
            ['username' => 'john_doe90', 'password' => 'CustomPw1'],
            ['username' => 'jane_doe93', 'password' => 'CustomPw2'],
            ['username' => 'admin', 'password' => 'Admin12!']
        ],
    ]]);

    die();
}

$controllerName = $route['controller'];
$action = $route['action'];

(new $controllerName())->$action($uri);
