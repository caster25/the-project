<?php
$servername = "localhost";
$username = "dev";
$password = "Tee@75315900";
$db_name = "bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>