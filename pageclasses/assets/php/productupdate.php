<?php
// Session management
session_start();

// Database connection
require ('../../../components/database.php');

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    if(isset($_SESSION['accountType']) && $_SESSION['accountType'] == 'seller')
    {
        //If submission method is correct
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Prepared data for insertion
            $productID = ($_POST['productID']) ?? null;
            $productName = ($_POST['productName']) ?? null;
            $price = ($_POST['price']) ?? null;
            $pricestatus = ($_POST['pricestatus']) ?? null;
            $quantity = ($_POST['quantity']) ?? null;
            $availability = ($_POST['availability']) ?? null;

            //prepared statement
            $stmt = $conn->prepare("UPDATE products SET productName = ?, price = ?, pricestatus = ?, quantity = ?, availability = ? WHERE productID = ?");

            //If the query is successful
            if ($stmt->affected_rows === 1)
            {
                echo '<script>alert("Product updated successfully");
                window.location.href = "/pages/viewer/index.php?productID='.$productID.'";
                </script>';
                $stmt->close();
                $conn->close();
            }
            else
            {
                echo '<script>alert("Product update failed");
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
        echo '<script>alert("You are not authorized to modify this product");
        window.location.href = "/index.php";
        </script>';
        $conn->close();
    }
}
else
{
    echo '<script>alert("You are not logged in");
    window.location.href = "/pages/login.php";
    </script>';
    $conn->close();
}
?>