<?php
require('../../../components/database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buyer Details
    $buyerUID = $_POST['userID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Product and Seller Details
    $itemNames = json_encode(json_decode($_POST['names'], true)); // Encode arrays to store in TEXT fields
    $itemQuantities = json_encode(json_decode($_POST['quantities'], true));
    $itemPrices = json_encode(json_decode($_POST['prices'], true));
    $itemTotalPrices = json_encode(json_decode($_POST['totalPrices'], true));
    $sellerUIDs = json_encode(json_decode($_POST['sellerUIDs'], true));

    // Calculate total price
    $totalPrice = array_sum(json_decode($_POST['totalPrices'], true));

    // Status of the order
    $status = 'Pending';

    // Prepare and execute the query
    $stmt = $conn->prepare("INSERT INTO orders (buyerUID, fname, lname, email, city, address, phone, totalPrice, itemNames, itemQuantities, itemPrices, itemTotalPrices, sellerUID, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('isssssisssssss', $buyerUID, $fname, $lname, $email, $city, $address, $phone, $totalPrice, $itemNames, $itemQuantities, $itemPrices, $itemTotalPrices, $sellerUIDs, $status);

    if ($stmt->execute()) {

        //Mailer & Prompt Sessions
        $_SESSION['buyerUID'] = $buyerUID;
        $_SESSION['buyerFname'] = $fname;
        $_SESSION['buyerLname'] = $lname;
        $_SESSION['buyerCity'] = $city;
        $_SESSION['buyerAddress'] = $address;
        $_SESSION['buyerEmail'] = $email;
        $_SESSION['buyerPhone'] = $phone;
        $_SESSION['totalPrice'] = $totalPrice;
        $_SESSION['itemNames'] = $itemNames;

        echo '<script>
            alert("Your order has been placed successfully! You will receive an email and a prompt shortly to verify and complete payment");
            localStorage.clear();
            window.location.href = "/PHPMailer/mail.php";
        </script>';
    } else {
        echo '<script>
            alert("Failed to place your order. Please try again.");
            window.history.back();
        </script>';
    }

    $stmt->close();
    $conn->close();
}
?>
