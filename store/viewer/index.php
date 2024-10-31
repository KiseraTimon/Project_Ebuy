<?php
//Database Connection
$servername = 'localhost';
$username = 'root';
$password_db = 'timonkisera123456_';
$dbname = 'cardepot';

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

//Validating the vehicleID
if (isset($_GET['vehicleID'])) {
    $vehicleID= $_GET['vehicleID'];
    
    //Fetching the vehicle details
    $sql = "SELECT * FROM vehicles WHERE vehicleID = '$vehicleID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Populating reference variables
        while ($row = $result->fetch_assoc())
        {
            // First Database Extraction (Vehicle General Details)
            $make = $row['make'];
            $model = $row['model'];
            $category = $row['category'];
            $description = $row['description'];
            $price = $row['price'];
            $availability = $row['availability'];
            $YOM = $row['YOM'];
            $mileage = $row['mileage'];
            $drivetrain = $row['drivetrain'];
            $images = $row['images'];

            //Decoding JSON image paths to PHP array
            $images = json_decode($images, true);

            // Second Database Extraction (Driving Stats)
            $cityconsumption = $row['cityconsumption'];
            $highwayconsumption = $row['highwayconsumption'];
            $combinedconsumption = $row['combinedconsumption'];
            $turningcircle = $row['turningcircle'];
            $groundclearance = $row['groundclearance'];
            $seatingcapacity = $row['seatingcapacity'];
            $doors = $row['doors'];
            $bootcapacity = $row['bootcapacity'];
            $towingcapacity = $row['towingcapacity'];
            $wheelsize = $row['wheelsize'];
            $tyresize = $row['tyresize'];
            $wheeltype = $row['wheeltype'];

            // Third Database Extraction (Performance Stats)
            $fuelcapacity = $row['fuelcapacity'];
            $fueltype = $row['fueltype'];
            $engineoutput = $row['engineoutput'];
            $aspiration = $row['aspiration'];
            $horsepower = $row['horsepower'];
            $torque = $row['torque'];
            $enginelayout = $row['enginelayout'];
            $transmission = $row['transmission'];
            $gears = $row['gears'];
            $sprint = $row['sprint'];
            $topspeed = $row['topspeed'];
            $braketype = $row['braketype'];

            // Fourth Database Extraction (Features)
            $package = $row['package'];
            $extcolour = $row['extcolour'];
            $intcolour = $row['intcolour'];
            $intmaterial = $row['intmaterial'];
            $intpanels = $row['intpanels'];
            $audio = $row['audio'];
            $air = $row['air'];
            $infotainment = $row['infotainment'];
            $keyless = $row['keyless'];
            $sunroof = $row['sunroof'];
            $heatseats = $row['heatseats'];
            $ventseats = $row['ventseats'];
            $heatsteering = $row['heatsteering'];
            $rearsteering = $row['rearsteering'];
            $steeringtype = $row['steeringtype'];
            $tpmonitor = $row['tpmonitor'];

            // Fifth Database Extraction (Safety)
            $ABS = $row['ABS'];
            $ESC = $row['ESC'];
            $TCS = $row['TCS'];
            $CBC = $row['CBC'];
            $AEB = $row['AEB'];
            $FCW = $row['FCW'];
            $ISOFIX = $row['ISOFIX'];
            $BSM = $row['BSM'];
            $ACC = $row['ACC'];
            $LKA = $row['LKA'];
            $LDW = $row['LDW'];
            $DFD = $row['DFD'];
            $cameras = $row['cameras'];
            $dashcam = $row['dashcam'];
            $parking = $row['parking'];
            $airbags = $row['airbags'];
            $sideairbags = $row['sideairbags'];
            $curtainairbags = $row['curtainairbags'];
            $kneeairbags = $row['kneeairbags'];
            $immobilizer = $row['immobilizer'];
            $alarm = $row['alarm'];
            $headlights = $row['headlights'];

            // Sixth Database Extraction (Health Score)
            $enginehealth = $row['enginehealth'];
            $electricalshealth = $row['electricalshealth'];
            $transmissionhealth = $row['transmissionhealth'];
            $suspensionhealth = $row['suspensionhealth'];
            $brakeshealth = $row['brakeshealth'];
            $tyreshealth = $row['tyreshealth'];
            $batteryhealth = $row['batteryhealth'];
            $fluidshealth = $row['fluidshealth'];
            $exhausthealth = $row['exhausthealth'];
            $lightshealth = $row['lightshealth'];
            $wipershealth = $row['wipershealth'];
            $interiorhealth = $row['interiorhealth'];
            $exteriorhealth = $row['exteriorhealth'];
            $healthdescription = $row['healthdescription'];

            // Seventh Database Extraction (Standards)
            $rating = $row['rating'];
            $verification = $row['verification'];
            $logbook = $row['logbook'];
            $viewing = $row['viewing'];
            $warranty = $row['warranty'];
            $servicehistory = $row['servicehistory'];
            $accidenthistory = $row['accidenthistory'];

            //Number formatting
            $price = number_format($price);
            $mileage = number_format($mileage);
            $engineoutput = number_format($engineoutput);
            $horsepower = number_format($horsepower);
            $torque = number_format($torque);
            $fuelcapacity = number_format($fuelcapacity);
            $towingcapacity = number_format($towingcapacity);
        }
    } else {
        echo '<script>
                    alert(The product was not found);window.history.back();
                </script>';
    }
}

//Closing the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $make.' '.$model?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  </head>
  <body>
    
    <div class = "card-wrapper">
      <div class = "card">
        <!-- card left -->
        <div class = "product-imgs">
          <div class = "img-display">
            <div class = "img-showcase">
              <img src="<?php echo $images[0]?>">
            </div>
            <!--Buttons to navigate images-->
            <button class = "btn-control left" onclick="plusSlides(-1)">
              <i class = "fas fa-chevron-left"></i>
            </button>
            <button class = "btn-control right" onclick="plusSlides(1)">
              <i class = "fas fa-chevron-right"></i>
            </button>
          </div>
          <div class = "img-select">
            <?php
              foreach ($images as $image) {
                  echo '<div class="small-img">
                          <img src="'.$image.'" onclick="showImg()">
                      </div>';
              }
            ?>
          </div>
        </div>

        <!-- card right -->
        <div class = "product-content">
          <h2 class = "product-title"><?php echo $make.' '.$model?></h2>
          
          <div class = "product-detail">
            <p><?php echo $description?></p>
            <ul>
              <li>Color: <span>Black</span></li>
              <li>Available: <span>in stock</span></li>
              <li>Category: <span>Shoes</span></li>
              <li>Shipping Area: <span>All over the world</span></li>
              <li>Shipping Fee: <span>Free</span></li>
            </ul>
          </div>
          
          <div class = "product-price">
            <p><?php echo $price?><sup>KES</sup></p>
          </div>


          <div class = "purchase-info">
            <input type = "number" min = "0" value = "1">
            <button type = "button" class = "btn">
              Add to Cart <i class = "fas fa-shopping-cart"></i>
            </button>
            <button type = "button" class = "btn">Compare</button>
          </div>

          <div class = "social-links">
            <p>Share At: </p>
            <a href = "#">
              <i class = "fab fa-facebook-f"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-twitter"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-instagram"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-whatsapp"></i>
            </a>
            <a href = "#">
              <i class = "fab fa-pinterest"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    
    <script src="script.js"></script>
  </body>
</html>