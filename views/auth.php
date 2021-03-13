<?php

use App\App;
use App\Auth;

$auth = new Auth(App::getPDO());
;
$q = $auth->login("admin", "admin");
dump($q);
dump ($q->id);