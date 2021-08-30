<?php
date_default_timezone_set('America/Chicago');
include('drizzleConfig/drizzleConfig.php');
include('drizzleInclude/db_query.php'); 
session_start();

//creation
function newJar(){
    $account_id = $_SESSION['account_id'];
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
    $account_id = $_SESSION['account_id'];
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
    'account_id' => $_SESSION['account_id'],
    'text' => $_REQUEST['text'],
    'last_edited' => date('Y-m-d')
    ]);
}

function newAccount(){
    dbQuery('
    INSERT INTO accounts(first_name, last_name, email, password)
    VALUES(:first_name, :last_name, :email, :password)
    ', [
    'first_name' => $_REQUEST['firstName'],
    'last_name' => $_REQUEST['lastName'],
    'email' => $_REQUEST['email'],
    'password' => password_hash($_REQUEST['password'], PASSWORD_BCRYPT)
    ]);
}

function login(){
    $accountDetails = dbQuery('SELECT * from accounts where email = :email',
    ['email' => $_REQUEST['email']])->fetch();
    if($accountDetails == null){
        return false;
    }
    else if(password_verify($_REQUEST['password'], $accountDetails['password'])){
        $_SESSION['account_id'] = $accountDetails['account_id'];
        return true;
    }
    else{
        return false;
    }
}

//homepage
function getJars(){
    $account_id = $_SESSION['account_id'];
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
                <div class = addNew style = 'width: 50%; background-size: 70% 70%; margin: auto;'>
                <a href = createJar>
                <p> </p>
                </a>
                </div>
            ";
    }
    
}

function getRainfalls(){
    $account_id = $_SESSION['account_id'];
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
                <h3 style = 'text-shadow: 2px 2px 0px #fbfafa; color: #ed6a5a; font-size: 2.25vw'>$rainfall[next_date]</h3>
                <h3 style = 'text-shadow: 2px 2px 0px #fbfafa; color: #3772ff; font-size: 2vw'>Every $rainfall[delta_time] $unitOfTime</h3>
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
                <div class = addNew style = 'width: 50%; background-size: 70% 70%; margin: auto;'>
                <a href = createRainfall>
                
                </a>
                </div>
            ";
    }
    
}

