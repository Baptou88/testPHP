<?php
namespace App\Calendrier;

use App\Date\Month;

class Calendrier  
{
    private $month;

        
    /**
     * __construct
     *
     * @param  mixed $month
     * @return void
     */
    public function __construct(Month $month )  
    {
       $this->month = $month;
    }
    
    public function render()
    {
        return "";
    }

}
