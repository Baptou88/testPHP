<?php

use App\App;
global $router;
if (isset($_GET['Username']) || isset($_GET['Pass']) || isset($_GET['Username'])) {
  if (!isset($_GET['Username']) || $_GET['Username'] == false) {
      
    //$errors[] = ["danger" => "username manquant"] ;
    $errors[] =  "Username manquant" ;
    
  }
  if (!isset($_GET['Pass'])  || $_GET['Pass'] == false ) {
    // $errors[] =  ["danger" => "Pass manquant"];
    $errors[] = "Password manquant";
  }
  if (!isset($_GET['Email']) || $_GET['Email'] == false ) {
    //$errors[] = ["danger" => "email manquant"];
    $errors[] = "Email manquant";
  }

  if (!isset($errors)) {
    echo "ok";
    $token = strRandom(60);
    $query = App::getPDO()->prepare("INSERT INTO Users ( username, password, email, confirmation_token) VALUES ( :u , :p, :e, :t)");
    $query->execute([
      ':u' => $_GET['Username'],
      ':p' => $_GET['Pass'],
      ':e' => $_GET['Email'],
      ':t' => $token
    ]);
    $user_id =  App::getPDO()->lastInsertId();      
    // ini_set("smtp_port","1025");
    $headers = array(
        'From' => 'webmaster@example.com',
        'Reply-To' => 'webmaster@example.com',
        'X-Mailer' => 'PHP/' . phpversion(),
        'Content-Type' => "text/html"
    );
    mail($_GET['Email'], 'Confirmation de compte',"cliquer sur: <a href=\"http://localhost:8001/confirm?id=$user_id&token=$token\">http://localhost/test3/confirm.php?id=$user_id&token=$token</a>", $headers);
    $_SESSION['flash'] = ['success' => "compte créer, un email de confirmation vous a été envoyé à : <strong>" . $_GET['Email'] . "</strong>"];
    header("Location: ". $router->generate("acceuil")  , 301);
    exit;
  } else {
    if ($errors) {
      echo "<div class=\"container\"> ";
      foreach ($errors as  $desc) {
        ?>
        <div class="alert alert-danger">
          <p><?=$desc?></p>
        </div>

        <?php
      }
      echo "</div> ";    
    }
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
    <h1 class="h3 mb-3 fw-normal">Please register</h1>
  </div>
  <label for="inputUsername" class="visually-hidden">Username</label>
  <input type="text" id="inputUsername" class="form-control" name="Username" placeholder="Username" required autofocus>
  <label for="inputEmail" class="visually-hidden">Email address</label>
  <input type="email" id="inputEmail" class="form-control" name="Email" placeholder="Email address" required autofocus>
  <label for="inputPassword"  class="visually-hidden">Password</label>
  <input type="password" id="inputPassword" name="Pass" name="Pass"class="form-control" placeholder="Password" required>
  
  <button class="w-100 btn btn-lg btn-primary" type="submit">Register in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
</form>
</main>
<!-- </div> -->