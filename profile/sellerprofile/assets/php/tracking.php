<?php

//Database Connection
require ('../../../../components/database.php');

//Session
session_start();

//Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderID = $_POST['orderID'];
    $sellerUID = $_POST['sellerUID'];
    $status = $_POST['status'];

    //Insert into database
    $sql = "UPDATE orders SET status = '$status' WHERE orderID = '$orderID' AND sellerUID = '$sellerUID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Status updated successfully!');
        window.history.back();
        </script>";
    } else {
        echo "<script>alert('Failed to update status!');
        window.history.back();
        </script>";
    }
}
?>