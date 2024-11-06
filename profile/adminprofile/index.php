<?php
//Start Session
session_start();

if (!isset($_SESSION['accountType']) && $_SESSION['accountType'] != 'admin') {
    echo '<script>
            alert("You are not authorized to view this page.");
            window.location.href = "/index.php";
            </script>';
    exit();
}

//Database Connection
require_once '../../components/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Car Depot</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/defaults.css">
    <link rel="stylesheet" href="/profile/clientprofile/css/style.css">
</head>
<body>
  <div class="container">
    <!--Sidepanel-->
    <aside>
        <div class="top">
          <div class="logo">
            <h2>Hello, <span class="danger"><?php echo $_SESSION['uname']?></span> </h2>
          </div>
          <div class="close" id="close_btn">
          <span class="material-symbols-sharp">
            close
            </span>
          </div>
        </div>
        <!-- end top -->
        <div class="sidebar">

          <a href="javascript:void(0);" onclick="showTab('dashboard')">
            <span class="material-symbols-sharp">grid_view </span>
            <h3>Dashboard</h3>
          </a>
          <a href="javascript:void(0);" onclick="showTab('users')">
            <span class="material-symbols-sharp">person_outline </span>
            <h3>View users</h3>
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">insights </span>
            <h3>Analytics</h3>
          </a> -->
          <a href="javascript:void(0);" onclick="showTab('vehicles')">
            <span class="material-symbols-sharp">car_tag</span>
            <h3>Add Vehicle</h3>
          </a>
          <a href="javascript:void(0);" onclick="showTab('inventory')">
            <span class="material-symbols-sharp">garage</span>
            <h3>Inventory</h3>
          </a>
          <a href="javascript:void(0);" onclick="showTab('events')">
            <span class="material-symbols-sharp">event</span>
            <h3>Add events</h3>
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">mail_outline </span>
            <h3>Inquiries</h3>
            <span class="msg_count">14</span>
          </a> -->
          <a href="javascript:void(0);" onclick="showTab('reports')">
            <span class="material-symbols-sharp">report_gmailerrorred </span>
            <h3>Reports</h3>
          </a>
          <a href="javascript:void(0);" onclick="showTab('settings')">
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

    <!--Topbar for shrinked screens-->
    <div class="topbar">
      <div class="quicklinks">
          <a href="/index.php">
            <span class="material-symbols-sharp">home</span>
            <!-- <h3>Dashboard</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('dashboard')">
            <span class="material-symbols-sharp">grid_view </span>
            <!-- <h3>Dashboard</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('users')">
            <span class="material-symbols-sharp">person_outline </span>
            <!-- <h3>View users</h3> -->
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">insights </span>
            <h3>Analytics</h3>
          </a> -->
          <a href="javascript:void(0);" onclick="showTab('vehicles')">
            <span class="material-symbols-sharp">car_tag</span>
            <!-- <h3>Add Vehicle</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('inventory')">
            <span class="material-symbols-sharp">garage</span>
            <!-- <h3>Inventory</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('inventory')">
            <span class="material-symbols-sharp">event</span>
            <!-- <h3>Inventory</h3> -->
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">mail_outline </span>
            <h3>Inquiries</h3>
            <span class="msg_count">14</span>
          </a> -->
          <a href="javascript:void(0);" onclick="showTab('reports')">
            <span class="material-symbols-sharp">report_gmailerrorred </span>
            <!-- <h3>Reports</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('settings')">
            <span class="material-symbols-sharp">settings </span>
            <!-- <h3>settings</h3> -->
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">add </span>
            <h3>Add Product</h3>
          </a> -->
          <a href="/forms/logout.php">
            <span class="material-symbols-sharp">logout </span>
            <!-- <h3>logout</h3> -->
          </a>
      </div>
    </div>
    
    <!--Mainpanel-->
    <main id="dashboard" class="tab-content">
      <h1>Dashboard</h1>

      <div class="date">
        <?php echo date('D-d/M-m/Y');?>
      </div>

      <!--Insights-->
      <div class="insights">

          <!--Traffic-->
          <div class="sales">
              <span class="material-symbols-sharp">browse_activity</span>
              <div class="middle">

                <div class="left">
                  <h2>Website traffic</h2>
                  <h2>641</h2>
                </div>
                <!-- <div class="progress">
                    <svg>
                        <circle  r="30" cy="40" cx="40"></circle>
                    </svg>
                    <div class="number"><p>80%</p></div>
                </div> -->

              </div>
              <small>Last 24 Hours</small>
          </div>
            <!--Users-->
            <div class="expenses">
              <span class="material-symbols-sharp">group</span>
              <div class="middle">

                <div class="left">
                  <h2>Registered Users</h2>
                  <h2>
                    <?php
                    // DB query
                    $sql = "SELECT COUNT(*) FROM users";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    echo $row[0];
                    ?>
                  </h2>
                </div>
                <!-- <div class="progress">
                    <svg>
                      <circle  r="30" cy="40" cx="40"></circle>
                    </svg>
                    <div class="number"><p>80%</p></div>
                </div> -->
              </div>
              <!-- <small>Last 24 Hours</small> -->
            </div>

            <!-- start selling -->
            <div class="income">
            <span class="material-symbols-sharp">no_crash</span>
            <div class="middle">

              <div class="left">
                <h3>Vehicles in database</h3>
                <h1>
                <?php
                  // DB Query
                  $sql = "SELECT COUNT(*) FROM vehicles";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($result);
                  echo $row[0];
                  ?>
                </h1>
              </div>
              <!-- <div class="progress">
                  <svg>
                    <circle  r="30" cy="40" cx="40"></circle>
                  </svg>
                  <div class="number"><p>80%</p></div>
              </div> -->

            </div>
            <!-- <small>Last 24 Hours</small> -->
            </div>
          <!-- end seling -->

      </div>

      <!--Recent Orders-->
      <div class="recent_order">
          <h2>Documents</h2>
          <table>
              <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Details</th>
              </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>Terms & Conditions</td>
                    <td>Compliance</td>
                    <td><?php echo date('D-d/M-m/Y')?></td>
                    <td class="primary">View</td>
                  </tr>
                  <tr>
                    <td>GDPR</td>
                    <td>Legal</td>
                    <td><?php echo date('D-d/M-m/Y')?></td>
                    <td class="primary">View</td>
                </tr>
                <tr>
                    <td>CCPA</td>
                    <td>Privacy</td>
                    <td><?php echo date('D-d/M-m/Y')?></td>
                    <td class="primary">View</td>
                </tr>
                <!-- <tr>
                    <td>Terms & Conditions</td>
                    <td>Policy</td>
                    <td><?php echo date('D-d/M-m/Y')?></td>
                    <td class="warning">Available</td>
                    <td class="primary">View</td>
                </tr> -->
              </tbody>
          </table>
          <a href="#">Show All</a>
      </div>
    </main>

    <!--Users panel-->
    <main id="users" class="tab-content">
      <div class="users">
        <h1>Registered users</h1>
  
        <table>
          <thead>
            <tr>
              <th>Surname</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Account</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // DB query
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>".$row['fname']."</td>";
              echo "<td>".$row['lname']."</td>";
              echo "<td>".$row['uname']."</td>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".$row['usertype']."</td>";
              echo "<td><a href='/forms/delete.php'>Delete</a></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>

    <!--Vehicles panel-->
    <main id="vehicles" class="tab-content">
      <h1>Add vehicles</h1>
      <div class="vehicles">
          <!--Form to add vehicles to the database-->
          <form method="POST" action="/profile/adminprofile/uploader.php" enctype="multipart/form-data">
              <!--First Database Insertion-->
              <!--General Vehicle Details-->
              <h1>General Vehicle Details</h1>
              <label>Vehicle make</label><br>
              <select name="make" id="make" onchange="change();" required>
                <?php
                while ($row = mysqli_fetch_assoc($brandresult)) {
                    $selected = ($row['brand'] == $selectedBrand) ? 'selected' : '';
                    // Store brandID and brandname in option value
                    echo '<option value="'.$row['brand'].'" '.$selected.'>'.$row['brand'].'</option>';
                }
                ?>
              </select>
              <br>
              <label>Vehicle model</label><br>
              <select name="model" id="model" required>
                <!--Script to populate models based on selected brand-->
                <script>
                  document.getElementById('make').addEventListener('change', function() {
                      var selectedBrand = this.value;
                      var models = <?php echo json_encode($modelsbybrand); ?>;
                      var modelDropdown = document.getElementById('model');
                      modelDropdown.innerHTML = '<option value="">Select model</option>';
                      if (selectedBrand in models) {
                          models[selectedBrand].forEach(function(model) {
                              var option = document.createElement('option');
                              option.value = model;
                              option.text = model;
                              modelDropdown.add(option);
                          });
                      }
                  });
                </script>
              </select>
              <label>Vehicle category</label><br>
              <select name="category" required><br>
                  <option>Sedan</option>
                  <option>SUV</option>
                  <option>Coupe</option>
                  <option>Compact</option>
                  <option>Convertible</option>
                  <option>Hatchback</option>
                  <option>Estate</option>
                  <option>Sports</option>
                  <option>Pick-up</option>
                  <option>Van</option>
                  <option>Muscle</option>
                  <option>Motorcycle</option>
              </select><br>
              <label>Vehicle description</label><br>
              <textarea name="description" maxlength="400" required>This is a great place to make statements on the consumer expectations, the unique details of the vehicle and it's general history</textarea><br>
              <label>Vehicle price (Ksh.)</label><br>
              <input type="number" name="price" required><br>
              <label>Price status</label><br>
              <select name="pricestatus" required>
                <option>N/A</option>
                <option>Fixed</option>
                <option>Negotiable</option>
              </select>
              <br>
              <label>Add to a collection</label>
              <select name="collection" required>
                <option>N/A</option>
                <option>Exotics</option>
                <option>City cars</option>
                <option>Classics</option>
                <option>Trucks</option>
                <option>Asian Premiums</option>
                <option>European Premiums</option>
              </select>
              <br>
              <label>Add a tag</label>
              <select name="tags" required>
                <option>N/A</option>
                <option>Special offer</option>
                <option>Bestseller</option>
                <option></option>
              </select>
              <br>
              
              <!--Vehicle Key Details-->
              <h1>Vehicle Stats</h1>
              <label>Number plate</label><br>
              <input type="text" name="plates" required><br>
              <label>VIN</label><br>
              <input type="text" name="VIN" required><br>
              <label>Chassis number</label>
              <input type="text" name="chassis" required><br>
              <label>Vehicle Availability</label><br>
              <select name="availability" required>
                  <option>Available</option>
                  <option>Sold</option>
                  <option>Reserved</option>
                  <option>Import</option>
                  <option>Showcase</option>
              </select><br>
              <label>Usage Status</label>
              <select name="status" required>
                  <option>Brand New</option>
                  <option>Local used</option>
                  <option>Foreign used</option>
              </select><br>
              <label>Year of manufacture</label><br>
              <input type="text" name="YOM" required><br>
              <label>Vehicle mileage (kilometers)</label><br>
              <input type="number" name="mileage" required><br>
              <label>Drivetrain</label><br>
              <select name="drivetrain" required>
                  <option>2WD (Front-biased)</option>
                  <option>2WD (Rear-biased)</option>
                  <option>AWD</option>
              </select><br>
  
              <!--Vehicle Images-->
              <h1>Vehicle Images</h1>
              <label>Vehicle Images</label><br>
              <input type="file" name="images[]" multiple required><br>
  
              <!--Second Database Insertion-->
              <!--Driving stats-->
              <h1>Driving Stats</h1>
              <label>City consumption (km/l)</label><br>
              <input type="number" name="cityconsumption" required><br>
              <label>Highway consumption (km/l)</label><br>
              <input type="number" name="highwayconsumption" required><br>
              <label>Combined consumption (km/l)</label><br>
              <input type="number" name="combinedconsumption" required><br>
              <label>Turning circle (m)</label><br>
              <input type="number" name="turningcircle" required><br>
              <label>Ground clearance (mm)</label><br>
              <input type="number" name="groundclearance" required><br>
              <label>Seating capacity</label><br>
              <input type="number" name="seatingcapacity" required><br>
              <label>Doors</label><br>
              <input type="number" name="doors" required><br>
              <label>Boot capacity (litres)</label><br>
              <input type="number" name="bootcapacity" required><br>
              <label>Towing capacity (kg)</label><br>
              <input type="number" name="towingcapacity" required><br>
              <label>Wheel size (inches)</label><br>
              <input type="number" name="wheelsize" required><br>
              <label>Tyre size</label><br>
              <input type="text" name="tyresize" required><br>
              <label>Wheel type</label><br>
              <select name="wheeltype" required>
                  <option>Alloy</option>
                  <option>Steel</option>
                  <option>Magnesium</option>
                  <option>Carbon-fiber</option>
              </select><br>
              
              <!--Third Database Insertion-->
              <!--Performance stats-->
              <h1>Performance Stats</h1>
              <label>Fuel capacity (litres)</label><br>
              <input type="number" name="fuelcapacity" required><br>
              <label>Fuel type</label><br>
              <select name="fueltype" required>
                  <option>Petrol</option>
                  <option>Diesel</option>
                  <option>Petrol/Electric</option>
                  <option>Diesel/Electric</option>
                  <option>Electric only</option>
                  <option>Hydrogen</option>
                  <option>LPG</option>
              </select><br>
              <label>Engine capacity (cc)</label><br>
              <input type="number" name="engineoutput" required><br>
              <label>Aspiration</label><br>
              <select name="aspiration">
                  <option>None</option>
                  <option>Naturally Aspirated</option>
                  <option>Turbocharger</option>
                  <option>Supercharger</option>
                  <option>Turbocharger & Supercharger</option>
                  <option>Electric</option>
              </select>
              <label>Horsepower</label><br>
              <input type="number" name="horsepower" required><br>
              <label>Torque (Nm units only)</label><br>
              <input type="number" name="torque" required><br>
              <label>Engine layout</label><br>
              <select name="enginelayout" required>
                  <option>Inline</option>
                  <option>V</option>
                  <option>Flat</option>
                  <option>W</option>
                  <option>Rotary</option>
                  <option>Electric</option>
              </select><br>
              <label>Transmission</label><br>
              <select name="transmission" required>
                  <option>Automatic</option>
                  <option>Manual</option>
                  <option>CVT</option>
              </select><br>
              <label>Gears</label><br>
              <input type="number" name="gears" required><br>
              <label>0-100 km/h time</label><br>
              <input type="number" name="sprint" required><br>
              <label>Top Speed (km/h)</label><br>
              <input type="number" name="topspeed" required><br>
              <label>Brake type</label><br>
              <select name="braketype" required>
                  <option>Disc</option>
                  <option>Drum</option>
                  <option>Carbon-ceramic</option>
                  <option>Hydraulic</option>
                  <option>Regenerative</option>
              </select><br>
              
              <!--Fourth Database Insertion-->
              <!--Feature List-->
              <h1>Features</h1>
              <label>Trim/Package</label><br>
              <input type="text" name="package" required><br>
              <label>Exterior colour option</label><br>
              <input type="text" name="extcolour" required><br>
              <label>Interior colour option</label><br>
              <input type="text" name="intcolour" required>
              <label>Interior material</label><br>
              <select name="intmaterial" required>
                  <option>Leather</option>
                  <option>Fabric</option>
                  <option>Alcantara</option>
              </select><br>
              <label>Interior panels</label><br>
              <select name="intpanels" required>
                  <option>Wood</option>
                  <option>Carbon-fiber</option>
                  <option>Aluminum</option>
                  <option>Plastic</option>
              </select><br>
              <label>Audio system</label><br>
              <select name="audio" required>
                  <option>Manufacturer Standard</option>
                  <option>Owner Upgraded</option>
                  <option>High-end Package</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Air-conditioning</label><br>
              <select name="air" required>
                  <option>Standard</option>
                  <option>Dual-zone</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Infotainment</label><br>
              <select name="infotainment" required>
                  <option>Standard</option>
                  <option>Apple Carplay & Android Auto</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Keyless Entry</label><br>
              <select name="keyless" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Sunroof</label><br>
              <select name="sunroof" required>
                  <option>Equipped</option>
                  <option>Panoramic</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Heated seats</label><br>
              <select name="heatseats" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Ventilated seats</label>
              <select name="ventseats" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Heated steering</label><br>
              <select name="heatsteering" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Rear-wheel steering</label>
              <select name="rearsteering" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Steering type</label><br>
              <select name="steeringtype" required>
                  <option>Powered</option>
                  <option>Manual</option>
                  <option>Electric</option>
                  <option>Hydraulic</option>
              </select><br>
              <label>Tyre-pressure monitor</label><br>
              <select name="tpmonitor" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
  
              <!--Fifth Database Insertion-->
              <!--Safety stats-->
              <h1>Safety Stats</h1>
              <label>Anti-lock Braking System</label><br>
              <select name="ABS" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Electronic Stability Control</label><br>
              <select name="ESC" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Traction Control System</label><br>
              <select name="TCS" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Cornering Braking Control</label><br>
              <select name="CBC" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Autonomous Emergency Braking</label><br>
              <select name="AEB" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Forward Collision Warning</label><br>
              <select name="FCW" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>ISOFIX anchor points</label><br>
              <select name="ISOFIX" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Blind-spot monitoring</label><br>
              <select name="BSM" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Adaptive cruise control</label><br>
              <select name="ACC" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Lane-Keep Assist</label><br>
              <select name="LKA" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Lane departure warning</label><br>
              <select name="LDW" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Driver fatigue detection</label><br>
              <select name="DFD" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Cameras</label><br>
              <select name="cameras" required>
                  <option>Back-up only</option>
                  <option>Rear & front only</option>
                  <option>360-degree</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Dashcam</label><br>
              <select name="dashcam" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Parking sensors</label><br>
              <select name="parking" required>
                  <option>Front only</option>
                  <option>Rear only</option>
                  <option>Front & Rear</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Driver & passenger airbags</label><br>
              <select name="airbags" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Side airbags</label><br>
              <select name="sideairbags" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Curtain airbags</label><br>
              <select name="curtainairbags" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Knee airbags</label><br>
              <select name="kneeairbags" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Engine Immobilizer</label><br>
              <select name="immobilizer" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Alarm</label><br>
              <select name="alarm" required>
                  <option>Equipped</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Headlights</label>
              <select name="headlights" required>
                  <option>Halogen</option>
                  <option>Xenon</option>
                  <option>LED</option>
                  <option>Matrix LED</option>
              </select><br>
  
              <!--Sixth Database Insertion-->
              <!--Health score-->
              <h1>Health Score (rate between 0 - 100)</h1>
              <label>Engine condition</label><br>
              <input type="number" name="enginehealth" min="0" max="100" required><br>
              <label>Electrical systems condition</label><br>
              <input type="number" name="electricalshealth" min="0" max="100" required><br>
              <label>Transmission condition</label><br>
              <input type="number" name="transmissionhealth" min="0" max="100" required><br>
              <label>Suspension condition</label><br>
              <input type="number" name="suspensionhealth" min="0" max="100" required><br>
              <label>Brakes condition</label><br>
              <input type="number" name="brakeshealth" min="0" max="100" required><br>
              <label>Tyres condition</label><br>
              <input type="number" name="tyreshealth" min="0" max="100" required><br>
              <label>Battery condition</label><br>
              <input type="number" name="batteryhealth" min="0" max="100" required><br>
              <label>Fluids condition</label><br>
              <input type="number" name="fluidshealth" min="0" max="100" required><br>
              <label>Exhaust condition</label><br>
              <input type="number" name="exhausthealth" min="0" max="100" required><br>
              <label>Lights condition</label><br>
              <input type="number" name="lightshealth" min="0" max="100" required><br>
              <label>Wipers condition</label><br>
              <input type="number" name="wipershealth" min="0" max="100" required><br>
              <label>Interior condition</label><br>
              <input type="number" name="interiorhealth" min="0" max="100" required><br>
              <label>Exterior condition</label><br>
              <input type="number" name="exteriorhealth" min="0" max="100" required><br>
              <label>Health description</label><br>
              <textarea name="healthdescription" maxlength="400" required>Describe the general health of the vehicle. This is a great place to mention any issues that the vehicle may have</textarea><br>
  
              <!--Seventh Database Insertion-->
              <!--Standards-->
              <label>Dealer rating</label>
              <input type="number" name="rating" min="0" max="10" required><br>
              <label>Verification of vehicle</label>
              <select name="verification" required>
                  <option>Verified</option>
                  <option>Not verified</option>
              </select><br>
              <label>Logbook</label>
              <select name="logbook" required>
                  <option>Available</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Viewing</label>
              <select name="viewing" required>
                  <option>Available on site</option>
                  <option>On request</option>
                  <option>Within specified inquiry timeframes</option>
              </select><br>
              <label>Car depot warranty</label>
              <select name="warranty" required>
                  <option>Applied</option>
                  <option>Not applied</option>
              </select><br>
              <label>Service history</label>
              <select name="servicehistory" required>
                  <option>Available</option>
                  <option>Unavailable</option>
              </select><br>
              <label>Accident history</label>
              <select name="accidenthistory" required>
                  <option>None</option>
                  <option>Minor (Knocks & Scratches)</option>
                  <option>Minor (System/Electrical faults)</option>
                  <option>Major (System/Electrical faults)</option>
                  <option>Major (Structural Damage)</option>
              </select><br>
  
              <!--Terms-->
              <h1>Terms</h1>
              <textarea name="note" maxlength="475" readonly>By submitting this form, you agree that all information provided is accurate and that you have the right to sell this vehicle. The Car Depot reserves the right to remove any vehicle from the database if it is found to be inaccurate. The Car Depot also reserves the right to use the images provided for marketing purposes.
              </textarea><br>
  
              <!--Submit button-->
              <input type="submit" value="Add vehicle">
          </form>
      </div>
    </main>

    <!--Inventory panel-->
    <main id="inventory" class="tab-content">
      <div class="inventory">
        <h1>Vehicle Inventory</h1>
  
        <table>
          <thead>
            <tr>
              <th>Make</th>
              <th>Model</th>
              <th>Plate</th>
              <th>Link</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // DB query
    
            $sql = "SELECT * FROM vehicles";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
              $vehicleID=$row['vehicleID'];
              $make=$row['make'];
              $model=$row['model'];
              $plates=$row['plates'];
    
              echo "<tr>";
              echo "<td>".$make."</td>";
              echo "<td>".$model."</td>";
              echo "<td>".$plates."</td>";
              echo "<td><a href='/pages/viewer.php?vehicleID=$vehicleID'>View</a></td>";
              echo "<td><a href='/formclasses/assets/php/delete_car.php?vehicleID=$vehicleID'>Delete</a></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
  
        </table>
      </div>
    </main>

    <!--Events panel-->
    <main id="events" class="tab-content">
      <h1>Active events</h1>
      <div class="events">
        <!--Bootstrap cards-->
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="/assets/events.png" alt="Card image cap">
          <div class="card-body">
            <h1 class="card-title">Petrolheaaddds... 🤤</h1>
            <p class="card-text">Host your very own event. Add details, photos and share your experiences with this update</p>
            <a href="/profile/adminprofile/php/eventspage.php" class="btn btn-primary">Create an event</a>
          </div>
        </div>
        <?php
        // DB
        $sql = "SELECT * FROM events";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
          $evtID = $row['evtID'];
          $evtname = $row['evtname'];
          $evttime = $row['evttime'];
          $evtlocation = $row['evtlocation'];
          $evttype = $row['evttype'];
          $evtimages = $row['evtimages'];

          // Image JSON to PHP array
          $evtimages = json_decode($evtimages, true);

        ?>
          <div class="card" style="width: 18rem;">
            <?php
            // Display first image
            echo '<img class="card-img-top" src="'.$evtimages[0].'" alt="'.$evtname.'">';
            ?>
            <div class="card-body">
              <h1 class="card-title"><?php echo $evtname?></h1>
              <p class="card-text"><?php echo $evttype?></p>
              <a href="/profile/adminprofile/php/eventspage.php" class="btn btn-primary">View event</a>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </main>

    <!--Reports panel-->
    <main id="reports" class="tab-content">
      <h1>Reports & Testimonials</h1>
      <div class="reports">
        <table>
          <thead>
            <tr>
              <th>Author</th>
              <th>Rating</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            $sql = "SELECT * FROM testimonials";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
              $testID = $row['testID'];
              $dispname=$row['dispname'];
              $tests=$row['tests'];
              $testreview=$row['testreview'];

              ?>
                <tr>
                  <td><?php echo $dispname?></td>
                  <td><?php echo $testreview?></td>
                  <td><a href="/pages/about.php#testimonials">View</a></td>
                </tr>
              <?php
            }
            ?>
            </tbody>
        </table>
      </div>
    </main>

    <!--Settings panel-->
    <main id="settings" class="tab-content">
      <h1>Settings</h1>
      <div class="settings">
  
        <?php
        // DB query
        $sql = "SELECT * FROM users WHERE userID = '".$_SESSION['userID']."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
  
        //Populate variables
        $fname = $row['fname'];
        $lname = $row['lname'];
        $uname = $row['uname'];
        $email = $row['email'];
        $profilepic= $row['profilepic'];
        $usertype = $row['usertype'];

        // BLOB conversion
        $profilepic = base64_encode($profilepic);
        $profilepic = 'data:image/jpeg;base64,'.$profilepic;
        ?>

        <img
          src="
          <?php
          //Display image
          echo $profilepic;
          ?>"
        >
      </div>
      <div class="account">
        <div class="accnote">
          <p>Account Information</p>
        </div>
        <div class="acctext">
            <form action="../updator.php" method="POST" enctype="multipart/form-data">
              <!--fname-->
              <label for="fname">First Name</label>
              <input type="text" name="fname" value="<?php echo $fname?>"><br>

              <!--lname-->
              <label for="lname">Last Name</label>
              <input type="text" name="lname" value="<?php echo $lname?>"><br>

              <!--uname-->
              <label for="uname">Username</label>
              <input type="text" name="uname" value="<?php echo $uname?>"><br>

              <!--email-->
              <label for="email">Email</label>
              <input type="email" name="email" value="<?php echo $email?>"><br>

              <label for="password">Current Password</label>
              <input type="password" name="currentpassword" value="<?php echo $password?>" readonly><br>

              <!--New password-->
              <label for="password">New Password</label>
              <input type="password" name="password"><br>

              <!--Confirm password-->
              <label for="confirmpassword">Confirm Password</label>
              <input type="password" name="confirmpassword"><br>`

              <!--profilepic-->
              <label for="profilepic">Profile Picture</label>
              <input type="file" name="profilepic"><br>

              <!--Submit-->
              <button type="submit" name="update">Update</button>
            </form>
        </div>
      </div>
    </main>
</div>

<!--Scripts-->
<script src="script.js"></script>

</body>
</html>