<?php

use App\App;
use App\Date\Month;

App::startSession();
global $router;


try {
    $mois = new Month($_GET['month'] ?? null,$_GET['year']?? null);
} catch (\exception $e) {
    $_SESSION['flash'] = ['danger'=>$e];
    $mois = new Month( null,null);
}


$firstDay = $mois->getFirstDay()->modify('last monday');

// dump($firstDay);

if (isset($_SESSION['flash']) ) {
    $errors = $_SESSION['flash'];
    ?>
    <div class="container">
    <?php
    foreach ($errors as $status =>$desc) {
        ?>
            <div class="alert alert-<?=$status?>">
                <p><?=$desc?></p>

            </div>

        <?php
    }
    ?>
    </div>
    <?php
    $_SESSION['flash'] = null;
}
?>
<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h1><?=$mois->toString()?></h1>
    <div>
        <a class="btn btn-primary" href="<?=$router->generate('cal')?>?month=<?=$mois->previousMonth()->month?>&amp;year=<?=$mois->previousMonth()->year?>">precedant</a>
        <a class="btn btn-primary" href="<?=$router->generate('cal')?>?month=<?=$mois->nextMonth()->month?>&amp;year=<?=$mois->nextMonth()->year?>">suivant</a>
    </div>
</div>
<br>
<link rel="stylesheet" href="css/calendar.css">
<div class="">
    <table class="calendar__table">
        <?php for($i = 0; $i < $mois->getWeeks(); $i++): ?>
        <tr>
            <?php foreach ($mois->days as $k => $day): 
                $date =(clone $firstDay)->modify($k + $i * 7 . " days")?>
                <td class="<?= $mois->withinMonth($date)? '' : 'calendar__othermonth'; ?>">
                    <?php if ($i ===0) { ?>
                    <div class="calendar__weekday" ><?= $day ?></div>
                    <?php } ?>
                    <div class="calendar__day">
                        <?php echo $date->format('d') ?>
                    </div>
                </td>
            <?php endforeach; ?>             
        </tr>
        <?php endfor; ?>
    </table>
</div>

<script src="calendrier.js"></script>
