<?php
// Start the session
session_start();

//Verify profile
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {
    //Initiate deletion
    //Database Connection
    require ('../components/database.php');

    //Get vehicle ID
    if(isset($_GET['vehicleID'])) {
        $vehicleID = $_GET['vehicleID'];
    }

    //DELETE THE VEHICLE PLUS IMAGES STORED IN THE DATABASE IN /INVENTORY
    $sql = "SELECT * FROM vehicles WHERE vehicleID = $vehicleID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $images = explode(",", $row['images']);
    foreach($images as $image) {
        $image = '../inventory/'.$image;
        unlink($image);
    }

    //Delete the vehicle
    $sql = "DELETE FROM vehicles WHERE vehicleID = $vehicleID";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Vehicle deleted successfully");
        window.history.back();
        </script>';
    } else {
        echo "<script>alert('Error deleting record: ' . $conn->error;');
        window.history.back();
        </script>";
    }

} else {
    echo '<script>alert("You are not authorized to complete this process");
    window.location.href = "/index.php";
    </script>';
}

//Delete car from database

?>