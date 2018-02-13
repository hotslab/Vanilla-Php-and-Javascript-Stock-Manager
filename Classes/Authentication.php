<?php
namespace Authentication;

define(__ROOT__, dirname(__FILE__), true);
require_once(__ROOT__.'/Config/Database.php');

use Database\Database as Database;

class Authentication
{
    public function login($credentials) {
        $db = Database::connectDB();
        if (
            $credentials->email &&
            $credentials->password
        ) {
            $sql = "select * from php_stock_manager.employee
            where email = '".$credentials->email."' and ".
            "password = '".hash('md5', $credentials->password);
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $employee = $result->fetch_assoc();
                $db->close();
                return [
                    "result"=>"success",
                    "message"=>"employee found sucsessfully",
                    "employee"=> $employee,
                    "token"=>md5(time() . mt_rand())
                ];
            } else {
                $db->close();
                return [
                    "result"=>"failure",
                    "message"=>"employee not found"
                ];
            }
        } else {
            $db->close();
            return [
                "result" => "failure",
                "message" => "please add your credentials correctly"
            ];
        }
    }
}
