<?php






$categoryArray = array();
$count = array();
$num_accounts;
$num_followers;
$num_followers_today;

$servername = "sportssocialrank.db.10366090.db2.hostedresource.net";

$username = "sportssocialrank";

$password = "LLRo1984!123";

$dbname = "sportssocialrank";



// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 


//move old Database
$sql = "INSERT INTO categorydata_old SELECT * FROM categorydata_new;";
$result = $conn->query($sql);
$sql = "DELETE FROM categorydata_new;";
$result = $conn->query($sql);



$sql = "SELECT DISTINCT category FROM users";
$result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $categoryArray[] = $row['category'];

    }

} else {

    echo "0 results";

}

$str = implode (", ", $categoryArray);

foreach ($categoryArray as &$category){

//get number of accounts
$sql = "SELECT COUNT(*) FROM users WHERE category = '$category'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$num_accounts = $row['COUNT(*)'];
echo '$sql';
echo "\r\n";
//get number of followers
$sql = "SELECT sum(followers)
FROM users
INNER JOIN twitterdata_new ON users.Twitter_username = twitterdata_new.display_name
Where category = '$category'
;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$num_followers = $row['sum(followers)'];
echo $sql;
echo "\r\n";


//get number of followers today
$sql = "SELECT sum(followers_today_count)
FROM users
INNER JOIN twitterdata_new ON users.Twitter_username = twitterdata_new.display_name
Where category = '$category'
;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$num_followers_today = $row['sum(followers_today_count)'];
echo $sql;
echo "\r\n";






//update Database

$sql = "INSERT INTO categorydata_new (name,  num_teams, followers, followers_today_count) VALUES ('$category', '$num_accounts','$num_followers','$num_followers_today')";

echo $sql;
echo "\r\n";


if ($conn->query($sql) === TRUE) {


} else {




}
}


$conn->close();


?>


