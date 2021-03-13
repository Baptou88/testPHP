<?php

use App\App;

$title = "main";
global $router;

App::startSession();


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

<div class="container ">
    <h1>BONJOUR</h1>
    <div class="card my-4">
        <h2>bonjour</h2>
    </div>
    <div class="card my-4">
        <h2>bonjour2</h2>
    </div>
    <div class="card my-4">
        <h2>bonjour2</h2>
    </div>
</div>
