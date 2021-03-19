<?php

use App\App;
use App\HTML\Form;
use App\products\Product;
use App\QueryBuilder;
use Valitron\Validator;


global $router;
$title = "Product";

echo "<div class='container'>";
dump($params);
echo "</div>";

App::startSession();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    dump($_FILES);
    $v = new Validator($_POST,[],'fr');
    $v->rule('required', 'name')
        ->rule('numeric',['client']);
    if ($v->validate()) {
        //dump("ok");
        $Product = new Product(App::getPDO());
        $retour = $Product->updateProduct($_POST);
        dump($retour);
        $_SESSION['flash'] = ['success'=> 'Enregistré'];
        // header("Location: " . $router->generate("product",[
        //     "slug" => $_POST['name'],
        //     "id" =>$_POST['id']
        // ]) ,301);
    } else {
        
        dump($v->errors());
        echo "<div class=\"container\"><div class=\" alert alert-danger\">";
        foreach ($v->errors() as $error ) {
            foreach ($error as $erro ) {
                echo $erro;
            } 
        }
        echo "</div></div>";
    }

}

$Product = new Product(App::getPDO());
$Product = $Product->getById($params['id']);

$client = $Product->getClient((int)$Product->client);
$clients = new QueryBuilder(App::getPDO());
$clients->from("Clients");
$clients = $clients->fetchAll();


if ($Product === false) {
    
    $_SESSION['flash'] = ['danger' => 'page introuvable'];
    header("Location: /", 301);
    exit();
} else
{
    
}

if (isset($_SESSION['flash']) ) {
    $errors = $_SESSION['flash'];
    ?>
    <div class="container">
    <?php
    foreach ($errors as $status =>$desc) {
        ?>
            <div class="alert alert-<?=$status?>">
                <p><?=$desc?></p>

            </div>

        <?php
    }
    ?>
    </div>
    <?php
    $_SESSION['flash'] = null;
}

?>
<div class="container border rounded py-3 my-3">
    <form  method="POST" enctype="multipart/form-data">
        <div class="container ">
            <div class="row mt-3">
                <div class="col form-floating">
                    <input class="form-control" type="text" placeholder="Idantifiant" name="id" id="id" value="<?= $Product->id ?>">
                    <label for="id" >ID</label>
                </div> 

                <div class="col input-group">
                    <span class="input-group-text">name</span>
                    <!-- <label for="name">name</label> -->
                    <input class="form-control" type="text" name="name" id="name" value="<?= $Product->name ?>">


                </div>      

            </div>
            <div class="row form-floating my-3">
            
                <select name="client" id="client" class="form-select">
                    <option value="<?= $client->id ?? 0 ?>"><?= $client->nom ?? null ?></option>
                    <?php foreach ($clients as $cli ) :
                    if(($cli['id'] ?? null) !== $client->id ):?>
                        <option value="<?= $cli['id'] ?>"><?= $cli['nom'] ?></option>
                    <?php endif;
                        endforeach; ?>
                
            
                </select>
                <label for="client">client</label>
            </div>
            <div class="row">
                <input type="file" name="file" id="file">
            </div>
        </div>
        <div class="border container mt-4">
            <button class="btn btn-outline-primary" type="submit">Soumettre</button>
            <a href="<?= $router->generate("list")?>" class="btn btn-outline-warning">Annuler changement</a>
        </div>
        
    </form>
</div>
<div class="container border form-floating py-4">
   <?php
        echo Form::textinput("er",$Product->name,"er");
   ?>
</div>
<div class="container">
    <a class="btn btn-outline-primary" href="<?php echo $router->generate('acceuil');?>"> acceuil</a>
    <a class="btn btn-primary" href="<?php echo $router->generate('list');?>">products</a>
</div>
<script>
allowClose = true


    document.onbeforeunload = function (e){
        if (allowClose) {
            console.log (e)
            prompt("ignorer sauvegarde?", "err")
            if (prompt("ignorer sauvegarde?", "err")) {
                alert("ignorer")
            } else {
               alert("sauvegarde") 
            }
            
        }
    }
    

    function fermeture(event) {
        
    }

</script>
