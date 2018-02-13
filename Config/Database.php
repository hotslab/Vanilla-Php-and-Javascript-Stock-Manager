<?php
namespace Config;

require_once(ROOT.'/Config/Environment.php');

use Config\Environment as Environment;

class Database
{
    private $env;
    private $db;

    public function connectDB()
    {
        $env = Environment::getEnv();
        $db = new \mysqli(
            $env->host,
            $env->username,
            $env->password,
            $env->database,
            $env->port
        );

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        } else {
            return $db;
        }
    }
}
