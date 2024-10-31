<?php
// Sessions
session_start();

// Observing active sessions
if (isset($_SESSION['userID'])) {
    echo '<script>
            alert("You are already logged in.");
            window.history.back();
            </script>';
    exit();
}

// Database Connection
require '../../../components/database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $uname = $_POST['uname'] ?? null;
    $password = $_POST['passw'] ?? null;

    // Check if fields are empty
    if (empty($uname) || empty($password)) {
        echo '<script>
                alert("Please fill in all fields.");
                window.history.back();
                </script>';
        exit();
    } else {
        // Prepare and execute query to check if the username exists
        $stmt = $conn->prepare("SELECT userID, fName, lName, uname, email, contactphone, passw, accountType FROM users WHERE uname = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt->store_result();
        
        // Bind result variables
        $stmt->bind_result($userID, $fname, $lname, $uname, $email, $contactphone, $hashed_password, $accountType);
        $stmt->fetch();

        // Check if the user exists
        if ($stmt->num_rows == 0) {
            echo '<script>
                    alert("Username does not exist.");
                    window.history.back();
                    </script>';
            exit();
        }

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, store user data in session
            $_SESSION['userID'] = $userID;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['uname'] = $uname;
            $_SESSION['email'] = $email;
            $_SESSION['contactphone'] = $contactphone;
            $_SESSION['accountType'] = $accountType;
            
            echo '<script>
                    alert("Login successful");
                    window.location.href="/index.php";
                    </script>';
        } else {
            // Password is incorrect
            echo '<script>
                    alert("Incorrect password.");
                    window.history.back();
                    </script>';
            exit();
        }

        $stmt->close();
    }
}

$conn->close();
?>
