<?php
// Sessions
session_start();

// Database connection
$servername = 'localhost';
$username = 'root';
$password_db = 'timonkisera123456_';
$dbname = 'crochet';

$conn = new mysqli($servername, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database fields
    $fname = $_POST['fname'] ?? null;
    $lname = $_POST['lname'] ?? null;
    $uname = $_POST['uname'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $profilepic = $_FILES['profilepic']['tmp_name'];
    $userType = 'client';

    if (empty($fname) || empty($lname) || empty($uname) || empty($email) || empty($password) || empty($profilepic)) {
        echo '<script>
                alert("Please fill in all fields.");window.history.back();
                </script>';
        exit();
    } else {
        // Prepare SQL statement to insert user data and image blob
        $profilepic = $_FILES['profilepic']['tmp_name'];
        if ($_FILES['profilepic']['size'] > 1000000) { // 1MB limit
            echo '<script>
                    alert("Image size is too large. Please upload an image less than 1MB.");
                    window.history.back();
                </script>';
            exit();
        }
        else if ($_FILES['profilepic']['type'] != 'image/jpeg' && $_FILES['profilepic']['type'] != 'image/png') {
            echo '<script>
                    alert("Image format is not supported. Please upload a JPEG or PNG image.");
                    window.history.back();
                </script>';
            exit();
        }
        else if ($_FILES['profilepic']['error'] > 0) {
            echo '<script>
                    alert("An error occurred while uploading the image. Please try again.");
                    window.history.back();
                </script>';
            exit();
        }
        else {
            $imgData = file_get_contents($profilepic);
            $fileType = $_FILES['profilepic']['type'];
        }

        // Check if the username or email already exists
        $stmt = $conn->prepare("SELECT uname, email FROM users WHERE uname = ? OR email = ?");
        $stmt->bind_param("ss", $uname, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo '<script>
                    alert("Username or email already exists.");window.history.back();
                    </script>';
            exit();
        }
        $stmt->close();

        // Populating the database
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, uname, email, password, picture, userType) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fname, $lname, $uname, $email, $password, $imgData, $userType);

        if ($stmt->execute()) {
            // Storing the username in session variable
            $stmt = $conn->prepare("SELECT userID FROM users WHERE uname = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($userID);
            $stmt->fetch();
            $_SESSION['userID'] = $userID;
            $_SESSION['uname'] = $uname;
            $_SESSION['userType'] = $userType;
            
            echo '<script>
                    alert("New account created successfully.");window.location.href="setup.html";
                    </script>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
            echo '<script>
                    alert("There was an error creating your account. Please try again.");window.history.back();
                    </script>';
        }
        $stmt->close();
    }
}

$conn->close();
?>
