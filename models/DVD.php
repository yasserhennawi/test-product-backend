<?php
include_once "./Product.php";
include_once "./CreateProduct.php";
class DVD extends Product {
    // get all books
    public function read() {
        // query
        $query = "SELECT 
                    SKU,
                    name,
                    type,
                    price, 
                    size
                FROM $this->table WHERE type = 'DVD' ;
                
        ";
        // prepare statement
        $stmt = $this->conn->prepare($query);

        // excute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    public function create() {

        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET SKU = :SKU, name = :name, price = :price, type = :type, size = :size;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // get data from params
        $data = json_decode(file_get_contents("php://input"));
        $this->SKU = $data->SKU;
        $this->name = $data->name;
        $this->price = $data->price;
        $this->type = $data->type;
        $this->size = $data->size;
        if (!$this->size) {
            return;
        } else {

            // Clean data
            $this->SKU = htmlspecialchars(strip_tags($this->SKU));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->size = htmlspecialchars(strip_tags($this->size));

            // Bind data
            $stmt->bindParam(':SKU', $this->SKU);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':size', $this->size);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }
        }
    }
    // Delete multiple values
    public function delete($SKUs) {
    }
}
