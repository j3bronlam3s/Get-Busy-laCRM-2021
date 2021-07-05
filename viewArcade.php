<?php
include('config/init.php')
?>
<html>
    <body>
        <?php  
              $appArray = dbQuery('SELECT * from arcade where app_id = :app_id', ['app_id' => $_REQUEST['app_id']])->fetchAll();
            //   var_dump($projectArray);
              foreach($appArray as $app){
             echo $app['code'];
              }
        ?>
</body>
</html>