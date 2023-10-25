<?php
require_once './app/models/category.model.php';
require_once './app/views/category.view.php';

class CategoryController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
    }

    public function showCategories() {
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }

    public function showCategoryAdmin() {
        $categories = $this->model->getCategories();
        $this->view->showCategoryAdmin($categories);
    }

    public function addCategory() {
        $name = $_POST['name'];

        if (empty($name)) {
            header('Location: ' . BASE_URL . 'inputError');
            die();
        }
        
        $done = $this->model->insertCategory($name);

        if ($done) {
            header('Location: ' . BASE_URL . 'categoryAdmin');
        } else {
            header('Location: ' . BASE_URL . 'formError');
        }
    }

    public function deleteCategory($id) {
        $this->model->deleteCategory($id);
        header('Location: ' . BASE_URL . 'categoryAdmin');
    }

    public function showCategoryUpdateForm($id) {
        $this->view->showCategoryUpdateForm($id);
    }
    
    public function updateCategory($id) {
        $name = $_POST['name'];
        
        if (empty($name)) {
            header('Location: ' . BASE_URL . 'inputError');
            die();
        }

        $this->model->updateCategory($name, $id);

        header('Location: ' . BASE_URL . 'categoryAdmin');
    }
}