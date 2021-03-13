<?php

use App\QueryBuilder;
use App\Table;
global $router;
require  "../vendor/autoload.php";

$title = "Listing";
$pdo = new PDO("sqlite:../data.db",null,null,[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = new QueryBuilder($pdo);
$query->from("products");
// $query->limit(1);

$tableau = new Table($query, $_GET);
$tableau->setLimit(2);
$tableau->sortable("id");
$tableau->columns([
    "name" => "nom",
    "id" => "idant"
]);
$tableau->format("id", function($value){
    global $router;
    // $router->generate('product' , ["slug" => $value,"id" => $value])
    return "<a href=\"#".$router->generate('product' , ["slug" => $value,"id" => $value])."\">$value</a>";
   
});


echo <<<HTML
    <div class="container border my-3">
HTML;
echo $tableau->render();
echo <<<HTML
    </div>
HTML;

