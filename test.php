<?php
include('config/init.php');

//this won't work until you set up a database and connect to it with config.php

$result = dbQuery("SELECT name FROM projects where project_id = 1")->fetchAll();
foreach($result as $res){
foreach($res as $r){
    echo $r;
    echo "<br>";
}
}




// echo "<h1>".$result."</h1>";
?>