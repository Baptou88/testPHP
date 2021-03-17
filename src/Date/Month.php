<?php

namespace App\Date;

class Month  
{
    public $days = ['Lundi', 'Mardi', 'Mercredi' , 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months = ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre', 'Octobre','Novembre','Decembre'];
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
        
        $end = (clone $start)->modify('+1 month -1 day');
        //dump($end);
        if ($end->format('N') !== '7' ) {
            $end->modify('next sunday');
        }
        //dump($end);
        $startWeek = intval($start->format('W'));
        $endWeek = intval($end->format('W'));
        //dump($endWeek,$startWeek);
        if ($endWeek === 1) {
            $endWeek = intval($end->modify('- 7 days')->format('W')) + 1;
        }
        $weeks = $endWeek - $startWeek + 1;

        
        if ($weeks < 0) {
            $weeks = intval($end->format('W')) +1;
        }
        
        return $weeks +0;
    }  
   
     
    /**
     * 
     *
     * @return DateTime
     */
    public function getFirstDay(): \DateTime
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    public function getLastDay(): \DateTime
    {
        $days = 6 + 7 * ($this->getWeeks()-1);
        $start = $this->getFirstMonday();
        $fin = (clone $start)->modify('+ ' . $days . ' days');
        return  $fin;
    }
    public function getFirstMonday():\DateTime
    {
        $start = (clone $this)->getfirstDay();
        $start ->format('N') === '1' ? $start : $start->modify('last monday');
        return $start;
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

