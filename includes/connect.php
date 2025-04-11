<?php


$servername = "127.0.0.1"; // Database server name
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "oop"; // Database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 for Arabic support
$conn->set_charset("utf8");






?>



