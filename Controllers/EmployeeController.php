<?php
namespace Controller;

require_once(ROOT.'/Config/Database.php');

use Config\Database as Database;

class EmployeeController
{
    public function getEmployees() {
        $db = Database::connectDB();
        $sql = "select * from php_stock_manager.employee";
        $result = $db->query($sql);
        $employees = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($employees, $row);
            }
            $db->close();
            return [
                "result"=> "success",
                "message"=> "employees found successfuly",
                "employees"=> $employees
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "employee not found",
                "employees"=> $employees
            ];
        }
    }

    public function getEmployee($employee_id)
    {
        $db = Database::connectDB();
        $sql = "select * from php_stock_manager.employee
        where id = ".$employee_id;
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $db->close();
            return [
                "result"=> "success",
                "message"=> "employee found successfuly",
                "employee"=> $result->fetch_assoc()
            ];
        } else {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "employee not found"
            ];
        }
    }

    public function save($employee)
    {
        $db = Database::connectDB();
        $searchSql = "select * from php_stock_manager.employee
        where email = '".$employee->email."'";
        $result = $db->query($searchSql);
        if ($result->num_rows > 0) {
            $db->close();
            return [
                "result"=> "failure",
                "message"=> "email address is already taken"
            ];
        } else {
            $insertSql = "insert into php_stock_manager.employee
            (name, surname, email, role, password, created_at, updated_at)
            values (".
            "'".$employee->name."', ".
            "'".$employee->surname."', ".
            "'".$employee->email."', ".
            $employee->role.", ".
            "'".hash('md5', $employee->password)."', ".
            "'".$employee->created_at."', ".
            "'".$employee->updated_at."'".
            ")";

            if ($db->query($insertSql)) {
                $db->close();
                return [
                    "result"=> "success",
                    "message"=> "employee saved successfuly"
                ];
            } else {
                $db->close();
                return [
                    "result"=> "failure",
                    "message"=> "error: " . $insertSql . "<br>" . $db->error
                ];
            }
        }
    }

    public function update($employee)
    {
        $db = Database::connectDB();
        if (
            $employee->name ||
            $employee->surname ||
            $employee->email ||
            $employee->role ||
            $employee->password
        ) {
            $sql = "update php_stock_manager.employee set ".
            (!$employee->name ? : "name = '".$employee->name."', ")."".
            (!$employee->surname ? : "surname = '".$employee->surname."', ")."".
            (!$employee->email ? : "email = '".$employee->email."', ")."".
            (!$employee->role ? : "role = '".$employee->role.", ")."".
            (!$employee->password ? : "password = '".hash('md5', $employee->password)."', ")."".
            "updated_at = '".date('Y-m-d H:i:s')."' ".
            "where id = ".$employee->id;

            if ($db->query($sql)) {
                $db->close();
                return [
                    "result"=> "success",
                    "message"=> "employee updated succesfully"
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

    public function delete($employee_id)
    {
        $db = Database::connectDB();
        $sql = "delete from php_stock_manager.employee where id = ".$employee_id;
        if ($db->query($sql)) {
            $db->close();
            return [
                "result"=> "success",
                "message"=> "employee deleted succesfully"
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
