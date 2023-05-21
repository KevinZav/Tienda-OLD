<?php

    session_start();
    require_once './src/app.routes.php';
    require './service/conexion.service.php';
    require_once './service/session.service.php';
    
    $userType = @$_SESSION['user']['role_id'];
    // $userType = @$_SESSION['user']['userType'];

    $controller = @$_GET['controller'];
    $action = @$_GET['action'];

    $routeConfig = Router::getRoute($userType,"$controller/$action");

    if(!$routeConfig['success']) {
        $redirect = Router::getRouteURL($routeConfig['redirect']);
        header('Location: '.$redirect);
    }

    require_once Router::getController($controller);

    $controller = $controller.'Controller';

    $appController = new $controller();
    $appController->routeConfig = $routeConfig;


    $appController->$action();

?>