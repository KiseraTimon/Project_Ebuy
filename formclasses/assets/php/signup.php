<?php
// Sessions
session_start();

//Database Connection
require '../../../components/database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database fields
    $fname = $_POST['fName'] ?? null;
    $lname = $_POST['lName'] ?? null;
    $uname = $_POST['uname'] ?? null;
    $email = $_POST['email'] ?? null;
    $contactphone = $_POST['contactphone'] ?? null;
    $password = $_POST['passw'] ?? null;
    $confirmpassword = $_POST['confirmpassword'] ?? null;
    $profilepic = $_FILES['profilePic']['tmp_name'];
    $accountType = 'buyer';

    if (empty($fname) || empty($lname) || empty($uname) || empty($email) || empty($contactphone) || empty($password) || empty($profilepic))
    {
        echo '<script>
                alert("Please fill in all fields.");window.history.back();
                </script>';
        exit();
    } else {
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

        if ($password != $confirmpassword)
        {
            echo '<script>
            alert("The passwords do not match");window.history.back();
            </script>';
            exit();
        }

        // Image upload as BLOB
        if ($_FILES['profilePic']['size'] > 5000000) {
            echo '<script>
                    alert("Image size is too large. Please upload an image less than 5MB.");
                    window.history.back();
                </script>';
            exit();
        }
        //Image type validation
        else if ($_FILES['profilePic']['type'] != 'image/jpeg' && $_FILES['profilePic']['type'] != 'image/png') {
            echo '<script>
                    alert("Image format is not supported. Please upload a JPEG or PNG image.");
                    window.history.back();
                </script>';
            exit();
        }
        // Error message
        else if ($_FILES['profilePic']['error'] > 0) {
            echo '<script>
                    alert("An error occurred while uploading the image. Please try again.");
                    window.history.back();
                </script>';
            exit();
        }
        else {
            $imgData = file_get_contents($profilepic);
        }


        // Hashing the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Populating the database
        $stmt = $conn->prepare("INSERT INTO users (fName, lName, uname, email, contactphone, passw, profilePic, accountType) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisss", $fname, $lname, $uname, $email, $contactphone, $password, $imgData, $accountType);

        if ($stmt->execute())
        {
            // Storing the username in session variable
            $stmt = $conn->prepare("SELECT userID FROM users WHERE uname = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($userID);
            $stmt->fetch();
            $_SESSION['userID'] = $userID;
            $_SESSION['fname'] = $uname;
            $_SESSION['lname'] = $uname;
            $_SESSION['uname'] = $uname;
            $_SESSION['email'] = $email;
            $_SESSION['accountType'] = $accountType;
            
            echo '<script>
                    alert("You have been registered successfully");
                    window.location.href="/index.php";
                    </script>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
            echo '<script>
                    alert("There was an error creating your account. Please try again.");
                    window.history.back();
                    </script>';
        }
        $stmt->close();
    }
}

$conn->close();
?>
