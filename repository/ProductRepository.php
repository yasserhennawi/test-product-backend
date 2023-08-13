<?php

abstract class ProductRepository {
    abstract public function getAll(): array;
    abstract public function create(Product $product);
    abstract public function delete($SKU);
}
