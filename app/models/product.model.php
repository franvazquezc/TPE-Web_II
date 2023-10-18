<?php
require_once 'config.php'; 

class ProductModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    function getProducts() {
        $query = $this->db->prepare('SELECT * FROM products');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function getProduct($id) {
        $query = $this->db->prepare('SELECT * FROM products WHERE product_id = ?');
        $query->execute([$id]);

        $product = $query->fetch(PDO::FETCH_OBJ);

        return $product;
    }

    function getProductsByCategory($category_id) {
        $query = $this->db->prepare('SELECT * FROM products WHERE category_id = ?');
        $query->execute([$category_id]);

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    //Ver efecto de relaciones entre tablas.

    function insertProduct($name, $description, $price, $stock, $brand_id, $category_id) {
        $query = $this->db->prepare('INSERT INTO products (name, description, price, stock, brand_id, category_id) VALUES(?,?,?,?,?,?)');
        $query->execute([$name, $description, $price, $stock, $brand_id, $category_id]);

        return $this->db->lastInsertId();
    }

    function deleteProduct($id) {
        $query = $this->db->prepare('DELETE FROM products WHERE product_id = ?');
        $query->execute([$id]);
    }

    //Falta módificaciones.  
}