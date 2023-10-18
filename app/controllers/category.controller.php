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
}