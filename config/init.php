<?php
date_default_timezone_set('America/Chicago');
include('config/config.php');
include('include/db_query.php'); 
//this should happen right after config so other functions have access to the database
function addNewComment(){
    dbQuery('
    INSERT INTO comments(name, username, email, comment)
    VALUES(:name, :username, :email, :comment)
  ', [
    'name' => $_REQUEST['name'],
    'username' => $_REQUEST['username'],
    'email' => $_REQUEST['email'],
    'comment' => $_REQUEST['comment']
  ]); 
}

function validateEmail($email){
    $tlds = [".aero",".biz",".cat",".com",".coop",".edu",".gov",".info",".int",".jobs",".mil",".mobi",".museum",
    ".name",".net",".org",".travel",".ac",".ad",".ae",".af",".ag",".ai",".al",".am",".an",".ao",".aq",".ar",".as",".at",".au",".aw",
    ".az",".ba",".bb",".bd",".be",".bf",".bg",".bh",".bi",".bj",".bm",".bn",".bo",".br",".bs",".bt",".bv",".bw",".by",".bz",".ca",
    ".cc",".cd",".cf",".cg",".ch",".ci",".ck",".cl",".cm",".cn",".co",".cr",".cs",".cu",".cv",".cx",".cy",".cz",".de",".dj",".dk",".dm",
    ".do",".dz",".ec",".ee",".eg",".eh",".er",".es",".et",".eu",".fi",".fj",".fk",".fm",".fo",".fr",".ga",".gb",".gd",".ge",".gf",".gg",".gh",
    ".gi",".gl",".gm",".gn",".gp",".gq",".gr",".gs",".gt",".gu",".gw",".gy",".hk",".hm",".hn",".hr",".ht",".hu",".id",".ie",".il",".im",
    ".in",".io",".iq",".ir",".is",".it",".je",".jm",".jo",".jp",".ke",".kg",".kh",".ki",".km",".kn",".kp",".kr",".kw",".ky",".kz",".la",".lb",
    ".lc",".li",".lk",".lr",".ls",".lt",".lu",".lv",".ly",".ma",".mc",".md",".mg",".mh",".mk",".ml",".mm",".mn",".mo",".mp",".mq",
    ".mr",".ms",".mt",".mu",".mv",".mw",".mx",".my",".mz",".na",".nc",".ne",".nf",".ng",".ni",".nl",".no",".np",".nr",".nu",
    ".nz",".om",".pa",".pe",".pf",".pg",".ph",".pk",".pl",".pm",".pn",".pr",".ps",".pt",".pw",".py",".qa",".re",".ro",".ru",".rw",
    ".sa",".sb",".sc",".sd",".se",".sg",".sh",".si",".sj",".sk",".sl",".sm",".sn",".so",".sr",".st",".su",".sv",".sy",".sz",".tc",".td",".tf",
    ".tg",".th",".tj",".tk",".tm",".tn",".to",".tp",".tr",".tt",".tv",".tw",".tz",".ua",".ug",".uk",".um",".us",".uy",".uz", ".va",".vc",
    ".ve",".vg",".vi",".vn",".vu",".wf",".ws",".ye",".yt",".yu",".za",".zm",".zr",".zw"];

    $alerts = ['Please enter your email', 'Your email did not include an @', 'Your email is too short', 'Your email does not contain a valid TLD (.com/.net/etc.)', 'Your email is valid'];
    $user = [];
    $validTLD = false;
    foreach($tlds as $domain){
        if(strpos($email, $domain) !== false){
            $validTLD = true;
        }
    }
    
    if($email === ""){
        array_push($user, $alerts[0]);
    }

    if(strpos($email, "@") == false){
        array_push($user, $alerts[1]);
    }

    if(strlen($email)<6){
        array_push($user, $alerts[2]);
    }

    if($validTLD){
        
    }
    else{
        array_push($user, $alerts[3]);
    }
    return $user;
}

function sendEmail(){
  
    $to = 'jebronperkins@gmail.com';
    $subject = $_REQUEST['subject'];
    $message =  $_REQUEST['firstName']." ".$_REQUEST['lastName']."\r\n".$_REQUEST['pronouns']."\r\n".$_REQUEST['emailAddress']."\r\n".$_REQUEST['message'];
    $headers = 'From: owner@jebron.me';
    
    mail($to, $subject, $message, $headers);  
    
//         dbQuery('
//     INSERT INTO contact_requests(name, pronouns, email, subject, message, answered, date)
//     VALUES(:name, :pronouns, :email, :subject, :message, :answered, :date)
//   ', [
//     'name' => $_REQUEST['firstName']." ".$_REQUEST['lastName'],
//     'prnouns' => $_REQUEST['pronouns'],
//     'email' => $_REQUEST['email'],
//     'subject' => $_REQUEST['subject'],
//     'message' => $_REQUEST['message'],
//     'answered' => false,
//     'date' => date("Y/m/d")
//   ]); 
}

?>