<?php
require_once(ROOT.'/Routing/Routing.php');

use \Routing\Routing as Router;

$url = explode('?', $_SERVER['REQUEST_URI'], 2);
$page = Router::getRoute($url);
require_once($page['route']);
