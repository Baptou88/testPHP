<?php

use App\App;
use App\QueryBuilder;
App::startSession();
global $router;
if (!isset($_GET['id']) && !isset($_GET['token'])) {
    
    $_SESSION['flash'] = ['danger' => 'interdiction d\' acceder à cette section'];
    header("Location: /",301);

}

$id = (int)$_GET['id'];
$token = $_GET['token'];

$query = new QueryBuilder(App::getPDO());
$query->from("Users")
    ->where("id = :id")
    ->setParam(":id",(int)$_GET['id']);

$user = $query->fetchFirst();
dump($user);

if ($user == null) {
    $_SESSION['flash'] = ['danger' => 'lien incorrect'];
    var_dump("lien incorrect");
    //header("Location: /",301);
    exit();
}

if ($user['confirmation_token'] === null) {
    $_SESSION['flash'] = ['danger' => 'compte déja verivié'];
    var_dump("compte deja verifié");
    //header("Location: /",301);

}elseif ($user['confirmation_token'] === $token) {
    $query = App::getPDO()->prepare("UPDATE Users SET confirmation_token = null, confirmed_at = strftime('%Y-%m-%d %H-%M-%S','now') WHERE id= :id");
    $query->execute([
        ':id' => $id
    ]);
    App::startSession();
    $_SESSION['flash'] = ['success' => "compte Vériié"];
    header("Location: ". $router->generate("account")  , 301);
    exit;
}
