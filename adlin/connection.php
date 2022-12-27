<?php

$servername = "localhost";
$username = "rc150757_restorent08";
$password = "Dz%Da=!p3q_#";
$database = "rc150757_restorent";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>