<?php
// Database connection
session_start();
require ('../../../../components/database.php');
require_once('../../../../loader.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productName = $_POST['productName'];
    $productDesc = $_POST['productDesc'];
    $price = $_POST['price'];
    $pricestatus = $_POST['pricestatus'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $userID = $_SESSION['userID'];
    $availability = $_POST['availability'];

    // Handle the image uploads
    $images = $_FILES['images'];
    $uploadedImages = [];
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    $uploadDir = '../../../../inventory/'; // Ensure this directory exists and is writable

    // Process each uploaded image
    foreach ($images['tmp_name'] as $key => $imageTmpName) {
        $imageName = $images['name'][$key];
        $imageSize = $images['size'][$key];
        $imageError = $images['error'][$key];

        if ($imageError === 0 && $imageSize <= $maxFileSize) {
            $imageType = mime_content_type($imageTmpName);
            if (in_array($imageType, $allowedTypes)) {
                $imagePath = $uploadDir . basename($imageName);
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $uploadedImages[] = $imagePath; // Store image paths in an array
                } else {
                    echo '<script>
                alert("Error uploading file: $imageName");
                window.history.back();
                </script>';
                }
            } else {
                echo '<script>
                alert("Invalid file type");
                window.history.back();
                </script>';
            }
        } else {
            echo '<script>
            alert("Error uploading file: $imageName");
            window.history.back();
            </script>';
        }
    }

    // Convert image paths array to JSON string for storing in the database
    $images = json_encode($uploadedImages);

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO products (productName, productDesc, price, pricestatus, quantity, category, subcategory, userID, images, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisiisiss", $productName, $productDesc, $price, $pricestatus, $quantity, $category, $subcategory, $userID, $images, $availability);

    // Execute statement and check for success
    if ($stmt->execute()) {
        echo '<script>
                alert("Product has been suceessfully added!");
                window.location.href = "/profile/sellerprofile/index.php";
                </script>';
    } else {
        echo '<script>
                alert("Error uploading product");
                window.history.back();
                </script>';
    }

    $stmt->close();
}
?>