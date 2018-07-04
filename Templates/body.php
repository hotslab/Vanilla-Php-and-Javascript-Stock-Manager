<?php
require_once ROOT.'/Routing/Routing.php';
require_once ROOT.'/Routing/ApiRouting.php';

use \Routing\Routing as Router;
use \Routing\ApiRouting as ApiRouter;

$url = explode('?', $_SERVER['REQUEST_URI'], 2);
$method = json_decode(file_get_contents('php://input'), true); // post request for json
$page = null;
if (preg_match("/\bapi\b/i", $url[0])) {
    return ApiRouter::getRoute($url, $method);
} else {
    $page = Router::getRoute($url);
}
if ($page) {
    include_once $page['route'];
}
