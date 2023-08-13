<?php

class Product {
    public $SKU;
    public $name;
    public $price;
    public $type;
    public $width = null;
    public $height = null;
    public $length = null;
    public $size = null;
    public $weight = null;

    public function __construct(
        $SKU,
        $name,
        $price,
        $type,
        $width = null,
        $height = null,
        $length = null,
        $size = null,
        $weight = null
    ) {
        $this->SKU = $SKU;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
        $this->size = $size;
        $this->weight = $weight;
    }
    public function getSKU() {
        return $this->SKU;
    }
    public function setSKU($SKU) {
        $this->SKU = $SKU;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price) {
        $this->price = $price;
    }

    public function getType() {
        return $this->type;
    }
    public function setType($type) {
        $this->type = $type;
    }

    public function getWidth() {
        return $this->width;
    }
    public function setWidth($width) {
        $this->width = $width;
    }

    public function getLength() {
        return $this->length;
    }
    public function setLength($length) {
        $this->length = $length;
    }

    public function getHeight() {
        return $this->height;
    }
    public function setHeight($height) {
        $this->height = $height;
    }

    public function getSize() {
        return $this->size;
    }
    public function setSize($size) {
        $this->size = $size;
    }

    public function getWeight() {
        return $this->weight;
    }
    public function setWeight($weight) {
        $this->weight = $weight;
    }
}
