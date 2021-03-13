<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {
    public function getBuilder(): \App\Auth
    {
        $pdo = new PDO("sqlite::memory:",null,null,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->query('CREATE TABLE Users (
    id INTEGER  primary key,
    username TEXT,
    password TEXT,
    email TEXT)');
        for ($i = 1; $i <= 10; $i++) {
            $pdo->exec("INSERT INTO Users (username, password, email) VALUES ('User $i', 'pass $i', 'email $i');");
        }
        return new \App\Auth($pdo);
    }

    public function testFindUser()
    {
        $q = $this->getBuilder()->login("User 1", "pass 1");
        $this->assertEquals(1,$q->id);
        $this->assertEquals("pass 1",$q->password);
    }

    public function testNotFindUser()
    {
        $q = $this->getBuilder()->login("User ", "pass 1");
        $this->assertNull($q);

        $q = $this->getBuilder()->login("User 1", "pass ");
        $this->assertNull($q);
    }
    // public function testUserWithGoodPass()
    // {
    //     $q = $this->getBuilder()->login("User 1", "pass 1");
    //     $this->assertIsObject($q);
    // }
}