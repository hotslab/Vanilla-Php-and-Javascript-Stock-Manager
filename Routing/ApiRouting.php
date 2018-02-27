<?php
namespace Routing;

require_once(ROOT.'/Controllers/AuthenticationController.php');
require_once(ROOT.'/Controllers/EmployeeController.php');
require_once(ROOT.'/Controllers/ProductController.php');

use \Controller\AuthenticationController as Auth;
use \Controller\EmployeeController as Employee;
use \Controller\ProductController as Product;

class ApiRouting
{
    public function getRoute($url, $params)
    {
        header("Content-Type: application/json");
        if ($url[0] === "/api/login") {
            echo json_encode(Auth::login($params));
        } elseif ($url[0] === "/api/register") {
            echo json_encode(Auth::register($params));
        } elseif ($url[0] === "/api/employees") {
            echo json_encode(Employee::getEmployees());
        } elseif ($url[0] === "/api/products") {
            echo json_encode(Product::getProducts());
        } elseif ($url[0] === "/api/products/create") {
            echo json_encode(Product::save($params));
        }
    }
}
