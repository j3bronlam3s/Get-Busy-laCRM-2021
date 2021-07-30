<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['createDrizzle'])){

        if(validateText($_REQUEST['text'])){
                $Errors['text'] = 'invalid';
        }

        if(sizeof($Errors) == 0){
            newDrizzle();
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
    <title>Create a New Drizzle</title>
    <!-- <link rel = "stylesheet" href = "practiceFormStyle.css"> -->
</head>
<body>
    <h1>Create a New Drizzle</h1>
    <form action='' method='post'>
        Text:
            <br>
        <textarea type = 'text' name = 'comment' style = "height: 30vh; width: 40%"></textarea>
            <br>
            <br>
        <input type = 'submit' name = 'createDrizzle' value = 'Create'>
        
    </form>
</body>
</html>