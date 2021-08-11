<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['createAccount'])){
    $Errors = [];
    var_dump($_REQUEST);
        if(!$_REQUEST['firstName']){
                $Errors['firstName'] = 'required';
        }

        if(!$_REQUEST['lastName']){
                $Errors['lastName'] = 'required';
        }

        if(!$_REQUEST['email']){
            $Errors['email'] = 'required';
        }

        if(!$_REQUEST['password']){
            $Errors['password'] = 'required';
        }

        if(sizeof($Errors) == 0){
            newAccount();
            if(login()){
                header('location:drizzleHome');
            }
            else{
                var_dump($Errors);
                die('Errors');
            }
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}

if(isset($_REQUEST['logIn'])){
    $Errors = [];
        if(!$_REQUEST['email']){
            $Errors['email'] = 'required';
        }

        if(!$_REQUEST['password']){
            $Errors['password'] = 'required';
        }

        if(sizeof($Errors) == 0){
            if(login()){
                header('location:drizzleHome');
            }
            else{
                var_dump($Errors);
                die('Errors');
            }
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}
?>

<html>
<head>
    <title>Drizzle</title>

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
                        <div id = "loginTitle">
                            <h1>Drizzle</h1>
                        </div>
                        <div id = "loginQuote">
                            <h2>The Rain Begins with a Single Drop<br>- Manal Al-Sharif</h2>
                        </div>
                        <div id = "loginButtons">
                            <div id = "signUpButton">
                                <h3>Sign Up<h3>
                            </div>
                            <div id = "logInButton">
                                <h3>Login</h3>
                            </div>
                        </div>
                    </div>
                    <form id = "createAccount" class = "formBody" style = "display: none" action = '' method = 'post'>
                        <input type = 'text' name = 'firstName' placeholder = 'First Name' required>
                        <input type = 'text' name = 'lastName' placeholder = 'Last Name' required>
                        <input type = 'text' name = 'email' placeholder = 'Email Address' required>
                        <input type = 'password' name = 'password' placeholder = 'Enter Your Password' required>
                        <input type = 'submit' name = 'createAccount' value = 'Create Account'>
                    </form>
                    <form id = "logIn" class = "formBody" style = "display: none" action = '' method = 'post'>
                        <input type = 'text' name = 'email' placeholder = 'Email Address' required>
                        <input type = 'password' name = 'password' placeholder = 'Enter Your Password' required>
                        <input type = 'submit' name = 'logIn' value = 'Login'>
                    </form>
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

