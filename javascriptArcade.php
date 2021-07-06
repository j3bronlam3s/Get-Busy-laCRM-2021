<?php
include('config/init.php')
?>
<html>
    <head>
        <title>JavaScript Arcade</title>
        <link rel = "stylesheet" href = "arcadeStyle.css">
    </head>
    <body>
        <h1>JavaScript Arcade</h1>
        <div class = "grid">
        <?php
        $appArray = dbQuery('SELECT * from arcade')->fetchALL();
        foreach($appArray as $app){
        echo "<div class='widget'>";
        echo "<a href= '$app[code]'style='text-decoration: none; display: block; height: 100%; color: #FEFFFE;'>";
            echo "<img src = $app[icon]>";
            echo "<h2>$app[name]</h2>";
        echo "</a>";
        echo "</div>";
        }
        ?>
        </div>
    </body>
</html>