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
    abstract public function read();
    abstract protected function create();
    abstract protected function delete($SKUs);
}
