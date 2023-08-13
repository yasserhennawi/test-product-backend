<?php
include_once "../repository/ProductRepository.php";

// TODO Edit to single delete
function deleteProduct(ProductRepository $product) {
    // get data from body
    $data = json_decode(file_get_contents("php://input"));
    $SKU = $data->SKU;
    $product->delete($SKU);
    // error handle
}
