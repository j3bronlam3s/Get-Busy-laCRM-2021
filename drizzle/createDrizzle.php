<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['jar_id'])){
    $headerLocation = "location:viewJar?jar_id=$_REQUEST[jar_id]&account_id=$_REQUEST[account_id]";
}
else{
    $headerLocation = "location:viewRainfall?rainfall_id=$_REQUEST[rainfall_id]&account_id=$_REQUEST[account_id]";
}

if(isset($_REQUEST['createDrizzle'])){
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
            newDrizzle();
            header($headerLocation);
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}
?>

<html>
<head>
    <title>Create a New Drizzle</title>

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
                <a href = ""><h3>Log Out</h3></a>
            </div>
       </div>
<form action = '' method = 'post' style = "height: 100%; witdh: 100%;">
       <!-- body of the page -->
        <div id = "interface">
            <!-- sidebar -->
            <div id = "sidebar">
                <div id = "innerSidebar">
                    <h2>Drizzles</h2>
                </div>
            </div>
            <!-- display -->
            <div id = "innerWhitespace">
                <div id = "innerDisplay">
                    <div id = "formBody">
                        <div id = "formHeader">
                            <h2>Create a New Drizzle</h2>
                        </div>
                            <div id = "inputContainer">
                                <select name = 'jar' id = 'jar'>
                                    <?php
                                        $jarArray = existingJars();
                                        echo "
                                        <option selected disabled>Select a Rain Jar</option>
                                            ";
                                        foreach($jarArray as $jar){
                                            echo "
                                                    <option value = '$jar[jar_id]'>$jar[name]</option>
                                                ";
                                        }
                                    ?>
                                </select>

                                <select name = 'rainfall' id = 'jar'>
                                    <?php
                                        $rainfallArray = existingRainfalls();
                                        echo "
                                        <option selected disabled>Select a Rainfall</option>
                                            ";
                                        foreach($rainfallArray as $rainfall){
                                            echo "
                                                    <option value = '$rainfall[rainfall_id]'>$rainfall[name]</option>
                                                ";
                                        }
                                    ?>
                                </select>

                                <input type = 'text' name = 'text' placeholder = 'Drizzle Text' required>
                            </div>
                            <div id = submitButton>
                                <input id = "submitButton" type = 'submit' name = 'createDrizzle' value = 'Create'>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</form>
    </div>
</body>
<script src = "drizzle.js"></script>
</html>