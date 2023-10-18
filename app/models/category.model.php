<?php
require_once 'config.php'; 

class CategoryModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    function getCategories() {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();

        $categories = $query->fetchAll(PDO::FETCH_OBJ);

        return $categories;
    }

    function getCategory($id) {
        $query = $this->db->prepare('SELECT * FROM categories WHERE category_id = ?');
        $query->execute($id);

        $category = $query->fetch(PDO::FETCH_OBJ);

        return $category;
    }

}