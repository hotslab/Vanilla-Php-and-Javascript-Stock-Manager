<?php
namespace Controller;

require_once(ROOT.'/Config/Database.php');

use Config\Database as Database;

class ProductController
{
    public function getProducts()
    {
        $db = Database::connectDB();
        $products = array();
        $sql = "select * from php_stock_manager.product";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($products, $row);
            }
            $db->close();
            return [
                "result"=> "success",
                "message"=> "products successfully found",
                "products"=> $products
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "no products not found",
                "products"=> $products
            ];
        }
    }

    public function getProduct($product_id)
    {
        $db = Database::connectDB();
        $sql = "select * from php_stock_manager.product
        where id = ".$product_id;
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $db->close();
            return [
                "result"=> "success",
                "message"=> "product successfully found",
                "product"=> $result->fetch_assoc()
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "product not found",
                "product"=> null
            ];
        }
    }

    public function save($request)
    {
        $db = Database::connectDB();
        $sql = "INSERT INTO php_stock_manager.product
        (name, description, SKU, manufacture_code, price, quantity, created_at, updated_at)
        VALUES (".
        "'".$request['name']."', ".
        "'".$request['description']."', ".
        "'".$request['SKU']."', ".
        "'".$request['manufacture_code']."', ".
        $request['price'].", ".
        $request['quantity'].", ".
        "'".date('Y-m-d H:i:s')."', ".
        "'".date('Y-m-d H:i:s')."'".
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
