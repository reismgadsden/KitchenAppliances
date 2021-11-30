<?php
$servername = "localhost";
$username = "id18006240_gadsdenrm";
$password = "Appstate123!";
$dbname = "id18006240_kitchenappliances";


// Create connection
$mysqli_conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
} 
?>
