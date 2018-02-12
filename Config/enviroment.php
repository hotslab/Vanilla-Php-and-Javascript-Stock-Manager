<?php
namespace Config;

class Environment
{
    public function getEnv()
    {
        $environment = new \stdClass;
        $environment->host = '127.0.0.1';
        $environment->username = root;
        $environment->password = 'joseph';
        $environment->database = 'php_stock_manager';
        $environment->port = 3306;
    }
}
