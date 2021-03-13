<?php
http_response_code ( 404 );
global $router;
?>
<div class="container">
    <div class="alert alert-danger my-4" role="alert">
    <h1>404 Not Found 😒</h1>
    <p><a href=" <?= $router->generate('acceuil') ?> ">acceuil</a></p>
    </div>
</div>



