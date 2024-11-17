<?php
$servername = "localhost";
$username = "169688"; 
$password = "169688";     
$dbname = "ebuy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_report'])) {
        $table = $_POST['table'];
        $data = json_decode($_POST['data'], true);

        // Add record to the specified table
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function ($item) use ($conn) {
            return "'" . $conn->real_escape_string($item) . "'";
        }, $data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully to $table.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['update_report'])) {
        $table = $_POST['table'];
        $id = intval($_POST['id']);
        $data = json_decode($_POST['data'], true);

        $set_clause = implode(", ", array_map(function ($key, $value) use ($conn) {
            return "$key = '" . $conn->real_escape_string($value) . "'";
        }, array_keys($data), $data));

        $sql = "UPDATE $table SET $set_clause WHERE userID = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully in $table.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['delete_report'])) {
        $table = $_POST['table'];
        $id = intval($_POST['id']);

        $sql = "DELETE FROM $table WHERE userID = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully from $table.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Display data from tables
function displayReports($table, $conn) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<h2>" . ucfirst($table) . " Reports</h2>";
        echo "<table class='report-table'><tr>";

        // Print table headers
        $columns = $result->fetch_fields();
        foreach ($columns as $column) {
            echo "<th>" . $column->name . "</th>";
        }
        echo "</tr>";

        // Print table data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                if ($key === 'profilePic') {
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($value) . "' alt='Profile Pic' height='50'></td>";
                } else {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No data available in the $table table.</p>";
    }
}
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
          <a href="userreport.php" onclick="showTab('users')">
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
          <a href="#" onclick="showTab('reports')">
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
    <title>Reports Dashboard</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }
        form {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input[type="text"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: goldenrod;
        }
        .report-table {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .report-table th, .report-table td {
            border: 1px solid #ddd;
            padding: 12px 15px;
        }
        .report-table th {
            background-color: #f2f2f2;
        }
        .report-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .report-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Reports Dashboard</h1>
    <form method="post">
        <h3>Add Report</h3>
        <label for="table">Table:</label>
        <input type="text" name="table" required><br>
        <label for="data">Data (JSON format):</label>
        <input type="text" name="data" required><br>
        <button type="submit" name="add_report">Add</button>
    </form>

    <form method="post">
        <h3>Update Report</h3>
        <label for="table">Table:</label>
        <input type="text" name="table" required><br>
        <label for="id">ID:</label>
        <input type="number" name="id" required><br>
        <label for="data">Data (JSON format):</label>
        <input type="text" name="data" required><br>
        <button type="submit" name="update_report">Update</button>
    </form>

    <form method="post">
        <h3>Delete Report</h3>
        <label for="table">Table:</label>
        <input type="text" name="table" required><br>
        <label for="id">ID:</label>
        <input type="number" name="id" required><br>
        <button type="submit" name="delete_report">Delete</button>
    </form>

    <h2>View Reports</h2>
    <?php
    displayReports('users', $conn);
    displayReports('products', $conn);
    displayReports('transactions', $conn);
    displayReports('testimonials', $conn);
    displayReports('favorites', $conn);
    displayReports('categories', $conn);
    displayReports('subcategories', $conn);
    ?>
</body>
</html>
<?php
$conn->close();
?>