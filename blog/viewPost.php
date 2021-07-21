<?php
    include('blogConfig/blogInit.php');
?>
<html>
    <head>
        <?php
            $postInfo = dbQuery('SELECT * from posts where post_id = :post_id', ['post_id' => $_REQUEST['post_id']])->fetch();
            echo "<title>$postInfo[title]</title>";
        ?>
        <link rel = "stylesheet" href = "postStyle.css">
    <head>
    <body>
        <div id = "inner">
            <?php
                echo "
                <h1 id = title>$postInfo[title]</h1>
                <h1 id = topic>$postInfo[topic]</h1>
                <h1 id = author>$postInfo[author]</h1>
                <h1 id = date>$postInfo[date]</h1> 
                ";
                if(strlen($postInfo['image']) !== 0){
                    echo "
                    <img alt = $postInfo[image_desc] src = $postInfo[image] height: 200px width: 200px>
                    ";
                }
                echo "
                <p id = text>$postInfo[text]</p>
                <br>
                <a href = blogComment.php?post_id=$postInfo[post_id] id = leaveComment><h2>Leave a Comment</h2></a>
                <br><br>
                <h1>Comments:</h1>
                ";
                $commentArray = dbQuery('SELECT * from comments')->fetchALL();
                if(sizeof($commentArray) !== 0){
                foreach($commentArray as $comment){
                    echo "
                    <div id = comment>
                        <h2>$comment[username]<h2>
                        <a href ='mailto:$comment[email]'><h3>$comment[name]<h3></a>
                        <p>$comment[comment]</p>
                    </div>
                    ";
                }
                }
                else{
                    echo "
                    <h2>No Comments Available</h2>
                    ";
                }

            ?>
        </div>
    <body>
<html>