<?php

// Headers
// setting access to anyone can access 
// {not recommended in production app for security purposes}
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET,POST,DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials:true');

include_once "./database/Database.php";
include_once "./repository/ProductRepository.php";
include_once "./repository/ProductTypeRepository.php";
include_once "./repository/ProductMySQLRepository.php";
include_once "./repository/ProductTypeMySQLRepository.php";
include_once "./controller/getProduct.php";
include_once "./controller/getProductType.php";
include_once "./controller/createProduct.php";
include_once "./controller/deleteProduct.php";
include_once "./model/Product.php";
include_once "./config/DotEnv.php";




// instantiat database and connect
$methodType = $_SERVER['REQUEST_METHOD'];
$requestUrl = $_SERVER['REQUEST_URI'];
 // instantiat Product 

$database = new Database("sql309.byethost7.com", "b7_34813050_testcase", "b7_34813050", "r40ct2ks");
$databaseConnection = $database->connect();
$product = new ProductMySQLRepository($databaseConnection);
$type = new ProductTypeMySQLRepository($databaseConnection);

if ($requestUrl  === "/api/products") {
    switch ($methodType) {
        case "GET":
            getProducts($product);
            break;
        case "POST":
            createProduct($product);
            break;
        case "DELETE":
            deleteProduct($product);
            break;
    }
} else if ($requestUrl  === "/api/types") {
    switch ($methodType) {
        case "GET":
            getProductTypes($type);
            break;
    }
} else {
    echo "server error url not found";
}
