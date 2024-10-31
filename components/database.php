<?php
// Database connection
$servername = 'localhost';
$username = 'root';
$password_db = 'timonkisera123456_';
$dbname = 'cardepot';


$conn = new mysqli($servername, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>