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
    <title><?php echo $YOM.' '.$make.' '.$model;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <style>
      /*Major*/
      section {
        display: flex;
        flex-wrap: wrap;
        margin: 0 auto;
        max-width: 100%;
        padding: 20px;
        margin: 10px;
        background-color: pink;
      }

      .modal {
        max-width:400px;
        max-height: 700px;
        margin: 10px;
        background-color: yellow;
        padding: 10px;
      }

      .modalimage {
        position:relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: red;
      }

      .modalimage img {
        width: 100%;
        height: auto;
        object-fit: cover;
      }

      .modalrow {
        display: flex;
        margin: 0 auto;
        max-width: 100%;
        overflow: hidden;
      }

      .modalrow img {
        height: 100px;
        width: auto;
      }

      .stats {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 30%;
      }

      .stats div {
        margin: 10px 0;
      }

      .stats div h2 {
        font-size: 1.5em;
      }

      .stats div p {
        font-size: 1em;
      }

      .stats div i {
        font-size: 1.5em;
      }

      .controllers {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
      }

      .controllers button {
        background-color: #000;
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
      }

      .controllers button:hover {
        background-color: #333;
      }

      .controllers button i {
        font-size: 1.5em;
      }
    </style>
  </head>
  <body>

  <!--Major-->
    <section>
      <div class="modal">
        <div class="modalimage">
          <?php
          //Displaying the images
          foreach ($images as $image) {
              echo '<img src="'.$image.'" alt="'.$make.' '.$model.'">';
          }

          //Buttons to scroll through images
          ?>
            <div class="controllers">
              <button class="ctrl-left" onclick="plusSlides(-1)"><i class="fas fa-arrow-left"></i></button>
              <button onclick="plusSlides(1)"><i class="fas fa-arrow-right"></i></button>
            </div>
          <?php
          ?>
        </div>
        <div class="modalrow">
          <?php
          //Display other vehicle images in a row
          foreach ($images as $image) {
              echo '<img src="'.$image.'" alt="'.$make.' '.$model.'">';
          }
          ?>
        </div>
      </div>
      <div class="stats"></div>
    </section>

<!--Script for controllers and handling image slides-->
<script>
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("modalimage");
    var dots = document.getElementsByClassName("modalrow");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }
</script>
</body>
</html>