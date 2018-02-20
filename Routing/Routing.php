<?php
namespace Routing;

class Routing
{
    public function getRoute($url)
    {
        switch ($url[0]) {
            case '/':
                return [
                  "header" => null,
                  "route" => ROOT.'/Templates/home.php'
                ];
                break;
            case '/employees':
                return [
                  "header" => null,
                  "route" => ROOT.'/Templates/employees.php'
                ];
                break;
            case '/products':
                return [
                  "header" => null,
                  "route" => ROOT.'/Templates/products.php'
                ];
                break;
            default:
                return [
                  "header" => 'HTTP/1.0 404 Not Found',
                  "route" => ROOT.'/Templates/404.php'
                ];
                break;
        }
    }
}
