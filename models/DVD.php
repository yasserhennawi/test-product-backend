<?php
include_once "./Product.php";
class DVD extends Product {

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
}
