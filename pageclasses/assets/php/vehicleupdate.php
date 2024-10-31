<?php
// Session management
session_start();

// Database connection
require_once '../../../components/database.php';

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin')
    {
        //If submission method is correct
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Prepared data for insertion
            $vehicleID = ($_POST['vehicleID']) ?? null;
            $price = ($_POST['price']) ?? null;
            $mileage = ($_POST['mileage']) ?? null;
            $YOM = ($_POST['YOM']) ?? null;
            $pricestatus = ($_POST['pricestatus']) ?? null;
            $collection = ($_POST['collection']) ?? null;
            $availability = ($_POST['availability']) ?? null;
            $plates = ($_POST['plates']) ?? null;

            //prepared statement
            $stmt = $conn->prepare("UPDATE vehicles SET price = ?, mileage = ?, YOM = ?, pricestatus = ?, collection = ?, availability = ?, plates = ? WHERE vehicleID = ?");
            $stmt->bind_param("iiissssi", $price, $mileage, $YOM, $pricestatus, $collection, $availability, $plates ,$vehicleID);
            $stmt->execute();

            //If the query is successful
            if ($stmt->affected_rows === 1)
            {
                echo '<script>alert("Vehicle updated successfully");
                window.location.href = "/productpages/viewer/index.php?vehicleID='.$vehicleID.'";
                </script>';
                $stmt->close();
                $conn->close();
            }
            else
            {
                echo '<script>alert("Vehicle update failed");
                window.history.back();
                </script>';
                $stmt->close();
                $conn->close();
            }
        }
        else
        {
            echo '<script>alert("Invalid request method");
            window.history.back();
            </script>';
            $conn->close();
        }
    }
    else
    {
        echo '<script>alert("You are not authorized to access this page");
        window.location.href = "/index.php";
        </script>';
        $conn->close();
    }
}
else
{
    echo '<script>alert("You are not logged in");
    window.location.href = "/forms/login.html";
    </script>';
    $conn->close();
}
?>