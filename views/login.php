<?php

use App\App;
use App\Auth;

require "../config.php";
$title = "login";

if (isset($_GET['Pass']) && isset($_GET['Email'])) {
    echo "<div class=\"container\">
        <div class=\"alert alert-primary\" >
        J'ai des infos: " . htmlentities($_GET['Email'] ) . " - " . htmlentities($_GET['Pass'] )  .
        "</div></div>
    ";
    
    $auth = new Auth(App::getPDO());
    $auth = $auth->login($_GET['Email'],$_GET['Pass']);
    dump ($auth);
    if ($auth === null) {
        echo "
        <div class=\"alert alert-danger\" >
        Auth Fail
        </div>
    ";
    }  else {
        echo "
        <div class=\"alert alert-success\" >
        Auth success
        </div>
    ";
        App::startSession();
        
        $_SESSION['authid'] = $auth->id;
        dump($_SESSION);
        $_SESSION['flash'] = ['success' => 'auth ok'];
        header("Location: /account",301);
    }
} 
?>
<style>
/* html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
} */

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<!-- <div class="container text-center my-4 w-70"> -->
<main class="form-signin">
<form>
  <div class="text-center">
    <img class="mb-4 " src="https://via.placeholder.com/72x57" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
  </div>
  <label for="inputEmail" class="visually-hidden">Email address</label>
  <input type="email" id="inputEmail" class="form-control" name="Email" placeholder="Email address" required autofocus>
  <label for="inputPassword"  class="visually-hidden">Password</label>
  <input type="password" id="inputPassword" name="Pass" name="Pass"class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3"> 
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
</form>
</main>

<div class="container">
    <h1>Connexion via Google</h1>
    <h3><?=GOOGLE_ID?></h3>
    <a class="btn btn-outline-success" href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&response_type=code&state=state_parameter_passthrough_value&redirect_uri=<?=urldecode("http://localhost:8001/Goauth")?>&client_id=<?= GOOGLE_ID ?>">Se connecter via Google</a>
    <a class="btn btn-outline-danger" href="https://accounts.google.com/Logout?hl=fr&continue=localhost:3001&timeStmp=1615731000">Se deconnecter via Google</a>
    <!-- https://accounts.google.com/Logout?hl=fr&continue=https://www.google.com/%3Fgws_rd%3Dssl&timeStmp=1615731000&secTok=.AG5fkS8C2cmrq2TScA3atKZYxoi-zIK_4w&ec=GAdAmgQ -->

</div>
<!-- </div> -->