<?php
include_once "./Product.php";
include_once "./CreateProduct.php";
class Furniture extends Product {

    public function read() {
        // query
        $query = "SELECT 
                    SKU,
                    name,
                    type,
                    price, 
                    width,
                    height,
                    length
                FROM $this->table WHERE type = 'Furniture';
                
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
        $query = 'INSERT INTO ' . $this->table . ' SET SKU = :SKU, name = :name, price = :price, type = :type, length = :length, width = :width, height= :height;';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // get data from params
        $data = json_decode(file_get_contents("php://input"));
        $this->SKU = $data->SKU;
        $this->name = $data->name;
        $this->price = $data->price;
        $this->type = $data->type;
        $this->length = $data->length;
        $this->width = $data->width;
        $this->height = $data->height;
        if (!$this->length || !$this->height || !$this->width) {
            return;
        } else {

            // Clean data
            $this->SKU = htmlspecialchars(strip_tags($this->SKU));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->length = htmlspecialchars(strip_tags($this->length));
            $this->width = htmlspecialchars(strip_tags($this->width));
            $this->height = htmlspecialchars(strip_tags($this->height));

            // Bind data
            $stmt->bindParam(':SKU', $this->SKU);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':length', $this->length);
            $stmt->bindParam(':width', $this->width);
            $stmt->bindParam(':height', $this->height);

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
