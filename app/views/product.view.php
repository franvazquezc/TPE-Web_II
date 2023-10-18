<?php

class ProductView {
    public function showProducts($products) {        
        require 'templates/productList.phtml';
    }

    public function showProduct($product) {
        require 'templates/productDetails.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showAdmin($products) {
        require 'templates/productAdminForm.phtml';
    }
}