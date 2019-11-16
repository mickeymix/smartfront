<?php
class product {

    public $prodId;
    public $prodName;
    public $prodQuantity;

    public function __construct($prodId, $prodName, $prodPrice) {
        $this->prodId    = $prodId;
        $this->prodName  = $prodName;
        $this->prodQuantity = $prodPrice;
    }

    public function get_prodId() {
        return $this->prodId;
    }

    public function get_prodName() {
        return $this->prodName;
    }

    public function get_prodQTY() {
        return $this->prodQuantity;
    }
}
?>