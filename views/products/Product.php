<?php

use App\App;
use App\Product;

global $router;
//global $match;
dump($match);
$id = $match['params']['id'];
dump($id);
dump($params);

$query = App::getPDO()->prepare("SELECT * FROM products WHERE id = :id");
$query->execute([
    ":id" => $id
]);
$Product = $query->fetchObject(Product::class);
dump ($Product);
if ($Product === false) {
    App::startSession();
    $_SESSION['flash'] = ['danger' =>'page introuvable'];
    header("Location: /", 301);
    exit();
}


?>
<div class="container border rounded py-3 my-3">
    <form action=""method="get">
        <input type="text" name="id" id="id" value="<?= $Product->id ?>">
        <input type="text" name="id" id="id" value="<?= $Product->name ?>">
    </form>
</div>
<div class="container">
    <a class="btn btn-outline-primary" href="<?php echo $router->generate('acceuil');?>"> acceuil</a>
    <a class="btn btn-primary" href="<?php echo $router->generate('list');?>">products</a>
</div>
