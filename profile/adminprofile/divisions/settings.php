<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "169688"; 
$password = "169688";     
$dbname = "ebuy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate admin session
if (!isset($_SESSION['userID']) || $_SESSION['accountType'] != 3) {
    die("Access denied: Admin only.");
}

// Fetch admin details
$adminID = $_SESSION['userID'];
$sql = "SELECT * FROM users WHERE userID = $adminID AND accountType = 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    die("Admin not found.");
}

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        // Update admin profile
        $fName = $conn->real_escape_string($_POST['fName']);
        $lName = $conn->real_escape_string($_POST['lName']);
        $email = $conn->real_escape_string($_POST['email']);
        $contactphone = $conn->real_escape_string($_POST['contactphone']);
        $address = $conn->real_escape_string($_POST['address']);

        $sql = "UPDATE users SET 
                fName = '$fName', 
                lName = '$lName', 
                email = '$email', 
                contactphone = '$contactphone', 
                address = '$address' 
                WHERE userID = $adminID";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>Profile updated successfully.</p>";
            header("Refresh:0"); // Refresh to show updated data
        } else {
            echo "<p class='error'>Error updating profile: " . $conn->error . "</p>";
        }
    } elseif (isset($_POST['add_user'])) {
        // Add a new user
        $fName = $conn->real_escape_string($_POST['fName']);
        $lName = $conn->real_escape_string($_POST['lName']);
        $uname = $conn->real_escape_string($_POST['uname']);
        $email = $conn->real_escape_string($_POST['email']);
        $passw = password_hash($_POST['passw'], PASSWORD_BCRYPT);
        $contactphone = $conn->real_escape_string($_POST['contactphone']);
        $address = $conn->real_escape_string($_POST['address']);
        $accountType = intval($_POST['accountType']);

        if ($accountType == 3) {
            echo "<p class='error'>Only one admin is allowed in the system.</p>";
        } else {
            $sql = "INSERT INTO users (fName, lName, uname, email, passw, contactphone, address, accountType) 
                    VALUES ('$fName', '$lName', '$uname', '$email', '$passw', '$contactphone', '$address', $accountType)";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>User added successfully.</p>";
            } else {
                echo "<p class='error'>Error adding user: " . $conn->error . "</p>";
            }
        }
    }
}

// Fetch all users
$users = $conn->query("SELECT * FROM users WHERE accountType != 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Car Depot</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../../../defaults.css">
    <link rel="stylesheet" href="../../../clientprofile/css/style.css">
    
</head>
<body>
  <div class="container">
    <!--Sidepanel-->
    <aside>
        <div class="top">
          <div class="logo">
            <h2>Hello, Admin <span class="danger"></span> </h2>
          </div>
          <div class="close" id="close_btn">
          <span class="material-symbols-sharp">
            close
            </span>
          </div>
        </div>
        <!-- end top -->
        <div class="sidebar">

          <a href="../index.php" onclick="showTab('dashboard')">
            <span class="material-symbols-sharp">grid_view </span>
            <h3>Dashboard</h3>
          </a>
          <a href="allreports.php" onclick="showTab('users')">
            <span class="material-symbols-sharp">person_outline </span>
            <h3>View users</h3>
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">insights </span>
            <h3>Analytics</h3>
          </a> -->
          
          
          <!-- <a href="#">
            <span class="material-symbols-sharp">mail_outline </span>
            <h3>Inquiries</h3>
            <span class="msg_count">14</span>
          </a> -->
          <a href="allreports.php" onclick="showTab('reports')">
            <span class="material-symbols-sharp">report_gmailerrorred </span>
            <h3>Reports</h3>
          </a>
          <a href="#" onclick="showTab('settings')">
            <span class="material-symbols-sharp">settings </span>
            <h3>settings</h3>
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">add </span>
            <h3>Add Product</h3>
          </a> -->
          <a href="/index.php">
            <span class="material-symbols-sharp">home </span>
            <h3>Home</h3>
          </a>
          <a href="/formclasses/assets/php/logout.php">
            <span class="material-symbols-sharp">logout </span>
            <h3>logout</h3>
          </a>
        </div>
    </aside>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin-top: 10px;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            color: #333;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Admin Settings</h1>

    <h2>Update Profile</h2>
    <form method="post">
        <label for="fName">First Name:</label>
        <input type="text" name="fName" value="<?= htmlspecialchars($admin['fName']) ?>" required><br>
        <label for="lName">Last Name:</label>
        <input type="text" name="lName" value="<?= htmlspecialchars($admin['lName']) ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required><br>
        <label for="contactphone">Contact Phone:</label>
        <input type="number" name="contactphone" value="<?= htmlspecialchars($admin['contactphone']) ?>" required><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($admin['address']) ?>"><br>
        <button type="submit" name="update_profile">Update Profile</button>
    </form>

    <h2>Add User</h2>
    <form method="post">
        <label for="fName">First Name:</label>
        <input type="text" name="fName" required><br>
        <label for="lName">Last Name:</label>
        <input type="text" name="lName" required><br>
        <label for="uname">Username:</label>
        <input type="text" name="uname" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="passw">Password:</label>
        <input type="password" name="passw" required><br>
        <label for="contactphone">Contact Phone:</label>
        <input type="number" name="contactphone" required><br>
        <label for="address">Address:</label>
        <input type="text" name="address"><br>
        <label for="accountType">Account Type (1=User, 2=Moderator):</label>
        <input type="number" name="accountType" required><br>
        <button type="submit" name="add_user">Add User</button>
    </form>

    <h2>All Users</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Contact Phone</th>
            <th>Account Type</th>
        </tr>
        <?php while ($row = $users->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['userID']) ?></td>
            <td><?= htmlspecialchars($row['fName']) ?></td>
            <td><?= htmlspecialchars($row['lName']) ?></td>
            <td><?= htmlspecialchars($row['uname']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['contactphone']) ?></td>
            <td><?= htmlspecialchars($row['accountType']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
