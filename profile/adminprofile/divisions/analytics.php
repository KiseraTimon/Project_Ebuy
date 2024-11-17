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

// Query to fetch userID frequency grouped by purchaseDate
$query = "SELECT userID, COUNT(userID) AS frequency, DATE(purchaseDate) AS purchase_day 
          FROM transactions 
          GROUP BY userID, purchase_day 
          ORDER BY purchase_day ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Arrays to store the data
    $userIDs = [];
    $frequencies = [];
    $purchaseDates = [];

    while ($row = $result->fetch_assoc()) {
        $userIDs[] = $row['userID'];
        $frequencies[] = $row['frequency'];
        $purchaseDates[] = $row['purchase_day'];
    }
} else {
    $userIDs = [];
    $frequencies = [];
    $purchaseDates = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Purchase Frequency Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="userFrequencyChart" width="400" height="200"></canvas>
    <script>
        // Data from PHP
        const userIDs = <?php echo json_encode($userIDs); ?>;
        const frequencies = <?php echo json_encode($frequencies); ?>;
        const purchaseDates = <?php echo json_encode($purchaseDates); ?>;

        // Group the data by date for plotting
        const labels = purchaseDates;
        const dataset = {
            labels: labels,
            datasets: [{
                label: 'User Purchase Frequency',
                data: frequencies,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
            }]
        };

        // Create the chart
        const ctx = document.getElementById('userFrequencyChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: dataset,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
