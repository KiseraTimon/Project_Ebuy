<?php
//Database connection
require ('../../../components/database.php');

// Sessions
session_start();

if (!isset($_SESSION['userID'])) {
    echo '<script>
            alert("You must be logged in to access this page.");
            window.location.href = "/pages/login.php";
            </script>';
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $fname = $_POST['fname'] ?? null;
    $lname = $_POST['lname'] ?? null;
    $bname = $_POST['bname'] ?? null;
    $bemail = $_POST['bemail'] ?? null;
    $bcontact = $_POST['bcontact'] ?? null;
    $hq = $_POST['hq'] ?? null;

    if (empty($fname) || empty($lname) || empty($bname) || empty($bemail) || empty($bcontact) || empty($hq))
    {
        echo '<script>
                alert("Please fill in all fields.");
                window.history.back();
                </script>';
        exit();
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO businesses (fname, lname, bname, bemail, bcontact, hq, userID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisi", $fname, $lname, $bname, $bemail, $bcontact, $hq, $_SESSION['userID']);
        $stmt->execute();

        if ($stmt->affected_rows == 1)
        {
            //Update accountType to seller
            $stmt = $conn->prepare("UPDATE users SET accountType = 'seller' WHERE userID = ?");
            $stmt->bind_param("i", $_SESSION['userID']);
            $stmt->execute();

            //Storing account type in session
            $accquery = $conn->prepare("SELECT accountType FROM users WHERE userID = ?");
            $accquery->bind_param("i", $_SESSION['userID']);
            $accquery->execute();
            $accquery->store_result();
            $accquery->bind_result($accountType);
            $accquery->fetch();
            $_SESSION['accountType'] = $accountType;

            echo '<script>
                    alert("Business account created successfully. Redirecting to dashboard");
                    window.location.href = "/formclasses/assets/php/verifier.php";
                    </script>';
            exit();
        }
        else
        {
            echo '<script>
                    alert("An error occurred. Please try again");
                    window.history.back();
                    </script>';
            exit();
        }
    }
}
?>