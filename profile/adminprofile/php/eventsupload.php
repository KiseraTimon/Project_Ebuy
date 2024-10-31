<?php
// Session
session_start();

if (!isset($_SESSION['userType']) && $_SESSION['userType'] != 'admin') {
    echo '<script>
            alert("You are not authorized to view this page.");
            // window.location.href = "/index.php";
            </script>';
    exit();
    }

// Include database connection
require ('../../../components/database.php');

//PHP to submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $evtname = $_POST['evtname'];
    $evttype = $_POST['evttype'];
    $evtdesc = $_POST['evtdesc'];
    $evtdate = $_POST['evtdate'];
    $evttime = $_POST['evttime'];
    $evtlocation = $_POST['evtlocation'];
    $evthost = $_POST['evthost'];
    $evtreg = $_POST['evtreg'];
    $evtlink = $_POST['evtlink'];
    $evtcost = $_POST['evtcost'];
    $evtnotes = $_POST['evtnotes'];
    $evtcont = $_POST['evtcont'];
    $evtcontmethod = $_POST['evtcontmethod'];
    $evttags = $_POST['evttags'];

    $evtimages = $_FILES['evtimages'];

    // Vehicle images
    $uploadDir = '../../../events/';
    $imagePaths = [];
    if (!empty($_FILES['evtimages']['name'][0])) {
        foreach ($_FILES['evtimages']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['evtimages']['name'][$key]);
            $targetFilePath = $uploadDir . $file_name;

            // Check if file is a valid image type
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (in_array(strtolower($fileType), $allowedTypes)) {
                if (move_uploaded_file($tmp_name, $targetFilePath)) {
                    $imagePaths[] = $targetFilePath;
                } else {
                    echo 'Error uploading image: ' . $file_name;
                }
            } else {
                echo 'Invalid file type: ' . $file_name;
            }
        }
    } else {
        echo 'Please upload at least one image.';
    }

    // Convert image paths array to a JSON string to store in the database
    $evtimages = json_encode($imagePaths);

    // Insert prepared statement
    $sql = "INSERT INTO events (evtname, evttype, evtdesc, evtdate, evttime, evtlocation, evthost, evtreg, evtlink, evtcost, evtnotes, evtcont, evtcontmethod, evttags, evtimages) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssissssisisss', $evtname, $evttype, $evtdesc, $evtdate, $evttime, $evtlocation, $evthost, $evtreg, $evtlink, $evtcost, $evtnotes, $evtcont, $evtcontmethod, $evttags, $evtimages);

    if ($stmt->execute()) {
        echo '<script>
        alert("Event added successfully.");
        window.location.href = "/profile/adminprofile/index.php";
        </script>';
        exit();
    } else {
        echo '<script>
        alert("Failed to add event. Please try again.");
        window.history.back();
        </script>';
        exit();
    }
}