<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create Connection

$conn = new mysqli($servername, $username, $password);

// $test = "Select * from soccer_db.player_stats";
// $result = $conn->query($test);
// var_dump($result);

// Check Connection

if($conn->connect_error) {
	die("Connection Failed: " . $conn->connect_error);
}
else {
	//echo "Connected Successfully";
}



?>