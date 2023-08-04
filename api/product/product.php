<?php

// Headers
// setting access to anyone can access
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials:true');

include_once "../../config/Database.php";
include_once "../../models/Product.php";
include_once "../../models/Book.php";
include_once "../../models/DVD.php";
include_once "../../models/Furniture.php";


// instantiat database and connect
$api = $_SERVER['REQUEST_METHOD'];

// instantiat Product 
$database = new Database();
$db = $database->connect();
$book = new Book($db);
$dvd = new DVD($db);
$furniture = new Furniture($db);
if ($api == "POST") {

    // if product is a book
    if ($book->create()) {
        echo json_encode(
            array('message' => 'Book Created')
        );
    } elseif ($dvd->create()) {
        echo json_encode(
            array('message' => 'DVD Created')
        );
    } elseif ($furniture->create()) {
        echo json_encode(
            array('message' => 'Furniture Created')
        );
    } else {
        echo json_encode(
            array('message' => 'product Not Created')
        );
    }
}
