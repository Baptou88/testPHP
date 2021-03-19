<?php

namespace App\products;

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
    public function getClient($id)
    {
        
        $client = new Client($this->pdo);
        return $client->getById($id) ?? null;

    }
    public function addProduct($data)
    {
        $query = $this->pdo->prepare('INSERT INTO products (name, client) VALUES (:nom , :idclient)');
        $query->execute([
            ':nom' => $data['name'],
            ':idclient' => $data['client']
        ]);
        return $query;
    }
    public function updateProduct($data)
    {
        $query = $this->pdo->prepare('UPDATE products SET name = :nom, client = :idclient WHERE id = :id');
        return $query->execute([
            ':id' => $data['id'],
            ':nom' => $data['name'],
            ':idclient' => $data['client']
        ]);
         
    }
}
