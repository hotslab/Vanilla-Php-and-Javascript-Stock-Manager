<?php
namespace Employee;

define(__ROOT__, dirname(__FILE__), true);
require_once(__ROOT__.'/Config/Database.php');

use Database\Database as Database;

class Employee
{
    public $name;
    public $surname;
    public $email;
    public $role;
    public $password;
    public $created_at;
    public $updated_at;
    private $db;
    private $env;

    public function __construct(
        $new_name,
        $new_surname,
        $new_email,
        $new_role,
        $new_password
    ) {
        $this->name = $new_name;
        $this->surname = $new_surname;
        $this->email = $new_email;
        $this->role = $new_role;
        $this->password = hash('md5', $new_password);
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function getEmployee($employee_id)
    {
        $db = Database::connectDB();
        $sql = "select * from php_stock_manager.employee
        where id = ".$employee_id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();
            return $employee;
        } else {
            return "0 results";
        }
        $conn->close();
    }

    public function save($employee)
    {
        $db = Database::connectDB();
        $searchSql = "select * from php_stock_manager.employee
        where email = '".$employee->email."'";
        $result = $conn->query($searchSql);
        if ($result->num_rows > 0) {
            $db->close();
            return "email address is already taken";
        } else {
            $insertSql = "insert into php_stock_manager.employee
            (name, surname, email, role, password, created_at, updated_at)
            values (".
            "'".$employee->name."', ".
            "'".$employee->surname."', ".
            "'".$employee->email.", ".
            $employee->role.", ".
            "'".$employee->password."', ".
            "'".$employee->created_at."', ".
            "'".$employee->updated_at."'".
            ")";

            if ($db->query($insertSql)) {
                $queryResult = "success";
                $db->close();
                return $queryResult;
            } else {
                $queryResult = "error: " . $insertSql . "<br>" . mysqli_error($db);
                $db->close();
                return $queryResult;
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
                return "success";
            } else {
                $result = "error: " . $sql . "<br>" . mysqli_error($db);
                $db->close();
                return $result;
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
            $result = "success";
            $db->close();
            return $result;
        } else {
            $result = "error: " . $sql . "<br>" . mysqli_error($db);
            $db->close();
            return $result;
        }
    }
}
