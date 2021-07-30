<?php
    include('drizzleConfig/drizzleInit.php');
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
                <a href = "drizzleHome.php" style = 'display: block; color: #fbfafa'>
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
                            getDrizzlesRainfall();
                        ?>
                    </div>
                </div>
        </div>
    </div>
</body>
<script src = "drizzle.js"></script>
</html>