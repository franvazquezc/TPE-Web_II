<?php
require_once './app/controllers/product.controller.php';
require_once './app/controllers/category.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'listar';
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        $controller = new ProductController();
        $controller->showProducts();
        break;
    case 'categories':
        $controller = new CategoryController();
        $controller->showCategories();
        break;
    case 'product':
        $controller = new ProductController();
        $controller->showProduct($params[1]);
        break;
    case 'category':
        $controller = new ProductController();
        $controller->showCategory($params[1]);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'admin':
        AuthHelper::verify();
        $controller = new ProductController();
        $controller->showAdmin();
        break;
    case 'add':
        $controller = new ProductController();
        $controller->add();
        break;
    case 'delete':
        $controller = new ProductController();
        $controller->delete($params[1]);
        break;
    default: 
        echo 'error';
        break;
}