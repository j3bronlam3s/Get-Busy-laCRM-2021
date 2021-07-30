<?php
include('config/init.php');
if(isset($_REQUEST['newComment'])){

        if(!$_REQUEST['name']){
                $Errors['name'] = 'required';
        }

        if(!$_REQUEST['username']){
                $Errors['username'] = 'required';
        }

        if(!$_REQUEST['email']){
            $Errors['email'] = 'required';
        }

        if(!validateEmail($_REQUEST['email'])){
            $Errors['email'] = 'invalid';
        }

        if(!$_REQUEST['comment']){
            $Errors['comment'] = 'required';
        }

        if(sizeof($Errors) == 0){
            addNewComment();
            header('location:practiceForm.php');
        }
        else{
            die('Errors');
        }
}
?>
<html>
<head>
    <title>Comment Form</title>
    <link rel = "stylesheet" href = "practiceFormStyle.css">
</head>
<body>
    <h1>Leave A Comment</h1>
    <form action='' method='post'>
        Name:
            <br>
        <input type = 'text' name = 'name'>
            <br>
        Username:
            <br>
        <input type = 'text' name = 'username'>
            <br>
        Email:
            <br>
        <input type = 'text' name = 'email'>
            <br>
        Comment:
            <br>
        <textarea type = 'text' name = 'comment' style = "height: 30vh; width: 40%"></textarea>
            <br>
            <br>
        <input type = 'submit' name = 'newComment' value = 'Submit Your Comment'>
        
    </form>
</body>
</html>

