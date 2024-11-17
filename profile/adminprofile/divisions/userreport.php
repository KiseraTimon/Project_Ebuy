<?php
// Database connection settings
$host = 'localhost';
$username = '169688';
$password = '169688';
$dbname = 'ebuy';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Query to fetch the user details
$query = "SELECT userID, Uname, email, contactphone, accountType FROM users";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch data
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    $users = [];
}

$conn->close();
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
          <a href="#" onclick="showTab('users')">
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
          <a href="settings.php" onclick="showTab('settings')">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
    <style>
        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">User Report</h2>

    <table>
        <thead>
            <tr>
                <th>UserID</th>
                <th>Uname</th>
                <th>Email</th>
                <th>Contact Phone</th>
                <th>Account Type</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['userID']); ?></td>
                        <td><?php echo htmlspecialchars($user['Uname']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['contactphone']); ?></td>
                        <td><?php echo htmlspecialchars($user['accountType']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
