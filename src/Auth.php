<?php

namespace App;

use PDO;

class Auth  
{
    private PDO $PDO;

    public function __construct(?PDO $PDO = null)
    {
        $this->PDO = $PDO;
    }

    public function login(string $username , string $password): ?User
    {
        // $query =new QueryBuilder($this->PDO);
        // $query->from("Users")
        //     ->where("username = :u")
        //     ->setParam("u",$username);
        //dump($query->toSQL());

        $query = $this->PDO->prepare("SELECT * FROM Users Where username= :username OR email=:username");
        $query->execute([
            "username" => $username
            ]);
        $user = $query->fetchObject(User::class);
        
        if ($user === false) {
            return null;    
        }

        if ($password !== $user->password) {
            return null;
        }
        return $user ?: null;
        
    }
    public function isLogged(array $session): bool
    {
        App::startSession();
        if (isset($session['authid']) && $session['authid']!== null ) {
            return true;
        }
        return false;
    }
    public function getUser(array $session): ?User
    {
        if (!$this->isLogged($session)) {
            return null;
        }
        $query = $this->PDO->prepare("SELECT * FROM Users WHERE id = :id");
        $query->execute([
            "id"=>$session['authid']
            ]);
        $user = $query->fetchObject (User::class);
        

        return $user;
    }
}


