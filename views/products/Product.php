<?php

use App\App;
use App\Product;

global $router;

echo "<div class='container'>";
dump($params);
echo "</div>";

$Product = new Product(App::getPDO());
$Product = $Product->getById($params['id']);

$client = $Product->getClient((int)$Product->id);


if ($Product === false) {
    App::startSession();
    $_SESSION['flash'] = ['danger' =>'page introuvable'];
    header("Location: /", 301);
    exit();
}



?>
<div class="container border rounded py-3 my-3">
    <form action=""method="get">
        <div class="container">
            <input type="text" name="id" id="id" value="<?= $Product->id ?>">
            <input type="text" name="id" id="id" value="<?= $Product->name ?>">
            <input type="text" name="id" id="id" value="<?= $client->nom ?>">
        </div>
        <div class="container mt-4">
            <button class="btn btn-primary" type="submit">Soumettre</button>
        </div>
        
    </form>
</div>
<div class="container">
    <a class="btn btn-outline-primary" href="<?php echo $router->generate('acceuil');?>"> acceuil</a>
    <a class="btn btn-primary" href="<?php echo $router->generate('list');?>">products</a>
</div>
