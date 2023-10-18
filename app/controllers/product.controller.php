<?php
require_once './app/models/product.model.php';
require_once './app/views/product.view.php';

class ProductController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new ProductView();
    }

    public function showProducts() {
        $products = $this->model->getProducts();
        $this->view->showProducts($products);
    }

    public function showProduct($id) {
        $product = $this->model->getProduct($id);
        $this->view->showProduct($product);
    }

    public function showCategory($category_id) {
        $products = $this->model->getProductsByCategory($category_id);
        $this->view->showProducts($products);
    }

    public function showAdmin() {
        $products = $this->model->getProducts();
        $this->view->showAdmin($products);
    }

    public function add() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];

        if (empty($name) || empty($description || empty($price) || empty($stock) || empty($brand) || empty($category))) {
            $this->view->showError("Debe completar todos los campos");
            return;
        } 

        $id = $this->model->insertProduct($name, $description, $price, $stock, $brand, $category);
        
        if ($id) {
            header('Location: ' . BASE_URL . '/admin');
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    }

    public function delete($id) {
        $this->model->deleteProduct($id);
        header('Location: ' . BASE_URL . '/admin');
    }
}