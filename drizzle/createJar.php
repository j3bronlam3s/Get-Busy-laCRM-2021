<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['createJar'])){
    $Errors = [];
        if(!$_REQUEST['name']){
                $Errors['name'] = 'required';
        }

        if(!$_REQUEST['subtitle']){
                $Errors['subtitle'] = 'required';
        }

        if(sizeof($Errors) == 0){
            newJar();
            header('location:drizzleHome');
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}
?>

<html>
<head>
    <title>Create a New Jar</title>

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
                    <h2>Rain Jars</h2>
                </div>
            </div>
            <!-- display -->
            <div id = "innerWhitespace">
                <div id = "innerDisplay">
                    <div id = "formBody">
                        <div id = "formHeader">
                            <h2>Create a New Jar</h2>
                        </div>
                            <div id = "inputContainer">
                                <input type = 'text' name = 'name' placeholder = 'Jar Name' required>
                                <input type = 'text' name = 'subtitle' placeholder = 'Subtitle' required>
                            </div>
                            <div id = submitButton>
                                <input id = "submitButton" type = 'submit' name = 'createJar' value = 'Create'>
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