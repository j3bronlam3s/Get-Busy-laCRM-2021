<?php
include('data.php');
?>
<html>
    <body>
        <?php foreach($projArray as $proj){ 
            foreach($proj as $p){
               echo $p;
               echo "<br>";
           }
           echo "<br>";
        }
        ?>
</body>
</html>