//inside of jar
function jarTitle(){
    $title = dbQuery('SELECT name from jars where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_SESSION['account_id'], 'jar_id' => $_REQUEST['jar_id']])->fetch();
    echo "
        <title>
        View Jar - $title[name]
        </title>
        ";
}

function getDrizzlesInJar(){
    $jar = dbQuery('SELECT * from jars where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_SESSION['account_id'], 'jar_id' => $_REQUEST['jar_id']])->fetch();
    $noteArray = dbQuery('SELECT * from notes where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_SESSION['account_id'], 'jar_id' => $_REQUEST['jar_id']])->fetchAll();
    echo"
            <!-- name -->
            <div id = jarName>
                <a><h2>$jar[name]</h2></a>
            </div>
            <!-- subtitle -->
            <div id = jarSubtitle>
                <h2>$jar[subtitle]</h2>
            </div>
            <!-- table -->
            <div id = drizzleTable>
        ";
                foreach($noteArray as $note){
                    //visible note
                    echo"
                    <div class = drizzleCell>
                        <div class = drizzleText>
                            <p>$note[text]</p>
                        </div>
                        <div class = drizzleInfo>
                        ";
                           $rainfall = dbQuery('SELECT * from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_SESSION['account_id'], 'rainfall_id' => $note['rainfall_id']])->fetch();
                    echo"
                        <a href = 'viewRainfall?rainfall_id=$rainfall[rainfall_id]&account_id=$_REQUEST[account_id]' style = 'display: block; color: #ed6a5a'>
                        <p>
                        <b>$rainfall[name]</b> - $rainfall[next_date]
                        </p>
                        </a>
                        </div>
                        </div>
                        ";
                    //edit menu
                    echo "
                        <form action = '' method = post class = drizzleEditCell style = 'display: none;'>
                        <input type = hidden name = note value = $note[note_id]>
                        <textarea class = editText name = text required>";
                    echo $note['text'];
                    echo "</textarea>
                            <div class = selectBox>
                            <select name = 'jar' id = 'jar'>
                        ";

                        $jarArray = existingJars();
                        echo "
                        <option disabled>Select a Rain Jar</option>
                            ";
                        foreach($jarArray as $jar){
                            if($jar['jar_id'] == $note['jar_id']){
                                echo "
                                    <option selected value = '$jar[jar_id]'>$jar[name]</option>
                                ";
                            }
                            else{
                                echo "
                                    <option value = '$jar[jar_id]'>$jar[name]</option>
                                    ";
                            }
                        }

                    echo "
                            </select>
                            <select name = 'rainfall' id = 'rainfall'>
                        ";

                        $rainfallArray = existingRainfalls();
                            echo "
                                    <option disabled>Select a Rainfall</option>
                                ";
                            foreach($rainfallArray as $rainfall){
                                if($note['rainfall_id'] == $rainfall['rainfall_id']){
                                    echo "
                                    <option selected value = '$rainfall[rainfall_id]'>$rainfall[name]</option>
                                    ";
                                }
                                else{
                                    echo "
                                            <option value = '$rainfall[rainfall_id]'>$rainfall[name]</option>
                                        ";
                                }
                            }

                    echo"
                            </select>
                            </div>
                            <div class = editSubmitButton>
                                <input type = 'submit' name = 'editDrizzle' value = 'Save'>
                                <input type = 'submit' name = 'deleteDrizzle' value = 'Delete'>
                            </div>
                        ";

                    echo "</form>";
                }
            if(empty($noteArray)){
                echo"
                <div class = drizzleCell style = 'pointer-events: none;'>
                    <div class = drizzleText>
                        <p>No drizzles found</p>
                    </div>
                    <div class = drizzleInfo>
                    <a href = '#' style = 'display: block; color: #ed6a5a'>
                    <p>
                    <b>N/A</b>
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
    $title = dbQuery('SELECT name from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_SESSION['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetch();
    echo "
        <title>
        View Rainfall - $title[name]
        </title>
        ";
}

function getDrizzlesInRainfall(){
    $rainfall = dbQuery('SELECT * from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_SESSION['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetch();
    $noteArray = dbQuery('SELECT * from notes where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_SESSION['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetchAll();
    $unitOfTime = "days";
    if($rainfall['delta_time']==1){
        $unitOfTime = "day";
    }
    echo"
            <!-- name -->
            <div id = rainfallName>
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
                    // visible note
                    echo"
                    <div class = drizzleCell>
                        <div class = drizzleText>
                            <p>$note[text]</p>
                        </div>
                        <div class = drizzleInfo>
                        ";
                            $jar = dbQuery('SELECT * from jars where account_id = :account_id AND jar_id = :jar_id', ['account_id' => $_SESSION['account_id'], 'jar_id' => $note['jar_id']])->fetch();
                    echo"
                        <a href = 'viewJar?jar_id=$jar[jar_id]&account_id=$_REQUEST[account_id]' style = 'display: block; color: #ed6a5a'>
                        <p>
                        <b>$jar[name]</b>
                        </p>
                        </a>
                        </div>
                        </div>
                        ";
                    // edit menu
                    echo "
                    <form action = '' method = post class = drizzleEditCell style = 'display: none;'>
                    <input type = hidden name = note value = $note[note_id]>
                    <textarea class = editText name = text required>";
                    echo $note['text'];
                    echo "</textarea>
                            <div class = selectBox>
                            <select name = 'jar' id = 'jar'>
                        ";

                        $jarArray = existingJars();
                        echo "
                        <option disabled>Select a Rain Jar</option>
                            ";
                        foreach($jarArray as $jar){
                            if($jar['jar_id'] == $note['jar_id']){
                                echo "
                                    <option selected value = '$jar[jar_id]'>$jar[name]</option>
                                ";
                            }
                            else{
                                echo "
                                    <option value = '$jar[jar_id]'>$jar[name]</option>
                                    ";
                            }
                        }

                    echo "
                            </select>
                            <select name = 'rainfall' id = 'rainfall'>
                        ";

                        $rainfallArray = existingRainfalls();
                            echo "
                                    <option disabled>Select a Rainfall</option>
                                ";
                            foreach($rainfallArray as $rainfall){
                                if($note['rainfall_id'] == $rainfall['rainfall_id']){
                                    echo "
                                    <option selected value = '$rainfall[rainfall_id]'>$rainfall[name]</option>
                                    ";
                                }
                                else{
                                    echo "
                                            <option value = '$rainfall[rainfall_id]'>$rainfall[name]</option>
                                        ";
                                }
                            }

                    echo"
                            </select>
                            </div>
                            <div class = editSubmitButton>
                                <input type = 'submit' name = 'editDrizzle' value = 'Save'>
                                <input type = 'submit' name = 'deleteDrizzle' value = 'Delete'>
                            </div>
                        ";

                    echo "</form>";
                }
                if(empty($noteArray)){
                    echo"
                    <div class = drizzleCell style = 'pointer-events: none;'>
                        <div class = drizzleText>
                            <p>No drizzles found</p>
                        </div>
                        <div class = drizzleInfo>
                        <a href = '#' style = 'display: block; color: #ed6a5a'>
                        <p>
                        <b>N/A</b>
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
                    <a href = createDrizzle?rainfall_id=$_REQUEST[rainfall_id]&account_id=$_REQUEST[account_id] style = 'display: block; height: 100%; width: 100%'>
                    <a>
                </div>
                <div>
                    <a href = createDrizzle?rainfall_id=$_REQUEST[rainfall_id]&account_id=$_REQUEST[account_id] style = 'display: block;'>
                        <h2>Add New Drizzle</h2>
                    </a>
                </div>
            </div>
            </div>
            ";
}

//editing
//add parameters
function editJar(){
    dbQuery('
    UPDATE jars
    SET
    name = :name,
    subtitle = :subtitle
    WHERE jar_id = :jar_id AND account_id = :account_id' , 
    [
    'name' => $_REQUEST['name'],
    'subtitle' => $_REQUEST['subtitle'],
    'jar_id' => $_REQUEST['jar_id'],
    'account_id' => $_REQUEST['account_id']
    ]);
}

function editRainfall(){
    $rainfall = dbQuery('SELECT * from rainfalls where account_id = :account_id AND rainfall_id = :rainfall_id', ['account_id' => $_SESSION['account_id'], 'rainfall_id' => $_REQUEST['rainfall_id']])->fetch();
    dbQuery('
    UPDATE rainfalls
    SET
    name = :name,
    delta_time = :delta_time,
    next_date = :next_date
    WHERE rainfall_id = :rainfall_id AND account_id = :account_id' , 
    [
    'name' => $_REQUEST['name'],
    'delta_time' => $_REQUEST['interval'],
    'next_date' => date('Y-m-d', strtotime($rainfall['last_date'].' + '.$_REQUEST['interval'].' days')),
    'rainfall_id' => $_REQUEST['rainfall_id'],
    'account_id' => $_REQUEST['account_id']
    ]);
}

function editDrizzle(){
    dbQuery('
    UPDATE notes
    SET
    text = :text,
    rainfall_id = :rainfall_id,
    jar_id = :jar_id,
    last_edited = :last_edited
    WHERE note_id = :note_id AND account_id = :account_id' , 
    [
    'text' => $_REQUEST['text'],
    'rainfall_id' => $_REQUEST['rainfall'],
    'jar_id' => $_REQUEST['jar'],
    'last_edited' => date('Y-m-d'),
    'note_id' => $_REQUEST['note'],
    'account_id' => $_REQUEST['account_id']
    ]);
}

//deletion
// archive vs delete
function deleteJar(){
    dbQuery('
    DELETE FROM jars
    where jar_id = :jar_id AND account_id = :account_id' , 
    [
    'account_id' => $_SESSION['account_id'],
    'jar_id' => $_REQUEST['jar_id']
    ]);
}
function deleteRainfall(){
    dbQuery('
    DELETE FROM rainfalls
    where rainfall_id = :rainfall_id AND account_id = :account_id' , 
    [
    'account_id' => $_SESSION['account_id'],
    'rainfall_id' => $_REQUEST['rainfall_id']
    ]);

}
function deleteDrizzle(){
    dbQuery('
    DELETE FROM notes
    where note_id = :note_id AND account_id = :account_id' , 
    [
    'account_id' => $_SESSION['account_id'],
    'note_id' => $_REQUEST['note']
    ]);
}

//validation
function validateText($text){

}
function validateDate($date){
    
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

function existingDrizzles(){
    $drizzleArray = dbQuery('SELECT * from notes where account_id = '.$_REQUEST['account_id'])->fetchAll();
    return $drizzleArray;
}

function existingDrizzlesInside(){
    $drizzleArray = [];
    if(isset($_REQUEST['jar_id'])){
        $drizzleArray = dbQuery('SELECT * from notes where account_id = '.$_REQUEST['account_id'].'AND jar_id = '.$_REQUEST['jar_id'])->fetchAll();
    }
    if(isset($_REQUEST['rainfall_id'])){
        $drizzleArray = dbQuery('SELECT * from notes where account_id = '.$_REQUEST['account_id'].'AND rainfall_id = '.$_REQUEST['rainfall_id'])->fetchAll();
    }
    return $drizzleArray;
}
?>