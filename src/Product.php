<?php

namespace App;

use App\Client\Client;
use PDO;

class Product  
{
    public $id;

    public $name;

    private $pdo;
    public $client;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getById(int $id): self
    {
        
        $query = $this->pdo->prepare('SELECT * FROM products WHERE id= :id');
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetchObject(__CLASS__,['pdo'=>$this->pdo]);
    }
    public function getClient($id): ?Client
    {
        
        $client = new Client($this->pdo);
        return $client->getById($id);

    }
}
