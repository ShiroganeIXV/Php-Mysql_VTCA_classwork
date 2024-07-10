<?php

class Product {
    private $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    public function getAllProducts() {
        $stmt = $this->db->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $price) {
        $stmt = $this->db->prepare('INSERT INTO products (name, price) VALUES (:name, :price)');
        $stmt->execute(['name' => $name, 'price' => $price]);
        return $this->db->lastInsertId();
    }

    public function updateProduct($id, $name, $price) {
        $stmt = $this->db->prepare('UPDATE products SET name = :name, price = :price WHERE id = :id');
        $stmt->execute(['id' => $id, 'name' => $name, 'price' => $price]);
        return $stmt->rowCount() > 0;
    }

    public function deleteProduct($id) {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
