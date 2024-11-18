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
    $sql = "UPDATE orders SET status = '$status' WHERE orderID = '$orderID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        //Fetch buyer details
        $stmt = $conn->prepare("SELECT buyerUID FROM orders WHERE orderID = ?");
        $stmt->bind_param("s", $orderID);
        $stmt->execute();
        $result = $stmt->get_result();
        $buyerUID = $result->fetch_assoc()['buyerUID'];

        //Fetch seller email
        $stmt = $conn->prepare("SELECT * FROM businesses WHERE userID = ?");
        $stmt->bind_param("s", $sellerUID);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $seller_bname = $result['bname'];
        $seller_bemail = $result['bemail'];
        $seller_bcontact = $result['bcontact'];


        //Fetch buyer email
        $stmt = $conn->prepare("SELECT * FROM users WHERE userID = ?");
        $stmt->bind_param("s", $buyerUID);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();

        $buyerEmail = $result['email'];
        $buyerfname = $result['fName'];
        $buyerlname = $result['lName'];


        //Session variables
        $request = 'productstatus';
        $_SESSION['request'] = $request;
        $_SESSION['clientmail'] = $buyerEmail;
        $_SESSION['clientfname'] = $buyerfname;
        $_SESSION['clientlname'] = $buyerlname;
        $_SESSION['seller_bname'] = $seller_bname;
        $_SESSION['seller_bemail'] = $seller_bemail;
        $_SESSION['seller_bcontact'] = $seller_bcontact;
        $_SESSION['status'] = $status;


        echo "<script>alert('Status updated successfully! The client willl receive an email regarding this change');
        window.location.href='../../../../PHPMailer/mail.php';
        </script>";
    } else {
        echo "<script>alert('Failed to update status!');
        window.history.back();
        </script>";
    }
}
?>