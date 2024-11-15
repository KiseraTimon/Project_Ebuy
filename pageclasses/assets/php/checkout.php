<?php

//Database connection
require ('../components/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Populating variables
    $userID = $_POST['userID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    //Check if any field is empty
    if (empty($userID) || empty($fname) || empty($lname) || empty($email) || empty($city) || empty($address) || empty($phone))
    {
        echo '<script>
        alert("Please fill in all fields to proceed with checkout");
        window.location.href="checkout.php";
        </script>';
        exit;
    }

    //Check if cart is empty
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart']))
    {
        echo '<script>
        alert("Your cart is empty. Please add items to proceed with checkout");
        window.location.href="index.php";
        </script>';
        exit;
    }

    //Insert order into database
    $sql = "INSERT INTO orders (userID, orderDate, orderStatus, orderFname, orderLname, orderEmail, orderCity, orderAddress, orderPhone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssss", $userID, $date, $status, $fname, $lname, $email, $city, $address, $phone);

    $date = date("Y-m-d H:i:s");
    $status = "Pending";

    if ($stmt->execute())
    {
        $orderID = $conn->insert_id;

        //Insert order items into database
        $cart = $_SESSION['cart'];
        $sql = "INSERT INTO orderitems (orderID, productID, quantity) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $orderID, $productID, $quantity);

        foreach ($cart as $productID => $item)
        {
            $productID = $productID;
            $quantity = $item['quantity'];

            if (!$stmt->execute())
            {
                echo '<script>
                alert("Failed to insert order items into database");
                window.location.href="checkout.php";
                </script>';
                exit;
            }
        }

        //Clear cart
        unset($_SESSION['cart']);
        echo '<script>
        alert("Order placed successfully");
        window.location.href="index.php";
        </script>';
        exit;
    }
    else
    {
        echo '<script>
        alert("Failed to insert order into database");
        window.location.href="checkout.php";
        </script>';
        exit;
    }
}

$conn->close();
?>