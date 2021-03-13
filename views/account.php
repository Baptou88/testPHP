<?php

use App\App;
App::startSession();
$user = App::getAuth()->getUser($_SESSION);
//dump($user);
if ($user === null) {
    $_SESSION['flash'] = ["danger" => "interdiction d'atteindre cette section"];
    header("Location: /",301);
    exit;
}
if (isset($_SESSION['flash']) && $_SESSION['flash'] !== null) {
    $errors = $_SESSION['flash'];
    echo "<div class=\"container\">";
    foreach ($errors as $status =>$desc) {
        ?>
            <div class="alert alert-<?=$status?>">
                <p><?=$desc?></p>

            </div>

        <?php
    }
    $_SESSION['flash'] = null;
    echo "</div>";
}
?>
<div class="container mt-3">
<h1>Account</h1>
<div class="container text-center border py-2">
    <form>
    <div class="row mb-3">
        <div class="col-auto">
            <label for="Email" class="form-label">Email address</label>
            <input type="text" class="form-control" name="Email" value="<?=$user->email?>" placeholder="Email"></input>
        </div>
        <div class="col-auto ">
            <label for="Username" class="form-label">Username</label>
            <input type="text" class="form-control" name="Username" value="<?=$user->username?>" placeholder="Username"></input>

        </div>
    </div>
    <dic class="row">
    <fieldset class="mb-3" disabled>
        <input type="text" class="form-control" value="<?=$user->confirmed_at?>">
    </fieldset>
        
    </dic>
    <div class="mb-4">
        <button class="btn btn-primary" type="submit">submit</button>
        <button class="btn btn-outline-warning" type="submit">submit</button>
    </div>
        
    </form>
</div>
</div>



   


