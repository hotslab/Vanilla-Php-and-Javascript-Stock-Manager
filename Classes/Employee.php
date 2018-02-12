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

    public function save()
    {
        $db = Database::connectDB();
        $sql = "INSERT INTO MyGuests
        (name, surname, email, role, password, created_at, updated_at)
        VALUES (".
        $this->name.", ".
        $this->surname.", ".
        $this->email.", ".
        $this->role.", ".
        $this->password.", ".
        $this->created_at.", ".
        $this->updated_at.", ".
        ")";

        if (mysqli_query($db, $sql)) {
            $result = "Success";
            $db->close();
            return $result;
        } else {
            $result = "Error: " . $sql . "<br>" . mysqli_error($conn);
            $db->close();
            return $result;
        }
    }
}
