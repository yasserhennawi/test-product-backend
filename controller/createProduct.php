<?php

include_once "../repository/ProductRepository.php";
include_once "../model/Product.php";

// TODO return Product
function createProduct(ProductRepository $product) {
    // get data from body, not params
    $data = json_decode(file_get_contents("php://input"));
    // Sanitize user input
    // add sanitize function
    $SKU = trim(htmlspecialchars(strip_tags($data->SKU)));
    $name = trim(htmlspecialchars(strip_tags($data->name)));
    $price = trim(htmlspecialchars(strip_tags($data->price)));
    $type = trim(htmlspecialchars(strip_tags($data->type)));
    $width = trim(htmlspecialchars(strip_tags($data->width)));
    $length = trim(htmlspecialchars(strip_tags($data->length)));
    $height = trim(htmlspecialchars(strip_tags($data->height)));
    $size = trim(htmlspecialchars(strip_tags($data->size)));
    $weight = trim(htmlspecialchars(strip_tags($data->weight)));

    $newProduct = new Product(
        $SKU,
        $name,
        $price,
        $type,
        $width,
        $length,
        $height,
        $size,
        $weight,
    );
    $product->create($newProduct);
    echo json_encode($newProduct);
}
