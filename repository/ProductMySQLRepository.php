<?php
include_once "./ProductRepository.php";
include_once "../model/Product.php";

class ProductMySQLRepository extends ProductRepository {
  private $conn;
  public function __construct($db) {
    $this->conn = $db;
  }
  public function getAll(): array {
    // query
    $query = "SELECT 
      product.SKU,
      product.name,
      type.name AS type_name,
      product.price, 
      product.weight,
      product.length,
      product.width,
      product.height,
      product.size
      FROM product
      LEFT JOIN type
      ON type.id = product.type";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // excute query
    $stmt->execute();
    $product_arr = array();
    // // // get row count
    $count = $stmt->rowcount();
    // // // check if there is any books
    if ($count > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
          "SKU" => $SKU,
          "name" => $name,
          "type_name" => $type_name,
          "price" => $price,
          "weight" => $weight,
          "size" => $size,
          "length" => $length,
          "width" => $width,
          "height" => $height,
        );
        //         // add product to array
        array_push($product_arr, $product_item);
      }
    }
    return $product_arr;
  }


  // create product
  public function create(Product $newProduct) {
    // // Create query
    $query = "INSERT INTO product
      SET name = :name ,
      price = :price,
      type = :type,
      size = :size,
      weight = :weight,
      height = :height,
      length = :length,
      width = :width,
       SKU = :SKU;";

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':SKU', $newProduct->getSKU(), PDO::PARAM_STR);
    $stmt->bindParam(':name', $newProduct->getName(), PDO::PARAM_STR);
    $stmt->bindParam(':price', $newProduct->getPrice(), PDO::PARAM_STR);
    $stmt->bindParam(':type', $newProduct->getType(), PDO::PARAM_INT);
    $stmt->bindParam(':size', $newProduct->getSize(), PDO::PARAM_INT);
    $stmt->bindParam(':weight', $newProduct->getWeight(), PDO::PARAM_INT);
    $stmt->bindParam(':length', $newProduct->getLength(), PDO::PARAM_INT);
    $stmt->bindParam(':width', $newProduct->getWidth(), PDO::PARAM_INT);
    $stmt->bindParam(':height', $newProduct->getHeight(), PDO::PARAM_INT);

    //   // Execute query
    if ($stmt->execute()) {
      return true;
    }
  }

  // Delete single or multiple but must be in an array
  public function delete($SKU) {
    $query = " DELETE FROM product WHERE product.SKU = :SKU ";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':SKU', $SKU, PDO::PARAM_STR);
    if ($stmt->execute()) {
      return true;
    }
  }
}
