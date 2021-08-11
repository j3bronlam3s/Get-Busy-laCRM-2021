<?php
include('drizzleConfig/drizzleInit.php');

if(isset($_REQUEST['editJar'])){
    $Errors = [];
        if(!$_REQUEST['name']){
                $Errors['name'] = 'required';
        }

        if(!$_REQUEST['subtitle']){
                $Errors['subtitle'] = 'required';
        }

        if(sizeof($Errors) == 0){
            editJar();
            header("location: viewJar?account_id=$_REQUEST[account_id]&jar_id=$_REQUEST[jar_id]");
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}

if(isset($_REQUEST['deleteJar'])){
    deleteJar();
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
            header("location: viewJar?account_id=$_REQUEST[account_id]&jar_id=$_REQUEST[jar_id]");
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
}

if(isset($_REQUEST['deleteDrizzle'])){
    deleteDrizzle();
    header("location: viewJar?account_id=$_REQUEST[account_id]&jar_id=$_REQUEST[jar_id]");
}

?>

<html>
<head>
    <?php
        jarTitle();
    ?>
    <script src = "drizzle.js"></script>
    <link rel = "stylesheet" href = "homeStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Bungee+Shade&family=Montserrat&display=swap" rel="stylesheet">
    <script src = "drizzle.js"></script>
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
                        <h2>Rain Jars</h2>
                    </div>
            </div>
            <!-- display -->
            <div id = "innerWhitespace">
                <div id = "innerDisplay">
                    <?php
                        getDrizzlesInJar();
                    ?>
                </div>
                <div id = "jarEditDisplay" style = "display: none;">
                <form action = '' method = 'post' class = "formBody">
                            <div id = "formHeader">
                                <h2>Edit Your Rain Jar</h2>
                            </div>
                                <div id = "inputContainer">
                                    <input type = 'text' name = 'name' value = '<?php
                                        $jarArray = existingJars();
                                        $name = "";
                                        foreach($jarArray as $jar){
                                            if($jar['jar_id'] == $_REQUEST['jar_id']){
                                                $name = $jar['name'];
                                            }
                                        }
                                        echo htmlspecialchars($name, ENT_QUOTES);
                                        ?>'
                                    required>
                                    <input type = 'text' name = 'subtitle' value = '<?php
                                        $jarArray = existingJars();
                                        $subtitle = "";
                                        foreach($jarArray as $jar){
                                            if($jar['jar_id'] == $_REQUEST['jar_id']){
                                                $subtitle = $jar['subtitle'];
                                            }
                                        }
                                        echo htmlspecialchars($subtitle, ENT_QUOTES);
                                        ?>' required>
                                </div>
                                <div id = submitButton>
                                    <input type = 'submit' name = 'editJar' value = 'Save'>
                                    <input type = 'submit' name = 'deleteJar' value = 'Delete'>
                                </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>
<script src = "drizzle.js"></script>
</html>

