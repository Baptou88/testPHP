<?php

use App\App;
$title = "Auth Google";

App::startSession();
use GuzzleHttp\Client;

require "../config.php";

dump($_GET);

if (!isset($_GET['code'])) {
    $_SESSION['flash'] = ['danger' =>'interdiction d\'acceder à cette section'];
    header("Location: /",301);
    exit();
}
$client = new Client([
    'timeout' => 2.0,
    'verify' => __DIR__ ."/../cacert.pem"
]);
try {
    $reponse = $client->request("GET","https://accounts.google.com/.well-known/openid-configuration");
    $discoveryJson = json_decode($reponse->getBody());
    $tokenEndpoint = $discoveryJson->token_endpoint;
    $userinfoEndpoint = $discoveryJson->userinfo_endpoint;
    
    $reponse = $client->request("POST", $tokenEndpoint , [
        'form_params' => [
            'code' => $_GET['code'],
            'client_id' => GOOGLE_ID,
            'client_secret' => GOOGLE_SECRET,
            'redirect_uri' => 'http://localhost:8001/Goauth',
            'grant_type' => 'authorization_code'
        ]
    ]);
    $accessToken = json_decode($reponse->getBody())->access_token;
    dump($accessToken);
 
    $reponse = $client->request('GET' , $userinfoEndpoint,[
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken
        ]
    ]);
    dump($reponse);
    
    $reponse = json_decode($reponse->getBody());
    dump($reponse);
    if ($reponse->email_verified!== true) {
        $_SESSION['flash'] = ['danger' => 'Compte pas vérifié'];
        header("Location: /login",301);
    }
    else {
        $_SESSION['flash'] = ['success' => 'compte ok -> ' . $reponse->email];
    }
} catch (\GuzzleHttp\Exception\ClientException $th) {
    dump("catch");
    dump($th->getMessage());
    $_SESSION['flash'] = ['danger' => $th->getMessage()];
    header("Location: /login",301);
}

