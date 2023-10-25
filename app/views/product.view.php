<?php

class ProductView {
    public function showProducts($products) {        
        require 'templates/productList.phtml';
    }

    public function showProduct($product) {
        require 'templates/productDetails.phtml';
    }

    public function showProductAdmin($products, $categories) {
        require 'templates/productAdmin.phtml';
    }

    public function showProductUpdateForm($id, $categories) {
        require 'templates/productUpdateForm.phtml';
    }
}