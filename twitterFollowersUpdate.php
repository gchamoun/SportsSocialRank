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



function run()
{
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

function twitterDBRunInfo()
{
    global $currentStartId;
    global $currentEndId;
    global $dateTime;
    global $numUsers;
    global $categoryList;

    $LastRunEndId;
    $numUsers;



    $conn = db();
    $numUsers = getNumUsers();
    $dateTime = getDateTime();
    $LastRunEndId = getLastRunEndId();
    $currentStartId = getStartId($LastRunEndId, $numUsers);
    $currentEndId = getEndId($LastRunEndId, $numUsers, $currentStartId);
}

function twitterApiRun()
{
    global $currentStartId;
    global $currentEndId;
    global $numUsers;
    global $dateTime;
    global $conn;
    global $differenceInFollowers;

    $usersArray = getUsers($currentStartId, $currentEndId, $numUsers);
    addTwitterDbUpdate($dateTime, $currentEndId, $numUsers, $currentStartId);
    $currentGroupRunId = getLastGroupRunID();
    twitterAPI($currentGroupRunId, $usersArray, $dateTime);
    insertTwitterRank($currentGroupRunId);
}
////-------------------------------------------------------------------------------
//Name: getLasGroupRunID
//Description: Starts calling the twitter API
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------

function getLastGroupRunID()
{
    $sql = "SELECT MAX(id) FROM sportssocialrank.twitter_dbupdates";
    $row =  runQuery($sql, false);
    $lastGroupRunId = $row['MAX(id)'];
    $currentGroupRunId = $lastGroupRunId;
    return $currentGroupRunId;
}


////-------------------------------------------------------------------------------
//Name: twitterApi
//Description: Starts calling the twitter API
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function twitterAPI($groupdId, $usersArray, $dateTime)
{
    global $differenceInFollowers;

    require_once('TwitterAPIExchange.php');

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
        $differenceInFollowers = getDayFollowerCount($followersAtCurrentTime, $teamDisplayName);
        insertTwitterArchive($groupdId, $twitterInfo, $differenceInFollowers);
        insertTwitter($groupdId, $twitterInfo, $differenceInFollowers);
    }
}


////-------------------------------------------------------------------------------
//Name: insertIntoArchiveDB
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function insertTwitterArchive($groupdId, $twitterInfo, $differenceInFollowers)
{
    $sql = 'SELECT id FROM twitter_accounts where screen_name ="'.$twitterInfo->screen_name.'"';
    $row = runQuery($sql, false);
    $accounts_id = $row['id'];


    $sql = "INSERT INTO twitter_data_archive (twitter_accounts_id, twitter_dbupdates_id, name, display_name, followers, following, profile_image_url, profile_banner_url,followers_today_count) "
    . "VALUES ('$accounts_id','$groupdId', '$twitterInfo->name','$twitterInfo->screen_name','$twitterInfo->followers_count','$twitterInfo->friends_count','$twitterInfo->profile_image_url','$twitterInfo->profile_banner_url','$differenceInFollowers')";
    runQuery($sql, true);
}





////-------------------------------------------------------------------------------
//Name: insertTwitter
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function insertTwitter($groupdId, $twitterInfo, $differenceInFollowers)
{
    $sql =  "SELECT id FROM twitter_data WHERE display_name =  '".$twitterInfo->screen_name."';";
    $row =  runQuery($sql, false);
    $id = $row['id'];
    $date  = getDateTime();
    if ($id == null) {
        $sql = 'SELECT id FROM twitter_accounts where screen_name ="'.$twitterInfo->screen_name.'"';
        $row = runQuery($sql, false);
        $accounts_id = $row['id'];

        $sql = "INSERT INTO twitter_data(twitter_accounts_id, twitter_dbupdates_id, name, date, display_name, followers, following, profile_image_url, profile_banner_url,followers_today_count) "
       . "VALUES ('$accounts_id','$groupdId', '$twitterInfo->name','$date', '$twitterInfo->screen_name','$twitterInfo->followers_count','$twitterInfo->friends_count','$twitterInfo->profile_image_url','$twitterInfo->profile_banner_url','$differenceInFollowers')";

        runQuery($sql, true);
    } else {
        $sql = "UPDATE twitter_data SET name ='".$twitterInfo->name."',date='".$date."',twitter_dbupdates_id='".$groupdId."', display_name = '".$twitterInfo->screen_name."',followers ='".$twitterInfo->followers_count.
       "', following ='".$twitterInfo->friends_count."' , profile_image_url ='".
        $twitterInfo->profile_image_url."' , profile_banner_url ='".$twitterInfo->profile_banner_url."', "
        . "followers_today_count ='".$differenceInFollowers."'
WHERE display_name = '".$twitterInfo->screen_name."';";
        runQuery($sql, true);
    }
}

