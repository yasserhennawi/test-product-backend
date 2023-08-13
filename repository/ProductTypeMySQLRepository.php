<?php
include_once "./ProductTypeRepository.php";
include_once "../model/Type.php";

class ProductTypeMySQLRepository extends ProductTypeRepository {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getAll() {
        // query
        $query = "SELECT 
          type.id,
          type.name
          FROM type";

        //     // Prepare statement
        $stmt = $this->conn->prepare($query);
        $productType_arr = array();

        //     // excute query
        $stmt->execute();
        // return $stmt;
        // // get row count
        $count = $stmt->rowcount();
        // check if there is any books
        if ($count > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $productType_item = array(
                    "id" => $id,
                    "name" => $name,
                );
                // add productType to array
                array_push($productType_arr, $productType_item);
            }
        }
        return $productType_arr;
    }
};
