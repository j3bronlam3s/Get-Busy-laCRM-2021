<?php
    include('drizzleConfig/drizzleInit.php');

    $invalidDates = dbQuery('SELECT * from rainfalls where next_date = '.date(Y-m-d).'OR next_date < '.date(Y-m-d))->fetchAll();

    foreach($invalidDates as $date){
        dbQuery('
        UPDATE rainfalls
        SET
        last_date = :last_date,
        next_date = :next_date
        WHERE rainfall_id = :rainfall_id', 
        [
        'last_date' => $date['last_date'],
        'next_date' => date('Y-m-d', strtotime($date['last_date'].' + '.$date['interval'].' days')),
        'rainfall_id' => $date['rainfall_id']
        ]);
    }
?>