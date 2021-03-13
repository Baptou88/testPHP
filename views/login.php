<?php

use App\App;
use App\Auth;


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
        session_start();
        $_SESSION['auth'] = $auth;
        dump($_SESSION);
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
</div>

  <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
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
<!-- </div> -->