<?php
require('../../../components/database.php'); // Database connection

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $buyerUID = $_POST['userID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $totalPrice = $_POST['totalPrice'];

    // Retrieve cart details
    $itemNames = json_decode($_POST['itemNames'], true);
    $itemQuantities = json_decode($_POST['itemQuantities'], true);
    $itemPrices = json_decode($_POST['itemPrices'], true);
    $itemTotalPrices = json_decode($_POST['itemTotalPrices'], true);
    $sellerUID = json_decode($_POST['sellerUID'], true);

    $status = 'Pending';

    // Save order to the database
    $stmt = $conn->prepare("INSERT INTO orders (buyerUID, fname, lname, email, city, address, phone, totalPrice,  itemNames, itemQuantities, itemPrices, itemTotalPrices, sellerUID, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssisssssiss", $buyerUID, $fname, $lname, $email, $city, $address, $phone, $totalprice, $itemNames, $itemQuantities, $itemPrices, $itemTotalPrices, $sellerUID, $status);

    if ($stmt->execute()) {
        echo '<script>
            alert("Order placed successfully!");
            window.location.href = "/index.php";
        </script>';
    } else {
        echo '<script>
            alert("Failed to place order. Please try again.");
            window.location.href = "/index.php";
        </script>';
    }

    $stmt->close();
}

$conn->close();
?>
