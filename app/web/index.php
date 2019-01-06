<?php
/**
 * Created by PhpStorm.
 * User: wangjin
 * Date: 2019-01-05
 * Time: 17:47
 */

$version = PHP_VERSION;
if($version < 5.6)
{
    exit('PHP 版本最低支持 5.6');
}

define('APP_ROOT',dirname(__DIR__));
define('SITE_URL','http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'],0,-10));
date_default_timezone_set('Asia/Shanghai');

require  '../../vendor/autoload.php';

$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', function() {
    echo 'Hello Wang Jin';
});


$router->map('GET|POST','/[a:controller]/[a:action]',function($controller,$action){
    $controllerClass = '\app\controllers\\'.ucfirst($controller).'Controller';
    $controller = new $controllerClass();
    if (method_exists($controller,$action)) {
        $controller->$action();
    }else{
        exit($action.' is not exists');
    }

});


$router->map('GET|POST','/[a:controllerName]/[a:actionName]/?[**:]',function($controllerName,$actionName){
    $args = explode('/',$_SERVER['REQUEST_URI']);
    $args = array_slice($args,3);
    $controllerClass = '\app\controllers\\'.ucfirst($controllerName).'Controller';
    $controller = new $controllerClass();
    if (method_exists($controller,$actionName)) {
        $controller->$actionName(...$args);
    }else{
        exit($actionName.' is not exists');
    }

});


// match current request url
$match = $router->match();

// call closure or throw 404 status
if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    // no route was matched
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}