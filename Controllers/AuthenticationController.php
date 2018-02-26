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
                    "message"=>"employee was found succesfully",
                    "employee"=> $employee,
                    "token"=>bin2hex(random_bytes(32))
                ];
            } else {
                $db->close();
                return [
                    "result"=>"failure",
                    "message"=>"employee was not found in the records"
                ];
            }
        } else {
            $db->close();
            return [
                "result" => "failure",
                "message" => "your login details are incorrect or missing"
            ];
        }
    }

    public function register($request)
    {
        $db = Database::connectDB();
        if (
            $request['email'] &&
            $request['password'] &&
            $request['name'] &&
            $request['surname']
        ) {
            $insertSql = "INSERT INTO php_stock_manager.employee
            (name, surname, email, password, created_at, updated_at)
            VALUES ( '".
            $request['name']."', '".
            $request['surname']."', '".
            $request['email']."', '".
            hash('md5', $request['password'])."', '".
            date('Y-m-d H:i:s')."', '".
            date('Y-m-d H:i:s')."')";

            if ($db->query($insertSql)) {
                $selectSql = "select
                name, surname, email, role, created_at, updated_at
                from php_stock_manager.employee
                where email = '".
                $request['email']."' and password = '".
                hash('md5', $request['password'])."'";

                $result = $db->query($selectSql);
                if ($result->num_rows > 0) {
                    $employee = $result->fetch_assoc();
                    $db->close();
                    return [
                        "result"=>"success",
                        "message"=>"employee was succesfully found",
                        "employee"=> $employee,
                        "token"=>bin2hex(random_bytes(32))
                    ];
                } else {
                    $db->close();
                    return [
                        "result"=>"failure",
                        "message"=>"employee details were not found in records"
                    ];
                }
            } else {
                $db->close();
                return [
                    "result"=>"failure",
                    "message"=>"new employee was not created succesfully"
                ];
            }
        } else {
            $db->close();
            return [
                "result" => "failure",
                "message" => "details provided for new employee are incomplete"
            ];
        }
    }
}
