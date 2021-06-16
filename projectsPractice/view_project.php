<?php
include('data.php');
?>
<html>
    <body>
        <?php  
        $selectedProj = $projArray[$_GET['project']];
        foreach($selectedProj as $proj){
            echo $proj;
            echo "<br>";
        }
        ?>
</body>
</html>