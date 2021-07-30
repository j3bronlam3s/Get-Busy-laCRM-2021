<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['createJar'])){

        if(!$_REQUEST['name']){
                $Errors['name'] = 'required';
        }

        if(!$_REQUEST['subtitle']){
                $Errors['subtitle'] = 'required';
        }

        if(sizeof($Errors) == 0){
            newJar();
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
    <title>Create a New Jar</title>
    <!-- <link rel = "stylesheet" href = "practiceFormStyle.css"> -->
</head>
<body>
    <h1>Create a New Jar</h1>
    <form action='' method='post'>
        Name:
            <br>
        <input type = 'text' name = 'name'>
            <br>
        Subtitle:
            <br>
        <input type = 'text' name = 'subtitle'>
            <br>
            <br>
        <input type = 'submit' name = 'createJar' value = 'Create'>
        
    </form>
</body>
</html>