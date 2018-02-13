<?php
namespace Product;

require_once(ROOT.'/Config/Database.php');

use Config\Database as Database;

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

    public function getProduct($product_id)
    {
        $db = Database::connectDB();
        $sql = "select * from php_stock_manager.product
        where id = ".$product_id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $db->close();
            return [
                "result"=> "success",
                "message"=> "employee not found",
                "product"=> $result->fetch_assoc()
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "product not found"
            ];
        }
    }

    public function save($product)
    {
        $db = Database::connectDB();
        $sql = "INSERT INTO php_stock_manager.product
        (name, description, SKU, manufacture_code, price, quantity, created_at, updated_at)
        VALUES (".
        "'".$product->name."', ".
        "'".$product->decription."', ".
        "'".$product->SKU.", ".
        "'".$product->manufacture_code."', ".
        $product->price.", ".
        $product->quantity.", ".
        "'".$product->created_at."', ".
        "'".$product->updated_at."'".
        ")";

        if ($db->query($sql)) {
            $db->close();
            return [
                "result"=> "success",
                "message"=> "product saved successfuly"
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "error: " . $sql . "<br>" . $db->error
            ];
        }
    }

    public function update($product)
    {
        $db = Database::connectDB();
        if (
            $product->name ||
            $product->description ||
            $product->SKU ||
            $product->manufacture_code ||
            $product->price ||
            $product->quantity
        ) {
            $sql = "update php_stock_manager.employee set ".
            (!$product->name ? : "name = '".$product->name."', ")."".
            (!$product->$description ? : "$description = '".$product->description."', ")."".
            (!$product->SKU ? : "SKU = '".$product->SKU."', ")."".
            (!$product->manufacture_code ? : "manufacture_code = '".$product->manufacture_code.", ")."".
            (!$product->price ? : "price = ".$product->price.", ")."".
            (!$product->quantity ? : "quantity = ".$product->quantity.", ")."".
            "updated_at = '".date('Y-m-d H:i:s')."' ".
            "where id = ".$product->id;

            if ($db->query($sql)) {
                $db->close();
                return [
                    "result"=> "success",
                    "message"=> "product updated successfuly"
                ];
            } else {
                $db->close();
                return [
                    "result"=> "failure",
                    "message"=> "error: " . $sql . "<br>" . $db->error
                ];
            }
        } else {
            $db->close();
        }
    }

    public function delete($product_id)
    {
        $db = Database::connectDB();
        $sql = "delete from php_stock_manager.product where id = ".$product_id;
        if ($db->query($sql)) {
            $db->close();
            return [
                "result"=> "success",
                "message"=> "product deleted successfuly"
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "error: " . $sql . "<br>" . $db->error
            ];
        }
    }
}
