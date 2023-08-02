<?php

include_once "../config/Database.php";

class Product {
    // DB stuff
    private $conn;
    private $table1 = "products";
    private $table2 = "types";

    // product Properties
    public $SKU;
    public $name;
    public $price;
    public $type_name;
    public $width;
    public $height;
    public $length;
    public $size;
    public $weight;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Products
    public function read() {
        // query
        $query = "SELECT 
                    products.SKU,
                    `products`.`name` as product_name, 
                    type_name, price, 
                    types.height as height, 
                    types.length as length, 
                    types.width as width, 
                    types.weight as weight, 
                    types.size as size 
                FROM `products` 
                LEFT JOIN `types` ON products.SKU = types.SKU;
        ";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // excute query
        $stmt->execute();

        return $stmt;
    }
    // create product
    // Create Post
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table1 . ' SET SKU = :SKU, name = :name, price = :price, type_name = :type_name;' .
            'INSERT INTO ' . $this->table2 . ' SET SKU = :SKU, length = :length, width = :width, height = :height, size = :size, weight = :weight;
        ';


        // Prepare statement
        $stmt = $this->conn->prepare($query);


        // Clean data
        $this->SKU = htmlspecialchars(strip_tags($this->SKU));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->type_name = htmlspecialchars(strip_tags($this->type_name));
        $this->length = htmlspecialchars(strip_tags($this->length));
        $this->width = htmlspecialchars(strip_tags($this->width));
        $this->height = htmlspecialchars(strip_tags($this->height));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->weight = htmlspecialchars(strip_tags($this->weight));

        // Bind data
        $stmt->bindParam(':SKU', $this->SKU);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type_name', $this->type_name);
        $stmt->bindParam(':length', $this->length);
        $stmt->bindParam(':width', $this->width);
        $stmt->bindParam(':height', $this->height);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':weight', $this->weight);


        // Execute query
        if ($stmt->execute()) {


            return true;
        }
    }
}
