<?php
include('drizzleConfig/drizzleInit.php');
session_destroy();
?>

<html>
<head>
    <title>Drizzle - Log Out</title>

    <link rel = "stylesheet" href = "homeStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Bungee+Shade&family=Montserrat&family=Bungee+Inline&display=swap" rel="stylesheet">
</head>
<body style = "height: 100vh; overflow: hidden;">>
   <!-- entire page -->
   <div id  ="interface">
   <div id = "landing" style = "height: 100vh;">
    <!-- body of the page -->
        <div id = "loginWhitespace">
            <!-- display -->
                <div id = "loginDisplay">
                    <div id = "loginMenu">
                        <div id = "loginTitle" style = "width: 100vw; font-size: 3vw; line-height: 1; align-items: center;">
                            <h1>Thank You For Visiting Drizzle</h1>
                        </div>
                        <div id = "loginQuote" style = "align-items: center">
                            <h2>You are now logged out<br>Please click below to go back to the login page</h2>
                        </div>
                        <div id = "loginButtons">
                            <div id = "backToHome">
                                <a href = "drizzleLogin" style = "color: #fbfafa"><h3>Login<h3></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- waves -->
                <div id = "waveContainer">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(112,155,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(51,114,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(112,155,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#3772ff" />
                    </g>
                    </svg>
                </div>
            </div>
    </div>
</div>
</body>
<script src = "drizzle.js"></script>
</html>

