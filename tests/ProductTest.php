<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase  
{
    public function getBuilder(): \App\Product
    {
        $pdo = new PDO("sqlite::memory:",null,null,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->query('CREATE TABLE products (
    id INTEGER  primary key,
    name TEXT,
    client INTEGER)'
    );
        for ($i = 1; $i <= 10; $i++) {
            $pdo->exec("INSERT INTO products (name, client) VALUES ('product $i', $i );");
        }
        return new \App\Product($pdo);
    }
    public function testfindProduct()
    {
        $q = $this->getBuilder()->getById(1);
        $this->assertEquals(1,$q->id);
    }
}
