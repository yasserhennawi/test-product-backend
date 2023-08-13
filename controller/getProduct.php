<?php
include_once "../repository/ProductRepository.php";

function getProducts(ProductRepository $product) {
    // query all products
    $result = $product->getAll();
    echo json_encode($result);
}
