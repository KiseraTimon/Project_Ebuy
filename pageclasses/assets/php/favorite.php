<?php
// Session start
session_start();
// Database Connection
require_once '../../../components/database.php';

// Check if the user is logged in and the vehicleID is provided
if (isset($_POST['vehicleID']) && isset($_POST['userID'])) {
    $vehicleID = $_POST['vehicleID'];
    $userID = $_POST['userID'];

    $checkQuery = "SELECT * FROM favorites WHERE vehicleID = ? AND userID = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param('ii', $vehicleID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert if the vehicle is not a favorite
        $insertQuery = "INSERT INTO favorites (vehicleID, userID) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('ii', $vehicleID, $userID);
        
        if ($stmt->execute()) {
            echo "<script>alert('Vehicle added to favorites');
                window.location.href='/productpages/viewer/index.php?vehicleID=$vehicleID';
                </script>";
        } else {
            echo "<script>alert('Error adding vehicle to favorites');
                window.history.back();
                </script>";
        }
    } else { // If the vehicle is already a favorite, remove it
        // Remove the vehicle from the favorites table
        $deleteQuery = "DELETE FROM favorites WHERE vehicleID = ? AND userID = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param('ii', $vehicleID, $userID);

        if ($stmt->execute()) {
            echo "<script>alert('Vehicle removed from favorites');
            window.location.href='/productpages/viewer/index.php?vehicleID=$vehicleID';
            </script>";
        } else {
            echo "<script>alert('Error removing vehicle from favorites');
            window.history.back();
            </script>";
        }
    }

    $stmt->close();
} else {
    echo "<script>alert('Login to add vehicles to favorites');
            window.location.href='/forms/login.html';
            </script>";
}

$conn->close();
?>
