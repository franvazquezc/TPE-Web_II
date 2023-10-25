<?php
require_once 'model.php';

class ProductModel extends Model {

    function getProducts() {
        $query = $this->db->prepare('SELECT product_id, name, description, category_id FROM products');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function getProductsWithCategory() {
        $query = $this->db->prepare('SELECT products.*, categories.name AS category 
                                    FROM products INNER JOIN categories 
                                    ON products.category_id = categories.category_id');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function getProductWithCategory($id) {
        $query = $this->db->prepare('SELECT products.*, categories.name AS category 
                                    FROM products INNER JOIN categories 
                                    ON products.category_id = categories.category_id
                                    WHERE product_id = ?');
        $query->execute([$id]);

        $product = $query->fetch(PDO::FETCH_OBJ);

        return $product;
    }

    function getProductsByCategory($category_id) {
        $query = $this->db->prepare('SELECT products.*, categories.name AS category 
                                    FROM products INNER JOIN categories 
                                    ON products.category_id = categories.category_id
                                    WHERE products.category_id = ?');
        $query->execute([$category_id]);

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function insertProduct($name, $description, $price, $stock, $category_id) {
        $query = $this->db->prepare('INSERT INTO products (name, description, price, stock, category_id) VALUES(?,?,?,?,?)');
        $query->execute([$name, $description, $price, $stock, $category_id]);

        return $this->db->lastInsertId();
    }

    function deleteProduct($id) {
        $query = $this->db->prepare('DELETE FROM products WHERE product_id = ?');
        $query->execute([$id]);
    }

    function updateProduct($name, $description, $price, $stock, $category_id, $id) {
        $query = $this->db->prepare('UPDATE products 
                                    SET name = ?, description = ?, price = ?, stock = ?, category_id = ? 
                                    WHERE product_id = ?');
        $query->execute([$name, $description, $price, $stock, $category_id, $id]);
    }
}