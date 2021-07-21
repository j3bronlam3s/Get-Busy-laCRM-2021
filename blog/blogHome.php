<html>
<head>
    <title>Invisible Garden: A Blog</title>
    <link rel = "stylesheet" href = "blogHomeStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Codystar&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
<!-- Whole Page -->
<div id = "home">
    <!-- Left Side -->
    <div id = "left">
        <h1 id = "title">Invisible Garden</hw>
        <h2>Meet the Author:</h2>
        <img alt = "Image of Jebron Perkins" src = "IMG_6825.JPG" height = "450vh">
        <h3>Jebron Perkins</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <!-- Right Side -->
    <div id = "right">
        <div id = "posts">
            <h1>Posts</h1>
            <?php
                include('blogConfig/blogInit.php');
                if(sizeof(dbQuery('SELECT * from posts')->fetchALL()) !== 0){
                    $postsArray = dbQuery('SELECT * from posts')->fetchALL();
                    echo "<ul>";
                    foreach($postsArray as $post){
                        echo "
                            <li>
                            <a href = viewPost.php?post_id=$post[post_id]><h2>$post[title]<h2></a>
                            </li>
                        ";
                    }
                    echo "</ul>";
                }
                else{
                    echo "<h2>No Posts Available</h2>";
                }
            ?>
        </div>
    </div>
</div>
<body>
</html>