<?php
//File: TwitterFolldersUpdate.php
//Decription: This will update the twitter_dbupdates every 15 minutes with 900 accounts twitter info
//Author: George Chamoun
//Notes:
//*******************************************************************************
//*******************************************************************************
//Globals:    $Conn - Creates Connection to database
//            $numUsers - Stores number of users in usersDB
//            $
$currentStartId;
$currentEndId;
$dateTime;
$conn;
$differenceInFollowers;

run();



function run (){

twitterDBRunInfo();
twitterApiRun();

}

////-------------------------------------------------------------------------------
//Name: twitterDBRunInfo
//Description: Collects all the info needed for running the twitter api call such as which Users
//info to collect and at what date the run was done on
//Methods Called: RunQuery();
//Variables: $conn - Connection to DB. $numUsers - Number of users in db
//$dateTime - Current date and time. $LastRunEndId - Where the last run ended.
////-------------------------------------------------------------------------------

function twitterDBRunInfo (){
    global $currentStartId;
        global $currentEndId;
        global $dateTime;
        global $numUsers;

        $LastRunEndId;
        $numUsers;



$conn = db();
 $numUsers = getNumUsers();
$dateTime = getDateTime();
$LastRunEndId = getLastRunEndId();
$currentStartId = getStartId($LastRunEndId, $numUsers);
$currentEndId = getEndId($LastRunEndId, $numUsers, $currentStartId);

}

function twitterApiRun(){
        global $currentStartId;
        global $currentEndId;
           global $numUsers;
        global $dateTime;
        global $conn;
                global $differenceInFollowers;

    $usersArray = getUsers($currentStartId,$currentEndId,$numUsers);
addTwitterDbUpdate($dateTime, $currentEndId, $numUsers,$currentStartId);
$currentGroupRunId = getLastGroupRunID();
    twitterAPI($currentGroupRunId, $usersArray,$dateTime);

}
////-------------------------------------------------------------------------------
//Name: getLasGroupRunID
//Description: Starts calling the twitter API
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------

function getLastGroupRunID(){

   $sql = "SELECT MAX(id) FROM sportssocialrank.twitter_dbupdates";
 $row =  runQuery($sql, False);
   $lastGroupRunId = $row['MAX(id)'];
   $currentGroupRunId = $lastGroupRunId;
return $currentGroupRunId;
}


////-------------------------------------------------------------------------------
//Name: twitterApi
//Description: Starts calling the twitter API
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function twitterAPI($groupdId, $usersArray,$dateTime){
    global $differenceInFollowers;

    require_once(APPPATH.'libraries/TwitterAPIExchange.php');

$settings = array(

'oauth_access_token' => "562520337-IWHslct3vqnZq9DPLHKKF7xlYrQrf5Nolatbm52T",

'oauth_access_token_secret' => "BmbHCJgoTTlhX99PjgRiN6uWqle6xJCepHvFDtNSfEHLy",

'consumer_key' => "6wR5l7KwDSDFmb6swY1seW5MP",

'consumer_secret' => "RTg9GlOPcX0YCCkodKzMzUw7z1iOdVy5fwJlD5JxbqW33XKNmL"

);

    $url = 'https://api.twitter.com/1.1/users/show.json';
    $requestMethod = 'GET';

foreach ($usersArray as &$team) {
$getfield = "?screen_name=".$team;

$url = 'https://api.twitter.com/1.1/users/show.json';

$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);

$json =  $twitter->setGetfield($getfield)

                 ->buildOauth($url, $requestMethod)

                 ->performRequest();

$twitterInfo = json_decode($json);

$teamDisplayName = $twitterInfo->screen_name;

$followersAtCurrentTime = $twitterInfo->followers_count;
$differenceInFollowers = getDayFollowerCount($followersAtCurrentTime,$teamDisplayName);
insertTwitterArchive($groupdId, $twitterInfo,$differenceInFollowers );
insertTwitter($groupdId, $twitterInfo, $differenceInFollowers);

}






    }


////-------------------------------------------------------------------------------
//Name: insertIntoArchiveDB
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function insertTwitterArchive($groupdId, $twitterInfo,$differenceInFollowers){

$date = getDateTime();
    $sql = "INSERT INTO twitter_archive (group_run_id, name, date, display_name, followers, following, profile_image_url, profile_banner_url,followers_today_count) "
        . "VALUES ('$groupdId', '$twitterInfo->name','$date', '$twitterInfo->screen_name','$twitterInfo->followers_count','$twitterInfo->friends_count','$twitterInfo->profile_image_url','$twitterInfo->profile_banner_url','$differenceInFollowers')";
    runQuery($sql, True);

}




////-------------------------------------------------------------------------------
//Name: insertTwitter
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function insertTwitter($groupdId, $twitterInfo,$differenceInFollowers){

 $sql =  "SELECT id FROM twitter WHERE display_name =  '".$twitterInfo->screen_name."';";
   $row =  runQuery($sql, False);
     $id = $row['id'];
     $date  = getDateTime();

 if($id == null){
    $sql = "INSERT INTO twitter (group_run_id, name,date, display_name, followers, following, profile_image_url, profile_banner_url,followers_today_count) "
        . "VALUES ('$groupdId','$twitterInfo->name','$date', '$twitterInfo->screen_name','$twitterInfo->followers_count','$twitterInfo->friends_count','$twitterInfo->profile_image_url','$twitterInfo->profile_banner_url','$differenceInFollowers')";
    runQuery($sql, True);
}
else{

$sql = "UPDATE twitter SET name ='".$twitterInfo->name."',date='".$date."',group_run_id='".$groupdId."', display_name = '".$twitterInfo->screen_name."',followers ='".$twitterInfo->followers_count.
       "', following ='".$twitterInfo->friends_count."' , profile_image_url ='".
        $twitterInfo->profile_image_url."' , profile_banner_url ='".$twitterInfo->profile_banner_url."', "
        . "followers_today_count ='".$differenceInFollowers."'
WHERE display_name = '".$twitterInfo->screen_name."';";
    runQuery($sql, True);

}
}


