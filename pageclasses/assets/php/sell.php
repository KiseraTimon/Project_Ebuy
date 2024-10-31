<?php
// Session management
session_start();

//Database connection
require_once '../../../components/database.php';

//Checking if user is logged in
if(!isset($_SESSION['userID']))
{
    echo '<script>alert("You need to have an account to access this page"); window.location.href = "/forms/login.html";</script>';
    exit;
}

// Check submit method
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Contact data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $county = $_POST['county'];
    $method = $_POST['method'];

    //Car details
    $numplate = $_POST['numplate'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $accident = $_POST['accident'];
    $logbook = $_POST['logbook'];
    $price = $_POST['price'];
    $carimage = $_POST['carimage'];

    // Image convertion to LONGBLOB format
    $natfront = file_get_contents($natfront);

    // Check if similar car exists by number plate
    $stmt = $conn->prepare("SELECT numplate FROM cars WHERE numplate = ?");
    $stmt->bind_param("s", $numplate);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0)
    {
        echo '<script>alert("Car with similar number plate already exists"); window.history.back();</script>';
        exit;
    }
    $stmt->close();

    // Database insertion
    $stmt = $conn->prepare("INSERT INTO sellrequests (fname, lname, email, phone, county, method, numplate, make, model, year, mileage, accident, logbook, price, carimage) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

}
?>