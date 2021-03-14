<?php

namespace App\Date;

class Month  
{
    public $days = ['Lundi', 'Mardi', 'Mercredi' , 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months = ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre', 'octobre','Novembre','Decembre'];
    public $month=1;
    public $year=2020;

    /**
     * __construct
     *
     * @param  mixed $month
     * @param  mixed $annee
     * @return void
     * @throws exception
     */
    public function __construct(int $month = null, int $year = null)
    {
        if ($month === null) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }
        if ($month <= 0 || $month > 12) {
            throw new \Exception("le mois passé en paramètre n'est pas valide");
        }
        $this->month = $month;
        $this->year = $year;
    }

    public function toString(): string
    {
        return $this->months[$this->month -1] . " " . $this->year;
    }
    
      
    /**
     * getWeeks
     *
     * @return int
     */
    public function getWeeks(): int
    {
        $start = $this->getFirstDay();
        $end = (clone $start) ->modify('+1 month -1 day');
        
        $weeks =  intval($end->format('W')) - intval($start->format('W')) + 1;
        //dump($end->format('W'), $start->format('W'));
        if ($weeks < 0) {
            $weeks = intval($end->format('W')) +1;
        }
        return $weeks;
    }    
     
    /**
     * renvoi le premier lundi
     *
     * @return DateTime
     */
    public function getFirstDay(): \DateTime
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    public function withinMonth(\DateTime $date): bool
    {
        return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
    }
    public function nextMonth(): Month
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month>12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month,$year);
    }
    public function previousMonth(): Month
    {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month<1) {
            $month = 12;
            $year -= 1;
        }
        return new Month($month,$year);
    }
}

