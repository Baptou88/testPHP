<?php

use App\App;
use App\Router;

require  "../vendor/autoload.php";

define('DEBUG_TIME',microtime(true));
$uri = $_SERVER['REQUEST_URI'];

$whoops = new \Whoops\run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

App::startSession();

$router = new Router(dirname(__DIR__) . "/views",);

$router->get("/", "main","acceuil")
    ->get("/LProducts","products/LProducts","list")
    ->get("/Product/[*:slug]-[i:id]","products/Product","product")
    ->post("/Product/[*:slug]-[i:id]","products/Product","")
    ->get("/Product/add","/products/addProduct","addProduct")
    ->post("/Product/add","/products/addProduct","newProduct")
    ->get("/auth","auth","auth")
    ->get("/login","login","login")
    ->get("/logout","logout","logout")
    ->get("/account","account","account")
    ->get("/register", "register","register")
    ->get("/confirm","confirm","confirm")
    ->get("/googlelogin","googlelogin","googlelogin")
    ->get("/Goauth","Goauth","")
    ->get("/cal","calendrier/calendrier","cal")
    ->get("/cal/Event/[*:slug]-[i:id]","calendrier/event","calEvent")
    ->run();
    
    


