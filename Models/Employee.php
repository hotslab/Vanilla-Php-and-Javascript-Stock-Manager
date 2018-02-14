<?php
namespace Model;

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
}