////-------------------------------------------------------------------------------
//Name: insertTwitterRank
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function insertTwitterRank($currentGroupRunId)
{
    global $conn;
    global $categoryIdList;
    $dateTime = getDateTime();
    $oneDayAgo = date_modify($dateTime, '+1 day');
    $oneWeekAgo = date_modify($dateTime, '+7 day');
    $oneMonthAgo = date_modify($dateTime, '+1 month');
    $oneYearAgo = date_modify($dateTime, '+1 year');

    $sql =  "SELECT id FROM sportssocialrank.category_details";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categoryIdList[] = $row['id'];
        }


        foreach ($categoryIdList as $categoryId) {
            $sql = "SELECT  twitter_data.twitter_accounts_id FROM accounts
                    INNER JOIN accounts_category ON accounts.id = accounts_category.accounts_id
                    INNER JOIN category_details ON category_details.id = accounts_category.category_details_id
                    INNER JOIN twitter_accounts ON twitter_accounts.accounts_id = accounts.id
                    INNER JOIN twitter_data ON twitter_data.twitter_accounts_id = twitter_accounts.id
                    where accounts_category.category_details_id ='".$categoryId."' ORDER BY followers DESC LIMIT 0, 5000";
            $result = $conn->query($sql);
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                $twitterAccounts_id = $row['twitter_accounts_id'];


                //Get Rank from a day ago
                $sql = "select * from twitter_rank_archive tr inner join
  twitter_dbupdates td on tr.twitter_dbupdates_id = td.id
  where tr.twitter_accounts_id = '".$twitterAccounts_id."' and tr.category_details_id = '".$categoryId."'
  and date < '".$oneDayAgo."'order by date desc limit 1";
                $rankings = runQuery($sql, false);
                $rankOneDayAgo = $rankings['rank'];
                //Get Rank from a week ago
                $sql = "select * from twitter_rank_archive tr inner join
                  twitter_dbupdates td on tr.twitter_dbupdates_id = td.id
                  where tr.twitter_accounts_id = '".$twitterAccounts_id."' and tr.category_details_id = '".$categoryId."'
                  and date < '".$oneWeekAgo."'order by date desc limit 1";
                $rankings = runQuery($sql, false);
                $rankOneWeekAgo = $rankings['rank'];
                //Get Rank from a month ago
                $sql = "select * from twitter_rank_archive tr inner join
                  twitter_dbupdates td on tr.twitter_dbupdates_id = td.id
                  where tr.twitter_accounts_id = '".$twitterAccounts_id."' and tr.category_details_id = '".$categoryId."'
                  and date < '".$oneMonthAgo."'order by date desc limit 1";
                $rankings = runQuery($sql, false);
                $rankOneMonthAgo = $rankings['rank'];
                //Get Rank from a year ago
                $sql = "select * from twitter_rank_archive tr inner join
                  twitter_dbupdates td on tr.twitter_dbupdates_id = td.id
                  where tr.twitter_accounts_id = '".$twitterAccounts_id."' and tr.category_details_id = '".$categoryId."'
                  and date < '".$oneYearAgo."'order by date desc limit 1";
                $rankings = runQuery($sql, false);
                $rankOneYearAgo = $rankings['rank'];

                $sql = "select * from twitter_rank_archive where twitter_accounts_id = '".$twitterAccounts_id."' and tr.category_details_id = '".$categoryId."'";
                $rankId = runQuery($sql, false);
                $idRanking = $rankId['id'];
                if ($idRanking == null) {
                    $sql = "INSERT INTO twitter_rank (rank, twitter_accounts_id, twitter_dbupdates_id, category_details_id,rank_day_change,rank_week_change,rank_month_change,rank_year_change)" . "VALUES "
                    . "('$i','$twitterAccounts_id', '$currentGroupRunId','$categoryId','$rankOneDayAgo','$rankOneWeekAgo','$rankOneMonthAgo','$rankOneYearAgo')";
                    runQuery($sql, true);
                } else {
                    $sql = "UPDATE twitter_rank SET rank ='".$i."',twitter_dbupdates_id='".$currentGroupRunId."', rank_day_change ='".$rankOneDayAgo.
             "', rank_week_change ='".$rankOneWeekAgo."' , rankOneMonthAgo ='".
              $rankOneMonthAgo."' , rankOneYearAgo ='".$rankOneYearAgo."'
      WHERE twitter_account_id = '".$twitterAccounts_id."' and category_details_id = '".$categoryId."';";
                    runQuery($sql, true);
                }

                $sql = "INSERT INTO twitter_rank_archive (rank, twitter_accounts_id, twitter_dbupdates_id, category_details_id,rank_day_change,rank_week_change,rank_month_change,rank_year_change)" . "VALUES "
                  . "('$i','$twitterAccounts_id', '$currentGroupRunId','$categoryId','$rankOneDayAgo','$rankOneWeekAgo','$rankOneMonthAgo','$rankOneYearAgo')";
                runQuery($sql, true);
            }
        }
    }
}
////-------------------------------------------------------------------------------
//Name: getDayFollowerCount
//Description: Queries database to find which users to include in run
//SQL Query: SELECT * FROM sportssocialrank.twitter_dbupdates;
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------
function getDayFollowerCount($followersAtCurrentTime, $teamDisplayName)
{
    $date = getDateShort();

    $sql = "SELECT followers FROM twitter_data_archive WHERE date BETWEEN '".$date." 00:00:00' AND '". $date ." 23:59:59' and display_name= '". $teamDisplayName. "'  ORDER BY id ASC LIMIT 1;";
    $row = runQuery($sql, false);
    $startOfDayFollowers = $row['followers'];

    if ($startOfDayFollowers== null) {
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

function getUsers($currentStartId, $currentEndId, $numUsers)
{
    global $conn;

    $sql = "SELECT MIN(id) FROM sportssocialrank.twitter_accounts";
    $row =  runQuery($sql, false);
    $minId = $row['MIN(id)'];
    $sql = "SELECT MAX(id) FROM sportssocialrank.twitter_accounts";
    $row =  runQuery($sql, false);
    $maxId = $row['MAX(id)'];
    if ($currentStartId>$currentEndId) {
        $sql = "SELECT screen_name FROM twitter_accounts where (id BETWEEN '$currentStartId' AND '$numUsers') or (id BETWEEN 1 and '$currentEndId')";
    } else {
        $sql = "SELECT screen_name FROM twitter_accounts where id BETWEEN '$currentStartId' AND '$currentEndId'";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usersArray[] = $row['screen_name'];
        }
    } else {
    }
    $str = implode(", ", $usersArray);
    return $usersArray;
}


function db()
{
    global $conn;

    $usersArray = array();
    $servername = "198.12.152.136:3306";
    $username = "SportsSocialRank";
    $password = "Mom9015222!";
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

function getNumUsers()
{
    $sql = "SELECT MAX(id) FROM sportssocialrank.twitter_accounts";
    $row =  runQuery($sql, false);
    $maxId = $row['MAX(id)'];
    return $maxId;
}


////-------------------------------------------------------------------------------
//Name: getDateTime
//Description: Gets Current date aand time in this format '2018-10-19 15:03:19'
////-------------------------------------------------------------------------------

function getDateTime()
{
    date_default_timezone_set('America/Chicago');
    $dateTime = date('Y-m-d G:i:s', time());
    return $dateTime;
}


function getDateShort()
{
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

function getLastRunEndId()
{
    $sql = "SELECT * FROM sportssocialrank.twitter_dbupdates ORDER BY id desc limit 1;";
    $row = runQuery($sql, false);
    $endId = $row['end_id'];
    return $endId;
}

////-------------------------------------------------------------------------------
//Name: getStartId
//Description: Finds which Id the new run should start on
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------


function getStartId($LastRunEndId, $numUsers)
{

//Check if Users less then 900, if so start start at 0
    if ($numUsers < 900) {
        $currentStartId = 1;
        return $currentStartId;
    }

    //Check if Run will not reach end of Users

    elseif ($LastRunEndId + 900 < $numUsers) {
        $currentStartId = $LastRunEndId + 1;
        return $currentStartId;
    }

    //If Run reaches end of Users

    else {
        $currentStartId = $LastRunEndId + 1;
        return $currentStartId;
    }
}


////-------------------------------------------------------------------------------
//Name: getEndId
//Description: Finds which Id the new run should end on
//Methods Called: RunQuery();
////-------------------------------------------------------------------------------


function getEndId($LastRunEndId, $numUsers, $currentStartId)
{

//Check if Users less then 900, if so start start at 0
    if ($numUsers < 900) {
        $currentEndId = $numUsers;
        return $currentEndId;
    }

    //Check if Run will not reach end of Users

    elseif ($LastRunEndId + 900 < $numUsers) {
        $currentEndId = $currentStartId + 900;
        return $currentEndId;
    }

    //If Run reaches end of Users

    else {
        $numDistance = $numUsers - $currentStartId;
        $currentEndId = 900 - $numDistance;
        return $currentEndId;
    }
}


function addTwitterDbUpdate($dateTime, $currentEndId, $numUsers, $currentStartId)
{
    $sql = "INSERT INTO twitter_dbupdates (date, start_id, end_id, total_users)" . "VALUES "
        . "('$dateTime','$currentStartId', '$currentEndId','$numUsers')";
    runQuery($sql, true);
}


function runQuery($sql, $Insert)
{
    global $conn; // Now all instances where the function refers to $x will refer to the GLOBAL version of $x, **not** just $x inside the function itself
    $result = $conn->query($sql);

    if ($Insert != true) {
        $row = mysqli_fetch_array($result);
        return $row;
    }
}
