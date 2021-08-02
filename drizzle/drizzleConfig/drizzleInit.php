<?php
date_default_timezone_set('America/Chicago');
include('drizzleConfig/drizzleConfig.php');
include('drizzleInclude/db_query.php'); 

//creation
function newJar(){
    $account_id = 1;
    dbQuery('
    INSERT INTO jars(account_id, name, subtitle, num_notes, created)
    VALUES(:account_id, :name, :subtitle, :num_notes, :created)
    ', [
    'account_id' => $account_id,
    'name' => $_REQUEST['name'],
    'subtitle' => $_REQUEST['subtitle'],
    'num_notes' => 0,
    'created' => date('Y-m-d')
    ]);
}

function newRainfall(){
    $account_id = 1;
    dbQuery('
    INSERT INTO rainfalls(account_id, name, delta_time, last_date, next_date, num_notes)
    VALUES(:account_id, :name, :delta_time, :last_date, :next_date, :num_notes)
    ', [
    'account_id' => $account_id,
    'name' => $_REQUEST['name'],
    'delta_time' => $_REQUEST['interval'],
    'last_date' => date('Y-m-d'),
    'next_date' => date('Y-m-d', strtotime('+'.$_REQUEST['interval'].' days')),
    'num_notes' => 0
    ]);
}

function newDrizzle(){
    dbQuery('
    INSERT INTO notes(jar_id, rainfall_id, account_id, text, last_edited)
    VALUES(:jar_id, :rainfall_id, :account_id, :text, :last_edited)
    ', [
    'jar_id' => $_REQUEST['jar'],
    'rainfall_id' => $_REQUEST['rainfall'],
    'account_id' => $_REQUEST['account_id'],
    'text' => $_REQUEST['text'],
    'last_edited' => date('Y-m-d')
    ]);
}

//homepage
function getJars(){
    $account_id = 1;
    if(!empty(dbQuery('SELECT * from jars where account_id = '.$account_id)->fetchAll())){
    $jarArray = dbQuery('SELECT * from jars where account_id = '.$account_id)->fetchAll();
    foreach($jarArray as $jar){
        echo "
                <div class = rainjar>
                <a href = viewJar?jar_id=$jar[jar_id]&account_id=$jar[account_id]>
                <h3>$jar[name]</h3>
                </a>
                </div>
            ";
    }
        echo "
                <div class = addNew style = 'width: 21%'>
                <a href = createJar>
                <p> </p>
                </a>
                </div>
            ";
    }
    else{
        echo "
                <div class = addNew style = 'width: 21%'>
                <a href = createJar>
                <p> </p>
                </a>
                </div>
            ";
    }
    
}

function getRainfalls(){
    $account_id = 1;
    if(!empty(dbQuery('SELECT * from rainfalls where account_id = '.$account_id)->fetchAll())){
    $rainfallArray = dbQuery('SELECT * from rainfalls where account_id = '.$account_id)->fetchAll();
    
    foreach($rainfallArray as $rainfall){
        $unitOfTime = "days";
        if($rainfall['delta_time']==1){
            $unitOfTime = "day";
        }
        echo "
                <div class = rainfall>
                <a href = viewRainfall?rainfall_id=$rainfall[rainfall_id]&account_id=$rainfall[account_id]>
                <h3 style = 'text-shadow: 2px 2px 0px #3772ff;'>$rainfall[name]</h3>
                <h3 style = 'text-shadow: 2px 2px 0px #fbfafa; color: #ed6a5a; font-size: xx-large'>$rainfall[next_date]</h3>
                <h3 style = 'text-shadow: 2px 2px 0px #fbfafa; color: #3772ff; font-size: x-large'>Every $rainfall[delta_time] $unitOfTime</h3>
                </a>
                </div>
            ";
    }
        echo "
                <div class = addNew style = 'width: 30%; background-size: 70% 70%;'>
                <a href = createRainfall>
                
                </a>
                </div>
            ";
    }
    else{
        echo "
                <div class = addNew style = 'width: 30%; background-size: 70% 70%;'>
                <a href = createRainfall>
                
                </a>
                </div>
            ";
    }
    
}

