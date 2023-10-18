<?php

class CategoryView {
    public function showCategories($categories) {        
        require 'templates/categoryList.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}