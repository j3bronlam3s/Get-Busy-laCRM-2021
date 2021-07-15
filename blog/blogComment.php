<html>
<?php
include('blogConfig/blogInit.php');
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

        if(sizeof(validateEmail($_REQUEST['email']))>0){
            $Errors['email'] = validateEmail($_REQUEST['email']);
        }

        if(!$_REQUEST['comment']){
            $Errors['comment'] = 'required';
        }

        if(sizeof($Errors) == 0){
            addNewComment();
            header("location:viewPost.php?post_id=$_REQUEST[post_id]");
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}
?>
<head>
    <?php
    $postInfo = dbQuery('SELECT * from posts where post_id = :post_id', ['post_id' => $_REQUEST['post_id']])->fetch();
    echo "
    <title>Leave a Comment: $postInfo[title]</title>
    ";
    ?>
    <link rel = "stylesheet" href = "blogCommentStyle.css">
</head>
<body>
    <?php
    echo "
    <h1>Leave A Comment: $postInfo[title]</h1>
    ";
    ?>
    <form action='' method='post'>
        <!-- Post:
            <br>
            <?php
                // echo "
                // <input type = 'text' name = 'title' readonly value = ".$postInfo['title'].">
                // ";
            ?>
            <br> -->
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
</html>