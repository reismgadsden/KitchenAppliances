<?php
$servername = "localhost";
$username = "root";
$password = "Kaori1234";
$dbname = "KitchenAppliance";


// Create connection
$mysqli_conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
} 
?>
