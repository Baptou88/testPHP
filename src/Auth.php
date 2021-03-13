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
}


