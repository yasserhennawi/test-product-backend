<?php

include_once "../config/Database.php";

abstract class Product {
    protected $conn;
    protected $table = "productlist";
    // product Properties
    protected $SKU;
    protected $name;
    protected $price;
    protected $type;
    protected $width;
    protected $height;
    protected $length;
    protected $size;
    protected $weight;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function read() {
        // query
        $query = "SELECT 
                    SKU,
                    name,
                    type,
                    price, 
                    height, 
                    length, 
                    width, 
                    weight, 
                    size 
                FROM $this->table
                
        ";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // excute query
        $stmt->execute();

        return $stmt;
    }
    abstract protected function create();
}
