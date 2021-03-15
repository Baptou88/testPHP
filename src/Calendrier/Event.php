<?php
namespace App\Calendrier;

class Event  
{
    public $id;
    public $start;

    public function __construct()
    {
        
    }
    public function getStart(): \DateTimeInterface 
    {
        return new \DateTimeImmutable($this->start);
    }

}
