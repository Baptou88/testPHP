<?php


global $router;

$_SESSION['authid'] = null;
$_SESSION['flash'] = ['success' => 'logout ok'];
header("Location:"  . $router->generate("acceuil"),301);
exit();