<?php
namespace Routing;

require_once(ROOT.'/Controllers/AuthenticationController.php');
require_once(ROOT.'/Controllers/EmployeeController.php');

use \Controller\AuthenticationController as Auth;
use \Controller\EmployeeController as Employee;

class ApiRouting
{
    public function getRoute($url, $method)
    {
        header("Content-Type: application/json");
        if ($url[0] === "/api/login") {
            echo json_encode(Auth::login($method));
        } else if ($url[0] === "/api/register") {
            echo json_encode(Auth::register($method));
        } else if ($url[0] === "/api/employees") {
            echo json_encode(Employee::getEmployees());
        }
    }
}
