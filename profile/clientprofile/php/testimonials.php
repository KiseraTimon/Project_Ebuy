<?php
// Session Management
session_start();
if(!isset($_SESSION['userID']))
{
    echo '<script>alert("You must be logged in to add a testimonial");
    window.location.href="/forms/login.html";
    </script>';
}
else
{
    $userregID = $_SESSION['userID'];
}

// Database Connection
require_once '../../../components/database.php';

// Populating variables
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $dispname = $_POST['dispname'] ?? null;
    $tests = $_POST['tests'] ?? null;
    $testreview = $_POST['testreview'] ?? null;
    $userID = $userregID;

    if(empty($dispname) || empty($tests) || empty($testreview))
    {
        echo '<script>alert("Please fill in all fields");
        window.history.back();
        </script>';
    exit;
    }

    // Populating the database
    $stmt = $conn->prepare("INSERT INTO testimonials (dispname, tests, testreview, userID)
    VALUES
    (?, ?, ?, ?)");
    if($stmt)
    {
        $stmt->bind_param("ssii", $dispname, $tests, $testreview, $userID);
        $stmt->execute();
        $stmt->close();
    
        echo '<script>
            alert("Your testimonial has been successfully added");
            window.location.href="/profile/clientprofile/index.php";
            </script>';

            $conn->close();
    } else {
        echo '<script>alert("Error preparing statements. Check backend entries'. $conn->error.'");window.history.back();</script>';
    }
}
else
{
    echo '<script>alert("Unauthorized access method");window.history.back();</script>';
}
?>