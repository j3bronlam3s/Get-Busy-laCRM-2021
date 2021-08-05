<?php
include('config/init.php');
    $Errors = [];
    if(isset($_REQUEST['newEmail'])){
    
        if(!$_REQUEST['firstName']){
                $Errors['firstName'] = 'required';
        }
    
        if(!$_REQUEST['lastName']){
                $Errors['lastName'] = 'required';
        }
    
        if(!$_REQUEST['pronouns']){
            $Errors['pronouns'] = 'required';
        }
    
        if(sizeof(validateEmail($_REQUEST['emailAddress']))>0){
            $Errors['emailAddress'] = validateEmail($_REQUEST['emailAddress']);
        }
    
        if(!$_REQUEST['subject']){
            $Errors['eubject'] = 'required';
        }
    
        if(!$_REQUEST['message']){
            $Errors['message'] = 'required';
        }
    
        if(sizeof($Errors) == 0){
            sendEmail();
        }
        else{
            var_dump($Errors);
            die('Errors');
        }
        
    }
    ?>
<head>
    <title>Jebron Perkins</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Montserrat&family=Raleway&family=Noto+Sans+KR:wght@100&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<!-- entire page -->
<div>

    <!-- Intro -->
    <div id = "intro">
        <!-- let side whitespace -->
        <div style = "display: flex; flex: 2; flex-direction: column;">

        </div>
        <!-- center section -->
        <div style = "display: flex; flex: 6; flex-direction: column;">
            <!-- whitespace above welcome -->
                <div style = "flex: 2.5; background-color: transparent; color: transparent">

                </div>
                <!-- Name -->
                <div id = "welcome">
                    <h1>Jebron Perkins</h1>
                    <div id = "welcomeHLine"></div>
                    <h1 style = "font-family: 'Noto Sans KR', sans-serif;">&#xC81C;&#xBE0C;&#xB780; &#xD37C;&#xD0A8;&#xC2A4;</h1>
                </div>
                <!-- Whitespace between name and buttons -->
                <div style = "flex: .25">

                </div>
                <!-- Buttons -->
                <div style = "flex: 1.25; align-content: flex-start;">
                    <div class="boxWrapper">

                            <div class = "box">
                            <a href="#aboutMe" style="text-decoration: none; display: block; height: 100%;">
                                <p>about me</p>
                            </a>
                        </div>
                            <div class = "boxBreaker">
                                <p> </p>
                            </div>
                        <div class = "box">
                            <a href="#skills" style="text-decoration: none; display: block; height: 100%;">
                                <p>skills</p>
                            </a>
                        </div>
                            <div class = "boxBreaker">
                                <p> </p>
                            </div>
                        <div class = "box">
                            <a href="#projects" style="text-decoration: none;  display: block; height: 100%;">
                                <p>projects</p>
                            </a>
                        </div>
                            <div class = "boxBreaker">
                                <p> </p>
                            </div>
                        <div class = "box">
                            <a href="blog/blogHome.php" style="text-decoration: none;  display: block; height: 100%;">
                                <p>blog (wip)</p>
                            </a>
                        </div>
                            <div class = "boxBreaker">
                                <p> </p>
                            </div>
                        <div class = "box">
                            <a href="#contactMe" style="text-decoration: none;  display: block; height: 100%;">
                                <p>contact me</p>
                            </a>
                        </div>

                    </div>
                    <div>
                        <em><p style = "text-align: center; color: #FEFFFE">Please view on desktop and adjust zoom for best experience</p></em>
                    </div>
                </div>
                <!-- bottom page whitespace -->
                <div style = "flex: 1.5; color: transparent">

                </div>
            </div>
        <!-- right section -->
        <div style = "flex: 2; display: flex; flex-direction: column;">
                <div class = "iconWrapper">
                        <div class = "iconBreaker">
                            <p> </p>
                        </div>
                        <a href = "https://github.com/j3bronlam3s"><img alt="Github Icon" src="githubIcon.png" width="65px" height="65px"></a>
                        <div class = "iconBreaker">
                            <p> </p>
                        </div>
                        <a href = "https://www.linkedin.com/in/jebron-perkins-4b74041a6/" style = "height: 65px">
                            <img alt="LinkedIn Icon" src="linkedinIcon.png" width="65px" height="65px">
                            </a>
                        <div class = "iconBreaker">
                            <p> </p>
                        </div>
                        <a href = "https://open.spotify.com/user/thadivinecomedy"><img alt="Spotify Icon" src="spotifyIcon.png" width="65px" height="65px"></a>
                        <div class = "iconBreaker">
                            <p> </p>
                        </div>
                        <a href = "https://instagram.com/j3bron_lam3s"><img alt="Instagram Icon" src="instagramIcon.png" width="65px" height="65px"></a>
                </div>
            </div>

    </div>

    <!-- About Me -->
    <div id = "aboutMe">

        <div style="flex: 7; display: flex; flex-direction: row; height: 65vh;">
            <!-- photo -->
            <div id = "photo">
                <!-- <img style="border: solid 10px rgb(181, 69, 84); margin: 10px; border-radius: 5%;" alt="Picture of Jebron Perkins" src="IMG_5542.jpg"height = "95%"> -->
            </div>
            <!-- bio -->
            <div style="flex: 6;" id = "bio">
                <p>Hi, I’m Jebron Perkins. I am currently 17 and a rising sophomore at Washington University in St. Louis. I am a Computer Science Major, minoring in Korean and Dance. I have experience in Full-Stack Development and Web Design and am hoping to get experience in Mobile App Development. <br><br> Please click on the timeline below to gain a closer look into my experiences.</p>
            </div>
        
        </div>
        <!-- timeline -->
        <div id = "timeline">
            <a href = "Jebron Perkins - Resume.pdf"></a>
        </div>
        
    </div>

    <!-- skills -->
    <div id="skills">
        <div style = "background-color: #C2A0AC;" class = "skillColumn">
        <img src = "programming.svg" height = "100px" width ="100px">
        <div  style = "background-color: #B54554;"><h1>Programming Languages</h1></div>
        <p>Java</p>
        <p>HTML/CSS</p>
        <p>JavaScript</p>
        <p>PHP</p>
        <p>MySQL</p>
        </div>

        <div class = "skillColumn">
        <img src = "coursework.svg" height = "100px" width ="100px">
        <div style = "background-color: #C2A0AC;"><h1>Notable Coursework</h1></div>
        <p>Data Structures & Algorithms</p>
        <p>Multivariable Calculus</p>
        <p>Full-Stack Web Development</p>
        <p>Matrix Algebra</p>
        </div>

        <div style = "background-color: #C2A0AC;" class = "skillColumn">
        <img src = "software.svg" height = "100px" width ="100px">
        <div  style = "background-color: #B54554;"><h1>Software Applications</h1></div>
        <p>Github</p>
        <p>Quickbooks Accountant</p>
        <p>Adalo</p>
        <p>Webflow</p>
        </div>

        <div class = "skillColumn">
        <img src = "misc.svg" height = "100px" width ="100px">
        <div style = "background-color: #C2A0AC;"><h1>Miscellaneous Skills</h1></div>
        <p>Limited Working Proficiency in Korean</p>
        <p>Biomedical Research</p>
        <p>Poetry Writing</p>
        <p>Contemporary Dance</p>
        </div>

    </div>

    <!-- projects -->
    <!-- $result = dbQuery("SELECT name FROM projects where project_id = 1")->fetchAll(); -->
    <div id = "projects">
        <div>
            <h1>Projects</h1>
        </div>
        <div>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Date Completed</th>
                    <th>Description</th>
                </tr>
            <?php
            // $projectsArray = dbQuery('SELECT * from projects')->fetchAll();
            // $project_id = mysql_real_escape_string($_REQUEST['project_id']);
            // $projectsArray = dbQuery('SELECT * from projects where project_id = :project_id', ['project_id' => $_REQUEST['project_id']])->fetchAll();
                $projectsArray = dbQuery('SELECT * from projects')->fetchAll();
                foreach($projectsArray as $project){
                    echo "
                        <tr>
                            <td>
                            <a href = $project[code]>
                            $project[name]</a>
                            </td>
                            <td>$project[date_completed]</td>
                            <td>$project[description]</td>
                        </tr>
                    ";
                }
            ?>
            </table>
        </div>
    </div>

    <!-- contact me -->
    <div id = "contactMe">
        <div style = "width: 30%; margin: auto;">
            <h1>Contact Me</h1>
        </div>
        <form style = "display: flex; flex-direction: row; width: 70%" action = '' method = "post">
            <div style = "flex: 1; width: 50%; display: flex; flex-direction: column;">

                <div style = "flex: 1;">
                    <br>
                    <label for="fName">First Name</label>
                    <br>
                    <input type="text" id="fName" name = "firstName" placeholder = "Your First Name" required>
                </div>

                <br>

                <div style = "flex: 1;">
                    <label for="lName">Last Name</label>
                    <br>
                    <input type="text" id="lName" name = "lastName" placeholder = "Your Last Name" required>
                </div>

                <br>

                <div style = "flex: 1;">
                    <label for="pronouns">Pronouns</label>
                    <br>
                    <input type="text" id="pNouns" name = "pronouns" placeholder = "he/him or they/them or etc." required>
                </div>

                <br>
                
                <div style = "flex: 1;">
                    <label for="email">Email Address</label>
                    <br>
                    <input type="text" id="email" name = "emailAddress" placeholder = "johndoe@xyz.com" required>
                </div>
            </div>

            <div style = "flex: 1; width: 50%; display: flex; flex-direction: column;">
                <div style = "flex: 1;">
                    <br>
                    <label for="subj">Subject</label>
                    <br>
                    <input type="text" id="subj" name = "subject" placeholder = "Write Something" required>
                </div>

                <div style = "flex: 4;">
                    <label for="message">Message</label>
                    <br>
                    <textarea id="message" name = "message" placeholder = "Your Message Here" required></textarea>
                    <br>
                </div>

                <div style = "flex: 1;">
                <br>
                    <input type="submit" name="newEmail" value = "Submit" style = "width: 20%; font-size: large;">
                </div>
            </div>
    </form>
    </div>

<!-- page end -->
</div>

</body>