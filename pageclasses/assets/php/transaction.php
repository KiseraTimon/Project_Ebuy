<?php

require('../../../components/database.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buyer Details
    $buyerUID = $_SESSION['buyerUID'];
    $code = $_POST['code'];
    $totalPrice = $_SESSION['totalPrice'];

    $promptcode = '254KEN100G';
    $promptcode = htmlspecialchars($promptcode);


    if ($code === $promptcode) {
        // Prepare and execute the query
        $stmt = $conn->prepare("INSERT INTO transactions (userID, code, totalPrice) VALUES (? ,?, ?)");

        $stmt->bind_param('isi', $buyerUID, $code, $totalPrice);
        if ($stmt->execute()) {
            echo '<script>
                alert("Your order has been verified successfully! The shops will be notified of your purchase");
                window.location.href = "/pages/stock.php";
            </script>';
        } else {
            echo '<script>
                alert("Failed to verify your order. Try again");
                window.history.back();
            </script>';
        }

        $stmt->close();
        $conn->close();
    } else {
        echo '<script>
            alert("Invalid transaction code. Please try again.");
            // window.history.back();
        </script>';
    }
}
?>
