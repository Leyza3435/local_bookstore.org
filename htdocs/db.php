<?php
$dataserver = "127.0.0.1";
$username = "mariadb";
$password = "mariadb";
$DatabaseName = "mariadb";

// Create connection
$conn = new mysqli($dataserver, $username, $password, $DatabaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
