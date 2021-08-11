<?php
include('drizzleConfig/drizzleInit.php');

$currentRainfalls = dbQuery('SELECT * from rainfalls where next_date = '.date(Y-m-d).' OR next_date < '.date(Y-m-d))->fetchAll();

foreach($currentRainfalls as $rainfall){
    $currentAccount = dbQuery('SELECT * from accounts where account_id ='.$rainfall['account_id'])->fetch();
    $to = $currentAccount['email'];
    $subject = 'Its Time For Your '.$rainfall['name'].' Rainfall';
    $message = "Hi ".$currentAccount['first_name']."\r\nHere are the Drizzles for Your".$rainfall['name']."Rainfall:\r\n";
    $additional = [
                    'From' => 'drizzleBot@drizzleco.com'
                  ];

    $noteArray = dbQuery('SELECT * from notes where rainfall_id = '.$rainfall['rainfall_id']);
    
    foreach($noteArray as $note){
        $message .= $note['text']."\r\n";
    }
    
    $message .= "Thanks for using Drizzle";
    mail($to, $subject, $message, $additional);
}
?>