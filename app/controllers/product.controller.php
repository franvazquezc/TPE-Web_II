<?php
require_once './app/models/product.model.php';
require_once './app/views/product.view.php';

class ProductController {
    private $model;
    private $view;
    private $categoryModel;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new ProductView();
        $this->categoryModel = new CategoryModel();
    }

    public function showProducts() {
        $products = $this->model->getProductsWithCategory();
        $this->view->showProducts($products);
    }

    public function showProduct($id) {
        $product = $this->model->getProductWithCategory($id);
        $this->view->showProduct($product);
    }

    public function showCategory($category_id) {
        $products = $this->model->getProductsByCategory($category_id);
        $this->view->showProducts($products);
    }

    public function showProductAdmin() {
        $products = $this->model->getProducts();
        $categories = $this->categoryModel->getCategories();
        $this->view->showProductAdmin($products, $categories);
    }

    public function addProduct() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category = $_POST['category'];

        if (empty($name) || empty($description) || empty($price) || empty($stock) || empty($category)) {
            header('Location: ' . BASE_URL . 'inputError');
            die();
        }

        $done = $this->model->insertProduct($name, $description, $price, $stock, $category);
        
        if ($done) {
            header('Location: ' . BASE_URL . 'productAdmin');
        } else {
            header('Location: ' . BASE_URL . 'formError');
        }
    }

    public function deleteProduct($id) {
        $this->model->deleteProduct($id);
        header('Location: ' . BASE_URL . 'productAdmin');
    }

    
    public function showProductUpdateForm($id) {
        $categories = $this->categoryModel->getCategories();
        $this->view->showProductUpdateForm($id, $categories);
    }
    
    public function updateProduct($id) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category = $_POST['category'];
        
        if (empty($name) || empty($description) || empty($price) || empty($stock) || empty($category)) {
            header('Location: ' . BASE_URL . 'inputError');
            die();
        }

        $this->model->updateProduct($name, $description, $price, $stock, $category, $id);

        header('Location: ' . BASE_URL . 'productAdmin');
    }
}