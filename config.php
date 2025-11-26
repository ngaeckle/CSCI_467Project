<?php

$host = "localhost";
$db = "csci_467";
$username = "root";
$password = "";   

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Initialize the MySQLi connection
$conn2 = mysqli_init();
// Check if initialization failed
if (!$conn2) {
    die('mysqli_init failed');
}
// Attempt to connect to the MySQL server with SSL
if (!mysqli_real_connect($conn2, $servername, $username, $password, $dbname, 3306
, NULL, MYSQLI_CLIENT_SSL)) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error
());
}
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
