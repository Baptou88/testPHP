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
<!-- Button trigger modal -->
<div class="container mt-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
    </button>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



   


