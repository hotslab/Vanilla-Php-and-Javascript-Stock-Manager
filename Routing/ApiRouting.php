<?php
namespace Routing;

require_once(ROOT.'/Controllers/AuthenticationController.php');

use \Controller\AuthenticationController as Auth;

class ApiRouting
{
    public function getRoute($url, $method)
    {
        header("Content-Type: application/json");
        if ($url[0] === "/api/login") {
            $response = Auth::login(json_decode(stripslashes($method)));
            echo json_encode($response);
        }
    }
}
