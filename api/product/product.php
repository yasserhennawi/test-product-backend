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

// instantiat database and connect
$api = $_SERVER['REQUEST_METHOD'];

// instantiat Product 
$database = new Database();
$db = $database->connect();
$product = new Product($db);

// Getting value based on HTTP Method
switch ($api) {
        // in case of get request
    case "GET":
        // query Products
        $result = $product->read();

        // get row count
        $count = $result->rowcount();

        // check if there is any product
        if ($count > 0) {
            $product_arr = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $product_item = array(
                    "SKU" => $SKU,
                    "name" => $product_name,
                    "type_name" => $type_name,
                    "price" => $price,
                    "height" => $height,
                    "width" => $width,
                    "length" => $length,
                    "size" => $size,
                    "weight" => $weight,
                );

                // add product to array
                array_push($product_arr, $product_item);
            }
            echo json_encode($product_arr);
        } else {
            // no product
            echo json_encode(
                array("message" => "no products found")
            );
        }
        break;
    case "POST":
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $product->SKU = $data->SKU;
        $product->name = $data->name;
        $product->price = $data->price;
        $product->type_name = $data->type_name;

        $product->width = $data->width ?? null;
        $product->length = $data->length ?? null;
        $product->height = $data->height ?? null;
        $product->size = $data->size ?? null;
        $product->weight = $data->weight ?? null;


        // Create product
        if ($product->create()) {
            echo json_encode(
                array('message' => 'product Created')
            );
        } else {
            echo json_encode(
                array('message' => 'product Not Created')
            );
        }
}
