<?php
$servername = "localhost";
$username = "root";
$password = "jb9faqmu";
$dbname = "php_mysql_crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
