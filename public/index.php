<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;

$viewsPath = dirname(__DIR__) . '/app/Views';
$cachePath = dirname(__DIR__) . '/cache';
$blade = new BladeOne($viewsPath, $cachePath);

$allowedMethods = $config['allowedMethods'] ?? [];
$allowedIPs = $config['allowedIPs'] ?? [];
$allowedBrowsers = $config['allowedBrowsers'] ?? [];

$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
/*
if (array_key_exists($uri, $allowedMethods) && !in_array($requestMethod, $allowedMethods[$uri])) {
    http_response_code(405);
    echo '405 Method Not Allowed';
    exit;
}

$clientIP = $_SERVER['REMOTE_ADDR'];
if (!in_array($clientIP, $allowedIPs)) {
    http_response_code(403);
    echo '403 Forbidden';
    exit;
}

$userAgent = $_SERVER['HTTP_USER_AGENT'];
$browser = get_browser(null, true)['browser'];
if (!in_array($browser, $allowedBrowsers)) {
    http_response_code(403);
    echo '403 Forbidden';
    exit;
}
*/
$routes = [
    '/' => 'HomeController@index',
    '/register' => 'AuthController@register',
    '/registration-form' => 'AuthController@showRegistrationForm',
    '/login' => 'AuthController@showLoginForm',
    '/login-action' => 'AuthController@login',
    '/logout' => 'AuthController@logout',
    '/dashboard' => 'DashboardController@index',
    '/tag-list' => 'TagController@handleTags',
];



if (array_key_exists($uri, $routes)) {
    list($controllerName, $action) = explode('@', $routes[$uri]);
    $controllerName = 'App\\Controllers\\' . $controllerName;
    $controller = new $controllerName($blade);
    $controller->$action();
} else {
    http_response_code(404);
    echo '404 Not Found';
}
