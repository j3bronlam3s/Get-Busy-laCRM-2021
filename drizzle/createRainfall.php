<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['createRainfall'])){

        if(!$_REQUEST['name']){
                $Errors['name'] = 'required';
        }

        if(!$_REQUEST['interval']){
                $Errors['interval'] = 'required';
        }

        if(sizeof($Errors) == 0){
            newRainfall();
            // header('location:practiceForm.php');
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}
?>

<html>
<head>
    <title>Create a New Rainfall</title>
    <!-- <link rel = "stylesheet" href = "practiceFormStyle.css"> -->
</head>
<body>
    <h1>Create a New Rainfall</h1>
    <form action='' method='post'>
        Name:
            <br>
        <input type = 'text' name = 'name'>
            <br>
        Interval (days):
            <br>
        <input type = 'number' name = 'interval'>
            <br>
            <br>
        <input type = 'submit' name = 'createRainfall' value = 'Create'>
        
    </form>
</body>
</html>