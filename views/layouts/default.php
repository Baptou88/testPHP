<?php

use App\App;

global $router;
  
?><!DOCTYPE html>
<html class ="h-100 no-touch" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <title><?= $title ?? "Titre default "?></title>
</head>
<body class="flex-shrink-0 d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href=" <?= $router->generate('acceuil') ?> ">tests</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href=" <?=$router->generate('list')?>">Product</a>
        </li>
        <?php
          if (isset($_SESSION['authid']) && $_SESSION['authid'] !== null) {
            ?>
            <li class="nav-item">
          <a class="nav-link" href=" <?=$router->generate('logout')?>">Hello <?=App::getAuth()->getUser($_SESSION)->username?> | logout</a>
        </li>
        <?php
          }else {
            ?>
              <li class="nav-item">
          <a class="nav-link" href=" <?=$router->generate('login')?>">login</a>
        </li>
            <?php
          }
        ?>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <?php
 
    echo $content;
    ?>

    <footer class="footer mt-auto pt-2 bg-secondary">
        <div class="container">
            <p>Page génerer en <?=round((microtime(true) - DEBUG_TIME) * 1000) ?> ms</p>
        </div>
    </footer>
</body>
</html>