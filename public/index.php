<?php

use App\Router;

require  "../vendor/autoload.php";

define('DEBUG_TIME',microtime(true));
$uri = $_SERVER['REQUEST_URI'];

$whoops = new \Whoops\run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$router = new Router(dirname(__DIR__) . "/views",);

$router->get("/", "main","acceuil")
    ->get("/LProducts","products/LProducts","list")
    ->get("/Product/[*:slug]-[i:id]","product","product")
    ->get("/auth","auth","auth")
    ->get("/login","login","login")
    ->run();
    
    

