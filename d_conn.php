<?php
$servername = "localhost";
$usernme = "root";
$password = "";
$dbname = "car_monitor"; 
$conn = new mysqli("localhost", "root", "", "car_monitor");
if ($conn->connect_error) {
    die("Connection failed");
}
?>
