<?php
$servername = "localhost"; // Change this to your database server name
$susername = "root"; // Change this to your database username
$spassword = ""; // Change this to your database password
$sdatabase = "ts"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $susername, $spassword, $sdatabase);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else

echo "";

// Close connection




//write query for all customer
//$sql = 'SELECT * FROM customer';

//make query & get result
//$cusresult = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
//$customer = mysqli_fetch_all($cusresult, MYSQLI_ASSOC);
//$customer = mysqli_fetch_assoc($cusresult);

//free result from memory
//mysqli_free_result($cusresult);

//close the connection
//mysqli_close($conn);

//explode('@', $customer[0]['email']);

?>
