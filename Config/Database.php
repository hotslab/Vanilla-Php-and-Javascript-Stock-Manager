<?php
namespace Config;

define(__ROOT__, dirname(__FILE__), true);
require_once(__ROOT__.'/Config/Environment.php');

use Environment\Environment as Environment;

class Database {

    private $env;
    private $db;

    public function connectDB()
    {
        $env = Environment::getEnv();
        $db = new mysqli_connect(
            $env->host,
            $env->username,
            $env->password,
            $environment->database,
            $env->port
        );

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        } else {
            return $db;
        }
    }
}
