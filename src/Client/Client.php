<?php




namespace App\Client;

class Client  
{
    private $pdo;


    public function __construct(\PDO $pdo = null)
    {
        $this->pdo = $pdo;
        
    }

    public function getById($id)
    {
        
        $query = $this->pdo->prepare('SELECT * FROM Clients WHERE id= :id');
        $query->execute([
            ':id' => $id
            ]);
        return $query->fetchObject(__CLASS__) ?? null;
    }
}
