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

    // Decode Product and Seller Details
    $itemNames = json_decode($_POST['names'], true);
    $itemQuantities = json_decode($_POST['quantities'], true);
    $itemPrices = json_decode($_POST['prices'], true);
    $itemTotalPrices = json_decode($_POST['totalPrices'], true);
    $sellerUIDs = json_decode($_POST['sellerUIDs'], true);

    // Verify all arrays have the same length
    if (
        count($itemNames) !== count($itemQuantities) || 
        count($itemNames) !== count($itemPrices) || 
        count($itemNames) !== count($itemTotalPrices) || 
        count($itemNames) !== count($sellerUIDs)
    ) {
        die("Error: Product data arrays are not of the same length.");
    }

    // Prepare the SQL query for multiple products
    $stmt = $conn->prepare("INSERT INTO orders (buyerUID, fname, lname, email, city, address, phone, totalPrice, itemNames, itemQuantities, itemPrices, itemTotalPrices, sellerUID, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $status = 'Pending'; // Order status

    // Insert each product as a separate row
    for ($i = 0; $i < count($itemNames); $i++) {
        $stmt->bind_param(
            'isssssisssssss',
            $buyerUID,
            $fname,
            $lname,
            $email,
            $city,
            $address,
            $phone,
            $itemTotalPrices[$i], // Total price for this product
            $itemNames[$i],
            $itemQuantities[$i],
            $itemPrices[$i],
            $itemTotalPrices[$i],
            $sellerUIDs[$i],
            $status
        );

        if (!$stmt->execute()) {
            echo '<script>
                alert("Failed to place your order for product: ' . $itemNames[$i] . '. Please try again.");
                window.history.back();
            </script>';
            $stmt->close();
            $conn->close();
            exit;
        }
    }

    //Mailer & Prompt Sessions (set after successful inserts)
    $_SESSION['buyerUID'] = $buyerUID;
    $_SESSION['buyerFname'] = $fname;
    $_SESSION['buyerLname'] = $lname;
    $_SESSION['buyerCity'] = $city;
    $_SESSION['buyerAddress'] = $address;
    $_SESSION['buyerEmail'] = $email;
    $_SESSION['buyerPhone'] = $phone;
    $_SESSION['totalPrice'] = array_sum($itemTotalPrices); // Total price for all items
    $_SESSION['itemNames'] = $itemNames;
    $_SESSION['request'] = 'order';

    echo '<script>
        alert("Your order has been placed successfully! You will receive an email and a prompt shortly to verify and complete payment.");
        localStorage.clear();
        window.location.href = "/PHPMailer/mail.php";
    </script>';

    $stmt->close();
    $conn->close();
}
?>
