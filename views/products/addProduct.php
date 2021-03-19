<?php

use Valitron\Validator;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $v = new Validator($_POST,[],'fr');
    $v->rule('required' , 'name');

    if ($v->validate()) {
        echo "ok!";
    } else {
        dump($v->errors());
    }
}


?>

<div class="container">
    <form   method="POST" class="form">
        <input type="text" name="name" id="n" placeholder="name">
        <button type="submit">valider</button>
    </form>    
</div>