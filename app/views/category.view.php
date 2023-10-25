<?php

class CategoryView {
    public function showCategories($categories) {        
        require 'templates/categoryList.phtml';
    }

    public function showCategoryAdmin($categories) {
        require 'templates/categoryAdmin.phtml';
    }

    public function showCategoryUpdateForm($id) {
        require 'templates/categoryUpdateForm.phtml';
    }
}