<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;

$viewsPath = dirname(__DIR__) . '/app/Views';
$cachePath = dirname(__DIR__) . '/cache';
$blade = new BladeOne($viewsPath, $cachePath);

$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$routes = [
    '/' => 'HomeController@index',
    '/register' => 'AuthController@register',
    '/registration-form' => 'AuthController@showRegistrationForm',
    '/login' => 'AuthController@showLoginForm',
    '/login-action' => 'AuthController@login',
    '/logout' => 'AuthController@logout',
    '/dashboard' => 'DashboardController@index',
    '/saveQuestion-action' => 'QuestionController@saveQuestion',
    '/tag-list' => 'TagController@handleTags',
    '/tag-form' => 'TagController@useTagForm',
    '/save-tag' => 'TagController@addTag',
    '/deleteQuestion-action' =>'QuestionController@deleteQuestion',
    '/redirectForQuestionUpdate-action' => 'QuestionController@goToQuestionPage',
    '/vote' => 'HomeController@vote',
    '/user-list' => 'UserListController@index',
    '/questionPage' => 'QuestionController@goToQuestionPage',    
    '/updateQuestion-action' => 'QuestionController@updateQuestion',
    '/answer' => 'AnswerController@index',
    '/saveAnswer' => 'AnswerController@saveAnswer',
    '/list-answers' => 'AnswerController@getAnswers',
    '/answerAction' => 'AnswerController@action',
    '/search' => 'HomeController@search',
    '/updateAnswer' => 'AnswerController@update',
    '/removeTag' => 'TagController@deleteTag'

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
