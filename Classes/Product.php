<?php
namespace Product;

define(__ROOT__, dirname(__FILE__), true);
require_once(__ROOT__.'/Config/Environment.php');

use Environment\Environment as Environment;

class Product
{
    public $name;
    public $description;
    public $SKU;
    public $manufacture_code;
    public $price;
    public $quantity;
    public $created_at;
    public $updated_at;

    public function __construct(
        $new_name,
        $new_description,
        $new_SKU,
        $new_manufacture_code,
        $new_price,
        $new_quantity
    ) {
        $this->name = $new_name;
        $this->surname = $new_description;
        $this->email = $new_SKU;
        $this->role = $new_manufacture_code;
        $this->price = $new_price;
        $this->new_quantity = $new_quantity;
        $this->new_created_at = date('Y-m-d H:i:s');
        $this->new_updated_at = date('Y-m-d H:i:s');
    }
}
