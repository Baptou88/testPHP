<?php
namespace App\Calendrier;

class Calendrier  
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;

    }
    public function getEventsBetween(\DateTime $start, \DateTime $end): array
    {
        dump($start->format('d-m-y'),$end->format('d-m-y'));
        $query = $this->pdo->prepare("SELECT * FROM Events WHERE start BETWEEN :s AND :e");
//WHERE start BETWEEN :s AND :e
        $query->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $query->execute([
            ':s' => $start->format('Y-m-d 00:00:00'),
            ':e' => $end->format('Y-m-d 23:59:59')
        ]);
        $results = $query->fetchAll();
        return $results;
    }
    public function getEventsBetweenByDay (\DateTimeInterface $start, \DateTimeInterface $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event) {
            $date = $event->getStart()->format('Y-m-d');
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

}
