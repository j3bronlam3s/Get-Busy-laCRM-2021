<html>
    <head>
        <title>View Comments</title>
    </head>

    <body style = "text-align: center"> 
        <h1> All Comments </h1>
        <?php
        include('config/init.php');
        if(dbQuery('SELECT * from comments')->fetchALL() !== null){
            $commentsArray = dbQuery('SELECT * from comments')->fetchALL();
            foreach($commentsArray as $comment){
                echo "
                <div style = 'border: 3px black solid; border-radius: 15%; background-color: lavender; color: white; margin: auto;'>
                <h2>$comment[username]<h2>
                <a href ='mailto:$comment[email]'><h3>$comment[name]<h3></a>
                <p>$comment[comment]</p>
                </div>
                <br><br>
                ";
            }
        }
        else{
            echo "<h1>No Comments Available</h1>";
        }
        ?>
    </body>
</html>