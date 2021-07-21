<?php
include('config/init.php')
?>
<html>
    <body>
        <?php  
              $projectArray = dbQuery('SELECT * from projects where project_id = :project_id', ['project_id' => $_REQUEST['project_id']])->fetchAll();
            //   var_dump($projectArray);
              foreach($projectArray as $project){
             echo $project['code'];
              }
        ?>
</body>
</html>