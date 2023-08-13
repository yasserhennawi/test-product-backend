<?php
include_once "../repository/ProductTypeRepository.php";

function getProductTypes(ProductTypeRepository $productType) {
    // query Products product
    $results = $productType->getAll();
    echo json_encode($results);
}
