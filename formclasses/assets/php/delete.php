<?php

//PHP to delete a user from the database
session_start();

if (isset($_SESSION['userID'])) {
    //Database connection
    require_once ('../../../components/database.php');

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Remove the user from the database
    $stmt = $conn->prepare("DELETE FROM users WHERE userID = ?");
    $stmt->bind_param("i", $_SESSION['userID']);
    $stmt->execute();
    $stmt->close();

    echo '<script>
        alert("Your account has been deleted successfully");window.location.href="/index.php";
        </script>';
}
?>