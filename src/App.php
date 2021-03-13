<?php

namespace App;

use PDO;

class App  
{
    public static $auth;
    public static $pdo;

    
    
    public function __construct()
    {
        
    }

    public static function getPDO(): PDO
    {
        if (!self::$pdo) {
            self::$pdo = new PDO("sqlite:../data.db", null, null, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }
    public static function getAuth(): Auth
    {
        if (!self::$auth) {
            self::$auth = new Auth(self::getPDO(), '/login.php');
        }
        return self::$auth;
    }
    
}
