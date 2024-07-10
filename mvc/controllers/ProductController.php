<?php

class ProductController {
    private $productModel;

    public function __construct(Product $productModel) {
        $this->productModel = $productModel;
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        include 'views/products/index.php';
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id);
        include 'views/products/show.php';
    }

    public function create() {
        include 'views/products/create.php';
    }

    public function store($name, $price) {
        $this->productModel->addProduct($name, $price);
        header('Location: index.php');
    }

    public function edit($id) {
        $product = $this->productModel->getProductById($id);
        include 'views/products/edit.php';
    }

    public function update($id, $name, $price) {
        $this->productModel->updateProduct($id, $name, $price);
        header('Location: index.php');
    }

    public function delete($id) {
        $this->productModel->deleteProduct($id);
        header('Location: index.php');
    }
}