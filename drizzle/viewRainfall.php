<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['editRainfall'])){
    $Errors = [];
        if(!$_REQUEST['name']){
                $Errors['name'] = 'required';
        }

        if(!$_REQUEST['interval']){
                $Errors['interval'] = 'required';
        }

        if(sizeof($Errors) == 0){
            editRainfall();
            header("location:viewRainfall?rainfall_id=$_REQUEST[rainfall_id]&account_id=$_REQUEST[account_id]");
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}

if(isset($_REQUEST['deleteRainfall'])){
    deleteRainfall();
    header("location:drizzleHome");
}

if(isset($_REQUEST['editDrizzle'])){
    $Errors = [];
        if(!$_REQUEST['jar']){
                $Errors['jar'] = 'required';
        }

        if(!$_REQUEST['rainfall']){
            $Errors['rainfall'] = 'required';
        }

        if(!$_REQUEST['text']){
            $Errors['text'] = 'required';
        }

        if(sizeof($Errors) == 0){
            editDrizzle();
            header("location: viewRainfall?account_id=$_REQUEST[account_id]&rainfall_id=$_REQUEST[rainfall_id]");
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}

if(isset($_REQUEST['deleteDrizzle'])){
    deleteDrizzle();
    header("location: viewRainfall?account_id=$_REQUEST[account_id]&rainfall_id=$_REQUEST[rainfall_id]");
}

?>

<html>
<head>
    <?php
        rainfallTitle();
    ?>

    <link rel = "stylesheet" href = "homeStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Bungee+Shade&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
   <!-- entire page -->
   <div id = "landing">
        <!-- upper menu -->
       <div id = "header">
           <!-- logo -->
           <div id = "logo">
                <a href = "drizzleHome" style = 'display: block; color: #fbfafa'>
             <h1>Drizzle</h1>
                </a>
            </div>
            <!-- blank space -->
            <div id = "headerSpace">
            </div>
            <!-- links -->
            <div id = "links">
                <a href = ""><h3>My Account</h3></a>
                <a href = ""><h3>Contact Us</h3></a>
                <a href = ""><h3>About</h3></a>
                <a href = "drizzleLogout"><h3>Log Out</h3></a>
            </div>
       </div>
       <!-- body of the page -->
        <div id = "interface">
            <div id = "sidebar">
                        <div id = "innerSidebar">
                            <h2>Rainfalls</h2>
                        </div>
                </div>
                <!-- display -->
                <div id = "innerWhitespace">
                    <div id = "innerDisplay">
                        <?php
                            getDrizzlesInRainfall();
                        ?>
                    </div>
                    <div id = "rainfallEditDisplay" style = "display: none;">
                        <form action = '' method = 'post' class = "formBody">
                            <div id = "formHeader">
                                <h2>Edit Your Rainfall</h2>
                            </div>
                                <div id = "inputContainer">
                                    <input type = 'text' name = 'name' value = '<?php
                                        $rainfallArray = existingRainfalls();
                                        $name = "";
                                        foreach($rainfallArray as $rainfall){
                                            if($rainfall['rainfall_id'] == $_REQUEST['rainfall_id']){
                                                $name = $rainfall['name'];
                                            }
                                        }
                                        echo htmlspecialchars($name, ENT_QUOTES);
                                        ?>'
                                    required>
                                    <input type = 'number' name = 'interval' value = '<?php
                                        $rainfallArray = existingRainfalls();
                                        $interval = 0;
                                        foreach($rainfallArray as $rainfall){
                                            if($rainfall['rainfall_id'] == $_REQUEST['rainfall_id']){
                                                $interval = $rainfall['delta_time'];
                                            }
                                        }
                                        echo $interval;
                                        ?>' required>
                                </div>
                                <div id = submitButton>
                                    <input id = "submitButton" type = 'submit' name = 'editRainfall' value = 'Save'>
                                    <input id = "submitButton" type = 'submit' name = 'deleteRainfall' value = 'Delete'>
                                </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</body>
<script src = "drizzle.js"></script>
</html>