////-------------------------------------------------------------------------------
//Name: getDayFollowerCount
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function getDayFollowerCount($followersAtCurrentTime,$teamDisplayName){


    $date = getDateShort();

    $sql = "SELECT followers FROM twitter_archive WHERE date BETWEEN '".$date." 00:00:00' AND '". $date ." 23:59:59' and display_name= '". $teamDisplayName. "'  ORDER BY id ASC LIMIT 1;";
    $row = runQuery($sql,false);
$startOfDayFollowers = $row['followers'];

if($startOfDayFollowers== null){

    return null;
}
$differenceInFollowers = $followersAtCurrentTime -$startOfDayFollowers;
return $differenceInFollowers;
}


////-------------------------------------------------------------------------------
//Name: getUsers
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------

function getUsers($currentStartId,$currentEndId,$numUsers){
    global $conn;
    if($currentEndId > $currentStartId){
    $sql = "SELECT Twitter_username FROM users WHERE id BETWEEN ". $currentStartId . " and ". $currentEndId;
    }
    else{
     $sql = "SELECT Twitter_username FROM users WHERE (id BETWEEN ". $currentStartId . " and ". $numUsers . ") AND (id BETWEEN 1 and ". $currentEndId . ")";

    }

    $result = $conn->query($sql);


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $usersArray[] = $row['Twitter_username'];

    }

} else {

    echo "0 results";

}

$str = implode (", ", $usersArray);
return $usersArray;

}


function db () {
global $conn;

$usersArray = array();
$servername = "sportssocialrank.db.10366090.db2.hostedresource.net";
$username = "sportssocialrank";
$password = "LLRo1984!123";
$dbname = "sportssocialrank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}
    return $conn;
}

////-------------------------------------------------------------------------------
//Name: getNumUsers
//Description: Get number of users
//SQL Query: SELECT COUNT(*) FROM users;"
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------

function getNumUsers(){
$sql = "SELECT COUNT(*) FROM users;";
$row = runQuery($sql,false);
$numUsers = $row['COUNT(*)'];
return $numUsers;
}


////-------------------------------------------------------------------------------
//Name: getDateTime
//Description: Gets Current date aand time in this format '2018-10-19 15:03:19'
////-------------------------------------------------------------------------------

function getDateTime(){
date_default_timezone_set('America/Chicago');
$dateTime = date('Y-m-d G:i:s', time());
  return $dateTime;
}


function getDateShort(){
date_default_timezone_set('America/Chicago');
$date = date('Y-m-d');
  return $date;
}
////-------------------------------------------------------------------------------
//Name: getLastRunEndId
//Description: Queries database to find where the last run ended
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------

function getLastRunEndId(){
$sql = "SELECT * FROM sportssocialrank.twitter_dbupdates;";
$row = runQuery($sql,false);
$endId = $row['endId'];
return $endId;
}

////-------------------------------------------------------------------------------
//Name: getStartId
//Description: Finds which Id the new run should start on
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------


function getStartId($LastRunEndId,$numUsers){

//Check if Users less then 900, if so start start at 0
    if($numUsers < 900){
        $currentStartId = 1;

        return $currentStartId;
        }

//Check if Run will not reach end of Users

    elseif($LastRunEndId + 900 < $numUsers){

         $currentStartId = $LastRunEndId + 1;
        return $currentStartId;
        }

   //If Run reaches end of Users

    else{
            $currentStartId = $LastRunEndId + 1;
        return $currentStartId;
    }


}


////-------------------------------------------------------------------------------
//Name: getEndId
//Description: Finds which Id the new run should end on
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------


function getEndId($LastRunEndId,$numUsers,$currentStartId){

//Check if Users less then 900, if so start start at 0
    if($numUsers < 900){

        $currentEndId = $numUsers;
        return $currentEndId;
        }

//Check if Run will not reach end of Users

    elseif($LastRunEndId + 900 < $numUsers){

         $currentEndId = $currentStartId + 900;
                 return $currentEndId;

        }

   //If Run reaches end of Users

    else{
            $numDistance = $numUsers - $currentStartId;
            $currentEndId = 900 - $numDistance;
                    return $currentEndId;

    }


}


function addTwitterDbUpdate($dateTime, $currentEndId, $numUsers,$currentStartId){

$sql = "INSERT INTO twitter_dbupdates (date, startId, endId, totalUsers)" . "VALUES "
        . "('$dateTime','$currentStartId', '$currentEndId','$numUsers')";
runQuery($sql,true);


}


function runQuery($sql,$Insert){

   echo $sql . PHP_EOL;
    global $conn; // Now all instances where the function refers to $x will refer to the GLOBAL version of $x, **not** just $x inside the function itself
$result = $conn->query($sql);

if($Insert != True){
$row = mysqli_fetch_array($result);
return $row;
}

}




?>
