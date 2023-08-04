<?php

// Headers
// setting access to anyone can access
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials:true');

include_once "../../../config/Database.php";
include_once "../../../models/Product.php";
include_once "../../../models/Book.php";
include_once "../../../models/DVD.php";
include_once "../../../models/Furniture.php";


// instantiat database and connect
$api = $_SERVER['REQUEST_METHOD'];

// instantiat Product 
$database = new Database();
$db = $database->connect();
$book = new Book($db);
$dvd = new DVD($db);
$furniture = new Furniture($db);

if ($api == "GET") {

    // query Products product
    $books = $book->read();
    $furnitures = $furniture->read();
    $dvds = $dvd->read();
    $product_arr = array();

    // get row count
    $countBooks = $books->rowcount();
    // check if there is any books
    if ($countBooks > 0) {
        while ($row = $books->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item = array(
                "SKU" => $SKU,
                "name" => $name,
                "type" => $type,
                "price" => $price,
                "weight" => $weight,
            );

            // add product to array
            array_push($product_arr, $product_item);
        }
    }
    $countDVDs = $dvds->rowcount();
    // // check if there is any books
    if ($countDVDs > 0) {

        while ($row = $dvds->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item = array(
                "SKU" => $SKU,
                "name" => $name,
                "type" => $type,
                "price" => $price,
                "size" => $size,
            );

            // add product to array
            array_push($product_arr, $product_item);
        }
    }
    $countFurnitures = $furnitures->rowcount();
    // // check if there is any books
    if ($countFurnitures > 0) {

        while ($row = $furnitures->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item = array(
                "SKU" => $SKU,
                "name" => $name,
                "type" => $type,
                "price" => $price,
                "height" => $height,
                "length" => $length,
                "width" => $width,
            );

            //         // add product to array
            array_push($product_arr, $product_item);
        }
    }
    echo json_encode($product_arr);
}
