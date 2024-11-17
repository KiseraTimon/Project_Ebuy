<?php
// Start session
session_start();

// Include the database connection
require ('../../../components/database.php');

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    echo '<script>
            alert("Please login to access this page.");
            window.location.href = "/pages/login.php";
        </script>';
    exit;
}

// Get the current user's ID
$userID = $_SESSION['userID'];

// Check if the form was submitted
if (isset($_POST['update'])) {
    // Initialize the array to store updated fields
    $updateFields = [];
    $bindParams = [];
    $bindTypes = '';

    // Get form inputs and only add non-empty fields to the update query
    if (!empty($_POST['fname'])) {
        $updateFields[] = "fName = ?";
        $bindParams[] = $_POST['fname'];
        $bindTypes .= 's';
    }

    if (!empty($_POST['lname'])) {
        $updateFields[] = "lName = ?";
        $bindParams[] = $_POST['lname'];
        $bindTypes .= 's';
    }

    if (!empty($_POST['uname'])) {
        $updateFields[] = "uname = ?";
        $bindParams[] = $_POST['uname'];
        $bindTypes .= 's';
    }

    if (!empty($_POST['email'])) {
        $updateFields[] = "email = ?";
        $bindParams[] = $_POST['email'];
        $bindTypes .= 's';
    }

    if (!empty($_POST['contact'])) {
        $updateFields[] = "contactphone = ?";
        $bindParams[] = $_POST['contact'];
        $bindTypes .= 'i';
    }

    // Handle password update if a new password is provided and confirmed
    if (!empty($_POST['password']) && !empty($_POST['confirmpassword'])) {
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirmpassword'];

        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateFields[] = "passw = ?";
            $bindParams[] = $hashedPassword;
            $bindTypes .= 's';
        } else {
            echo '<script>
                    alert("Passwords do not match.");
                    window.history.back();
                </script>';
            exit;
        }
    }

    // Handle profile picture upload if a new image is uploaded
    if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] == 0) {
    // Check file size (limit to 5MB)
    if ($_FILES['profilepic']['size'] > 5000000) {
        echo '<script>
                alert("Image size is too large. Please upload an image less than 5MB.");
                window.history.back();
            </script>';
        exit();
    }
    
    // Check for valid image types (JPEG or PNG)
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($_FILES['profilepic']['type'], $allowedTypes)) {
        echo '<script>
                alert("Image format is not supported. Please upload a JPEG or PNG image.");
                window.history.back();
            </script>';
        exit();
    }

    // No errors, process the uploaded image as a BLOB
    $profilepic = file_get_contents($_FILES['profilepic']['tmp_name']);
    $updateFields[] = "profilePic = ?";
    $bindParams[] = $profilepic;
    $bindTypes .= 'b';
    }
    else if (!isset($_FILES['profilepic']) || $_FILES['profilepic']['error'] == 4)
    {
        // If no new profile picture, keep the current one
        $profilepicQuery = "SELECT profilepic FROM users WHERE userID = ?";
        $stmt = $conn->prepare($profilepicQuery);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $profilepic = $row['profilePic'];

    }
    else if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] > 0)
    {
        // An error occurred while uploading the image
        echo '<script>
                alert("An error occurred while uploading the image. Please try again.");
                window.history.back();
            </script>';
        exit();
    }

    // Only execute the update query if there are fields to update
    if (!empty($updateFields)) {
        // Prepare the SQL query dynamically
        $sql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        
        // Append the userID to the parameters
        $bindParams[] = $userID;
        $bindTypes .= 'i';  // Integer for userID

        // Dynamically bind parameters
        $stmt->bind_param($bindTypes, ...$bindParams);

        // Send binary data separately if profilepic is included
        if (in_array('b', str_split($bindTypes))) {
            // Handle BLOB binding for the profile picture
            $stmt->send_long_data(array_search('b', str_split($bindTypes)), $profilepic);
        }

        // Execute the update query
        if ($stmt->execute()) {
            echo '<script>
                    alert("Account updated successfully.");
                    window.location.href = "/formclasses/assets/php/verifier.php";
                </script>';
        } else {
            echo '<script>
                    alert("Error updating account: ' . $stmt->error . '");
                    window.history.back();
                </script>';
        }

        $stmt->close();
    } else {
        echo '<script>
                alert("No changes made to the account.");
                window.history.back();
            </script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>
