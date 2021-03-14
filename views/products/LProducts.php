<?php

use App\QueryBuilder;
use App\Table;
use App\URLHelper;

global $router;
require  "../vendor/autoload.php";

$title = "Listing";
$pdo = new PDO("sqlite:../data.db",null,null,[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
// $nombre = (int)$_GET['n'] ?? 3;
if ( isset($_GET['n']) ) {
    $nombre = (int)$_GET['n'];
    if ($nombre <= 0) {
        $nombre = 4;
    }
    
}else {
    $nombre = 4;
}
$query = new QueryBuilder($pdo);
$query->from("products");
// $query->limit(1);

$tableau = new Table($query, $_GET);
$tableau->setLimit($nombre);
$tableau->sortable("id");
$tableau->columns([
    "name" => "nom",
    "id" => "idant"
]);
$tableau->format("id", function($value){
    global $router;
    // $router->generate('product' , ["slug" => $value,"id" => $value])
    return "<a class=\" \" href=\"".$router->generate('product' , ["slug" => $value,"id" => $value])."\">$value</a>";
   
});


echo <<<HTML
    <div class="container border my-3">
HTML;
echo $tableau->render();
echo <<<HTML
    </div>
HTML;

?>
<div class="container">

    <form method="GET" action="">
        <label for="limit">Choose a limit:</label>
        <select id="limit" name="n" class="form-select" aria-label="Default select example">
            <option selected><?=isset($_GET['n'])? $_GET['n'] : 4 ?></option>
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="6">6</option>
        </select>
        <button  class="btn btn-primary" type="submit">Valider</button>
    </form>
    <?= $_GET['n']?? 0?>
</div>

