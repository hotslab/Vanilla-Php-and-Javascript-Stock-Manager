<?php
namespace Controller;

require_once(ROOT.'/Config/Database.php');

use Config\Database as Database;

class AuthenticationController
{
    public function login($request)
    {
        $db = Database::connectDB();
        if (
            $request['email'] &&
            $request['password']
        ) {
            $sql = "select
            name, surname, email, role, created_at, updated_at
            from php_stock_manager.employee
            where email = '".$request['email']."' and ".
            "password = '".hash('md5', $request['password'])."'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $employee = $result->fetch_assoc();
                $db->close();
                return [
                    "result"=>"success",
                    "message"=>"employee found",
                    "employee"=> $employee,
                    "token"=>bin2hex(random_bytes(32))
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
                "message" => "Your login details are incorrect"
            ];
        }
    }
}
