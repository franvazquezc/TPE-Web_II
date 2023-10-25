<?php
require_once './app/controllers/product.controller.php';
require_once './app/controllers/category.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/error.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list';
}

$params = explode('/', $action);

switch ($params[0]) {
    // Vistas públicas
    case 'list':
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
    // Manejo de sesión
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
    // Administración de productos
    case 'productAdmin':
        AuthHelper::verify();
        $controller = new ProductController();
        $controller->showProductAdmin();
        break;
    case 'addProduct':
        AuthHelper::verify();
        $controller = new ProductController();
        $controller->addProduct();
        break;
    case 'deleteProduct':
        AuthHelper::verify();
        $controller = new ProductController();
        $controller->deleteProduct($params[1]);
        break;
    case 'updateProductForm':
        AuthHelper::verify();
        $controller = new ProductController();
        if(isset($params[1])) {
            $controller->showProductUpdateForm($params[1]);
        } else {
            $controller->showProductAdmin();
        }
        break;
    case 'updateProduct':
        AuthHelper::verify();
        $controller = new ProductController();
        $controller->updateProduct($params[1]);
        break;
    // Administración de categorías
    case 'categoryAdmin':
        AuthHelper::verify();
        $controller = new CategoryController();
        $controller->showCategoryAdmin();
        break;
    case 'addCategory':
        AuthHelper::verify();
        $controller = new CategoryController();
        $controller->addCategory();
        break;
    case 'deleteCategory':
        AuthHelper::verify();
        $controller = new CategoryController();
        $controller->deleteCategory($params[1]);
        break;
    case 'updateCategoryForm':
        AuthHelper::verify();
        $controller = new CategoryController();
        if(isset($params[1])) {
            $controller->showCategoryUpdateForm($params[1]);
        } else {
            $controller->showCategoryAdmin();
        }
        break;
    case 'updateCategory':
        AuthHelper::verify();
        $controller = new CategoryController();
        $controller->updateCategory($params[1]);
        break;
    // Ventana de error
    case 'error':
        $controller = new ErrorController();
        $controller->showError($params[1]);
        break;
    case 'inputError':
        $controller = new ErrorController();
        $controller->showError("Debe completar todos los campos");
        break;
    case 'formError':
        $controller = new ErrorController();
        $controller->showError("Error al enviar el formulario");
        break;
    default: 
        $controller = new ErrorController();
        $controller->showError("404 Page not found");
        break;
}