//inside of jar
function jarTitle(){
    $title = dbQuery('SELECT name from jars where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_REQUEST['account_id'], 'jar_id' => $_REQUEST['jar_id']])->fetch();
    echo "
        <title>
        View Jar - $title[name]
        </title>
        ";
}

function getDrizzlesJar(){
    $jar = dbQuery('SELECT * from jars where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_REQUEST['account_id'], 'jar_id' => $_REQUEST['jar_id']])->fetch();
    $noteArray = dbQuery('SELECT * from notes where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_REQUEST['account_id'], 'jar_id' => $_REQUEST['jar_id']])->fetchAll();
    echo"
            <!-- name -->
            <div id = insideName>
                <h2>$jar[name]</h2>
            </div>
            <!-- subtitle -->
            <div id = jarSubtitle>
                <h2>$jar[subtitle]</h2>
            </div>
            <!-- table -->
            <div id = drizzleTable>
        ";
                foreach($noteArray as $note){
                    echo"
                    <div id = drizzleCell>
                        <div id = drizzleText>
                            <p>$note[text]</p>
                        </div>
                        <div id = drizzleInfo>
                        ";
                           $rainfall = dbQuery('SELECT * from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_REQUEST['account_id'], 'rainfall_id' => $note['rainfall_id']])->fetch();
                    echo"
                        <a href = 'viewRainfall?rainfall_id=$rainfall[rainfall_id]&account_id=$_REQUEST[account_id]' style = 'display: block; color: #ed6a5a'>
                        <p>
                        <b>$rainfall[name]</b> - $rainfall[next_date]
                        </p>
                        </a>
                        </div>
                    </div>
                        ";
                }
        echo "
            <!-- add drizzle -->
            <div id = addDrizzleButton>
                <div style = 'background-image: url(images/addIcon.svg); background-size: contain; background-repeat: no-repeat; background-position: center; height: 100%; width: 20%;'>
                    <a href = createDrizzle?jar_id=$jar[jar_id]&account_id=$_REQUEST[account_id] style = 'display: block; height: 100%; width: 100%'>
                    <a>
                </div>
                <div>
                    <a href = createDrizzle?jar_id=$jar[jar_id]&account_id=$_REQUEST[account_id] style = 'display: block;'>
                        <h2>Add New Drizzle</h2>
                    </a>
                </div>
            </div>
            </div>
            ";
    
}

//inside of rainfalls
function rainfallTitle(){
    $title = dbQuery('SELECT name from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_REQUEST['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetch();
    echo "
        <title>
        View Rainfall - $title[name]
        </title>
        ";
}

function getDrizzlesRainfall(){
    $rainfall = dbQuery('SELECT * from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_REQUEST['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetch();
    $noteArray = dbQuery('SELECT * from notes where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_REQUEST['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetchAll();
    $unitOfTime = "days";
    if($rainfall['delta_time']==1){
        $unitOfTime = "day";
    }
    echo"
            <!-- name -->
            <div id = insideName>
                <h2>$rainfall[name]</h2>
            </div>
            <!-- subtitle -->
            <div id = rainfallInfo>
                <div id = lastDate>
                    <h2>$rainfall[last_date]</h2>
                </div>
                <div id = interval>
                    <h2>$rainfall[delta_time] $unitOfTime</h2>
                </div>
                <div id = nextDate>
                    <h2>$rainfall[next_date]</h2>
                </div>
            </div>
            <!-- table -->
            <div id = drizzleTable>
        ";
                foreach($noteArray as $note){
                    echo"
                    <div id = drizzleCell>
                        <div id = drizzleText>
                            <p>$note[text]</p>
                        </div>
                        <div id = drizzleInfo>
                        ";
                            $jar = dbQuery('SELECT * from jars where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_REQUEST['account_id'], 'jar_id' => $note['jar_id']])->fetch();
                    echo"
                        <a href = 'viewJar?jar_id=$jar[jar_id]&account_id=$_REQUEST[account_id]' style = 'display: block; color: #ed6a5a'>
                        <p>
                        <b>$jar[name]</b>
                        </p>
                        </a>
                        </div>
                    </div>
                        ";
                }
        echo "
            <!-- add drizzle -->
            <div id = addDrizzleButton>
                <div style = 'background-image: url(images/addIcon.svg); background-size: contain; background-repeat: no-repeat; background-position: center; height: 100%; width: 20%;'>
                    <a href = createDrizzle?rainfall_id=$rainfall[rainfall_id]&account_id=$_REQUEST[account_id] style = 'display: block; height: 100%; width: 100%'>
                    <a>
                </div>
                <div>
                    <a href = createDrizzle?rainfall_id=$rainfall[rainfall_id]&account_id=$_REQUEST[account_id] style = 'display: block;'>
                        <h2>Add New Drizzle</h2>
                    </a>
                </div>
            </div>
            </div>
            ";
}

//editing
function editJar(){

}

function editRainfall(){

}

function editDrizzle(){

}

//validation
function validateText($text){

}

//array helpers
function existingJars(){
    $jarArray = dbQuery('SELECT * from jars where account_id = '.$_REQUEST['account_id'])->fetchAll();
    return $jarArray;
}

function existingRainfalls(){
    $rainfallArray = dbQuery('SELECT * from rainfalls where account_id = '.$_REQUEST['account_id'])->fetchAll();
    return $rainfallArray;
}






//this should happen right after config so other functions have access to the database
// function addNewComment(){
// $postIdHelper = dbQuery('SELECT post_id from posts where title = :title', ['title' => $_REQUEST['title']])->fetch();
// dbQuery('
// INSERT INTO comments(post_id, name, username, email, comment)
// VALUES(:post_id, :name, :username, :email, :comment)
// ', [
// 'post_id' => $_REQUEST['post_id'],
// 'name' => $_REQUEST['name'],
// 'username' => $_REQUEST['username'],
// 'email' => $_REQUEST['email'],
// 'comment' => $_REQUEST['comment']
// ]);
// }  

// function validateEmail($email){
//     $tlds = [".aero",".biz",".cat",".com",".coop",".edu",".gov",".info",".int",".jobs",".mil",".mobi",".museum",
//     ".name",".net",".org",".travel",".ac",".ad",".ae",".af",".ag",".ai",".al",".am",".an",".ao",".aq",".ar",".as",".at",".au",".aw",
//     ".az",".ba",".bb",".bd",".be",".bf",".bg",".bh",".bi",".bj",".bm",".bn",".bo",".br",".bs",".bt",".bv",".bw",".by",".bz",".ca",
//     ".cc",".cd",".cf",".cg",".ch",".ci",".ck",".cl",".cm",".cn",".co",".cr",".cs",".cu",".cv",".cx",".cy",".cz",".de",".dj",".dk",".dm",
//     ".do",".dz",".ec",".ee",".eg",".eh",".er",".es",".et",".eu",".fi",".fj",".fk",".fm",".fo",".fr",".ga",".gb",".gd",".ge",".gf",".gg",".gh",
//     ".gi",".gl",".gm",".gn",".gp",".gq",".gr",".gs",".gt",".gu",".gw",".gy",".hk",".hm",".hn",".hr",".ht",".hu",".id",".ie",".il",".im",
//     ".in",".io",".iq",".ir",".is",".it",".je",".jm",".jo",".jp",".ke",".kg",".kh",".ki",".km",".kn",".kp",".kr",".kw",".ky",".kz",".la",".lb",
//     ".lc",".li",".lk",".lr",".ls",".lt",".lu",".lv",".ly",".ma",".mc",".md",".mg",".mh",".mk",".ml",".mm",".mn",".mo",".mp",".mq",
//     ".mr",".ms",".mt",".mu",".mv",".mw",".mx",".my",".mz",".na",".nc",".ne",".nf",".ng",".ni",".nl",".no",".np",".nr",".nu",
//     ".nz",".om",".pa",".pe",".pf",".pg",".ph",".pk",".pl",".pm",".pn",".pr",".ps",".pt",".pw",".py",".qa",".re",".ro",".ru",".rw",
//     ".sa",".sb",".sc",".sd",".se",".sg",".sh",".si",".sj",".sk",".sl",".sm",".sn",".so",".sr",".st",".su",".sv",".sy",".sz",".tc",".td",".tf",
//     ".tg",".th",".tj",".tk",".tm",".tn",".to",".tp",".tr",".tt",".tv",".tw",".tz",".ua",".ug",".uk",".um",".us",".uy",".uz", ".va",".vc",
//     ".ve",".vg",".vi",".vn",".vu",".wf",".ws",".ye",".yt",".yu",".za",".zm",".zr",".zw"];

//     $alerts = ['Please enter your email', 'Your email did not include an @', 'Your email is too short', 'Your email does not contain a valid TLD (.com/.net/etc.)', 'Your email is valid'];
//     $user = [];
//     $validTLD = false;
//     foreach($tlds as $domain){
//         if(strpos($email, $domain) !== false){
//             $validTLD = true;
//         }
//     }
    
//     if($email === ""){
//         array_push($user, $alerts[0]);
//     }

//     if(strpos($email, "@") == false){
//         array_push($user, $alerts[1]);
//     }

//     if(strlen($email)<6){
//         array_push($user, $alerts[2]);
//     }

//     if($validTLD){
        
//     }
//     else{
//         array_push($user, $alerts[3]);
//     }
//     return $user;
// }

?>