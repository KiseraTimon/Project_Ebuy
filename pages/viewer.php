<?php
//Database Connection
require '../components/database.php';

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
            $plates = $row['plates'];
            $pricestatus = $row['pricestatus'];
            $collection = $row['collection'];
            $tags = $row['tags'];
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $make.' '.$model?></title>

    <!--Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!--Remix Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" />

    <!--Styles-->
    <link rel="stylesheet" href="/pageclasses/assets/css/viewer.css">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/defaults.css">
</head>
<body>

    <div class="mainpanel">
        <!--Vehicle Navigation Panel-->
        <div class="navigator">
            <p><a href="/productpages/index.php">Vehicles > </a><?php echo $make.' '.$model?></p>
        </div>

        <!--General Vehicle Information Panel-->
        <div class="panel">
            <div class="imagepanel">
                <input type="hidden" id="images-data" value='<?php echo json_encode($images); ?>'>
                <!--Full screen icon-->
                <div class="fullscreen">
                    <img src="/pageclasses/assets/images/viewer/icons8-full-screen-50.png" alt="fullscreen" onclick="fullscreen()">
                </div>
                    
                <div class="imgholder">
                    <?php echo '<img id="first" src="/inventory/'.$images[0].'" alt="'.$make.' '.$model.'">';?>

                    <div class="imgnav">
                        <button onclick="prevImg()">&#10094;</button>
                        <button onclick="nextImg()">&#10095;</button>
                    </div>
                </div>
                <div class="imgrow">
                    <div class="thumbnails img-select">
                        <?php
                        foreach ($images as $index => $image)
                        {
                            echo '<img id="row" src="/inventory/'.$image.'" alt="'.$make.' '.$model.'" onclick="showImg('.$index.')">';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="detailspanel">
                <div class="name">
                    <p>
                        <?php echo $make.' '.$model?>
                    </p>
                    <?php
                    if (isset($_SESSION['userID']))
                    {
                        ?>
                        <form action="/pageclasses/assets/php/favorite.php" method="POST">
                            <input type="hidden" name="vehicleID" value="<?php echo $vehicleID; ?>">
                            <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
                            <button id="favbutton" class="ri-bookmark-line"></button>
                            </i>
                        </form>
                        <?php
                    }
                    else
                    {
                        ?>
                        <button class="fav" id="favbutton" class="ri-bookmark-line" onclick="alert('Login to add to favourites'); window.location.href='/pages/login.php';">
                            <i class="ri-bookmark-line"></i>
                        </button>
                        <?php
                    }
                    ?>
                </div>
                <div class="description">
                    <p><?php echo $description?></p>
                </div>
                <div class="price">
                    <p><?php echo $price?><sup>KES</sup></p>
                    <p class="pricestatus">
                        <span title="Price status" class="material-symbols-outlined">
                            handshake
                        </span>
                        <span class="pricespan"><?php echo $pricestatus?></span>
                    </p>
                </div>
                <div class="stats">
                    <span><?php echo $engineoutput.' cc'?></span>
                    <span><?php echo $mileage.' km'?></span>
                    <span><?php echo $transmission?></span>
                    <span><?php echo $YOM?></span>
                </div>
                <div class="notes">
                    <p>
                        For safety and compliance, we recommend that you inquire directly through the contact details below
                    </p>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <td>Phone</td>
                            <td>000 000 0000</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>cardepot@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Visit</td>
                            <td>146 Nairobi Rd</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!--Tabbed Panels-->
        <div class="tabs">
            <!--Dropdown table buttons-->
            <div class="btns">
                <button onclick="selecttab(event, 'performancestats');">Performance<span></span></button>
                <button onclick="selecttab(event, 'features');">Features</button>
                <button onclick="selecttab(event, 'drivestats');">Driving</button>
                <button onclick="selecttab(event, 'safetystats');">Safety</button>
                <button onclick="selecttab(event, 'healthscore');">Health</button>
                <button onclick="selecttab(event, 'guarantees');">Guarantees</button>
            </div>

            <!--Peerformance Stats Tab-->
            <div class="performancestats">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Performance Stats</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fuel capacity</td>
                            <td><?php echo $fuelcapacity?> litres</td>
                        </tr>
                        <tr>
                            <td>Fuel type</td>
                            <td><?php echo $fueltype?></td>
                        </tr>
                        <tr>
                            <td>Engine output</td>
                            <td><?php echo $engineoutput?> cc</td>
                        </tr>
                        <tr>
                            <td>Aspiration</td>
                            <td><?php echo $aspiration?></td>
                        </tr>
                        <tr>
                            <td>Horsepower</td>
                            <td><?php echo $horsepower?> Hp</td>
                        </tr>
                        <tr>
                            <td>Torque</td>
                            <td><?php echo $torque?> Nm</td>
                        </tr>
                        <tr>
                            <td>Engine layout</td>
                            <td><?php echo $enginelayout?></td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td><?php echo $gears.'-speed '.$transmission?></td>
                        </tr>
                        <tr>
                            <td>0-100 km/h sprint</td>
                            <td><?php echo $sprint?>s</td>
                        </tr>
                        <tr>
                            <td>Top speed</td>
                            <td><?php echo $topspeed?> km/h</td>
                        </tr>
                        <tr>
                            <td>Brake type</td>
                            <td><?php echo $braketype?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--Features Tab-->
            <div class="features">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Features</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Collection</td>
                            <td><?php echo $collection?></td>
                        </tr>
                        <tr>
                            <td>Tags</td>
                            <td><?php echo $tags?></td>
                        </tr>
                        <tr>
                            <td>Package</td>
                            <td><?php echo $package?></td>
                        </tr>
                        <tr>
                            <td>Exterior colour</td>
                            <td><?php echo $extcolour?></td>
                        </tr>
                        <tr>
                            <td>Interior colour</td>
                            <td><?php echo $intcolour?></td>
                        </tr>
                        <tr>
                            <td>Interior finishing</td>
                            <td><?php echo $intmaterial?></td>
                        </tr>
                        <tr>
                            <td>Interior panels</td>
                            <td><?php echo $intpanels?></td>
                        </tr>
                        <tr>
                            <td>Audio system</td>
                            <td><?php echo $audio?></td>
                        </tr>
                        <tr>
                            <td>Infotainment</td>
                            <td><?php echo $infotainment?></td>
                        </tr>
                        <tr>
                            <td>Air conditioning</td>
                            <td><?php echo $air?></td>
                        </tr>
                        <tr>
                            <td>Keyless entry</td>
                            <td><?php echo $keyless?></td>
                        </tr>
                        <tr>
                            <td>Sunroof</td>
                            <td><?php echo $sunroof?></td>
                        </tr>
                        <tr>
                            <td>Heated seats</td>
                            <td><?php echo $heatseats?></td>
                        </tr>
                        <tr>
                            <td>Ventilated seats</td>
                            <td><?php echo $ventseats?></td>
                        </tr>
                        <tr>
                            <td>Heated steering</td>
                            <td><?php echo $heatsteering?></td>
                        </tr>
                        <tr>
                            <td>Rear-wheel steering</td>
                            <td><?php echo $rearsteering?></td>
                        </tr>
                        <tr>
                            <td>Steering type</td>
                            <td><?php echo $steeringtype?></td>
                        </tr>
                        <tr>
                            <td>Tyre pressure monitor</td>
                            <td><?php echo $tpmonitor?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--Driving Stats Tab-->
            <div class="drivestats">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Driving Stats</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>City driving consumption</td>
                            <td><?php echo $cityconsumption?> km/l</td>
                        </tr>
                        <tr>
                            <td>Highway driving consumption</td>
                            <td><?php echo $highwayconsumption?> km/l</td>
                        </tr>
                        <tr>
                            <td>Combined driving consumption</td>
                            <td><?php echo $combinedconsumption?> km/l</td>
                        </tr>
                        <tr>
                            <td>Ground clearance</td>
                            <td><?php echo $groundclearance?> mm</td>
                        </tr>
                        <tr>
                            <td>Seating capacity</td>
                            <td><?php echo $seatingcapacity?> seater</td>
                        </tr>
                        <tr>
                            <td>Doors</td>
                            <td><?php echo $doors?> (Excluding trunk)</td>
                        </tr>
                        <tr>
                            <td>Boot capacity</td>
                            <td><?php echo $bootcapacity?> litres</td>
                        </tr>
                        <tr>
                            <td>Towing capacity</td>
                            <td><?php echo $towingcapacity?> kg</td>
                        </tr>
                        <tr>
                            <td>Wheel size</td>
                            <td><?php echo $wheelsize?> inches</td>
                        </tr>
                        <tr>
                            <td>Tyre size</td>
                            <td><?php echo $tyresize?></td>
                        </tr>
                        <tr>
                            <td>Wheel type</td>
                            <td><?php echo $wheeltype?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--Safety Features Tab-->
            <div class="safetystats">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Safety Features</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Anti-lock Braking System (ABS)</td>
                            <td><?php echo $ABS?></td>
                        </tr>
                        <tr>
                            <td>Electronic Stability Control (ESC)</td>
                            <td><?php echo $ESC?></td>
                        </tr>
                        <tr>
                            <td>Traction Control System (TCS)</td>
                            <td><?php echo $TCS?></td>
                        </tr>
                        <tr>
                            <td>Cornering Braking Control</td>
                            <td><?php echo $CBC?></td>
                        </tr>
                        <tr>
                            <td>Autonomous Emergency Braking</td>
                            <td><?php echo $AEB?></td>
                        </tr>
                        <tr>
                            <td>Forward Collision Warning</td>
                            <td><?php echo $FCW?></td>
                        </tr>
                        <tr>
                            <td>ISOFIX Anchor Points</td>
                            <td><?php echo $ISOFIX?></td>
                        </tr>
                        <tr>
                            <td>Blind-spot monitoring</td>
                            <td><?php echo $BSM?></td>
                        </tr>
                        <tr>
                            <td>Adaptive Cruise Control</td>
                            <td><?php echo $ACC?></td>
                        </tr>
                        <tr>
                            <td>Lane-keep Assist</td>
                            <td><?php echo $LKA?></td>
                        </tr>
                        <tr>
                            <td>Lane Departure Warning</td>
                            <td><?php echo $LDW?></td>
                        </tr>
                        <tr>
                            <td>Driver Fatigue Detection</td>
                            <td><?php echo $DFD?></td>
                        </tr>
                        <tr>
                            <td>Cameras</td>
                            <td><?php echo $cameras?></td>
                        </tr>
                        <tr>
                            <td>Dashcam</td>
                            <td><?php echo $dashcam?></td>
                        </tr>
                        <tr>
                            <td>Parking sensors</td>
                            <td><?php echo $parking?></td>
                        </tr>
                        <tr>
                            <td>Driver & Pasenger airbags</td>
                            <td><?php echo $airbags?></td>
                        </tr>
                        <tr>
                            <td>Side Airbags</td>
                            <td><?php echo $sideairbags?></td>
                        </tr>
                        <tr>
                            <td>Curtain airbags</td>
                            <td><?php echo $curtainairbags?></td>
                        </tr>
                        <tr>
                            <td>Knee airbags</td>
                            <td><?php echo $kneeairbags?></td>
                        </tr>
                        <tr>
                            <td>Engine immobilizer</td>
                            <td><?php echo $immobilizer?></td>
                        </tr>
                        <tr>
                            <td>Alarm system</td>
                            <td><?php echo $alarm?></td>
                        </tr>
                        <tr>
                            <td>Headlights option</td>
                            <td><?php echo $headlights?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--Health score Tab-->
            <div class="healthscore">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Health Ratings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Engine</td>
                            <td><?php echo $enginehealth?></td>
                        </tr>
                        <tr>
                            <td>Electricals</td>
                            <td><?php echo $electricalshealth?></td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td><?php echo $transmissionhealth?></td>
                        </tr>
                        <tr>
                            <td>Suspension</td>
                            <td><?php echo $suspensionhealth?></td>
                        </tr>
                        <tr>
                            <td>Brakes</td>
                            <td><?php echo $brakeshealth?></td>
                        </tr>
                        <tr>
                            <td>Tyres</td>
                            <td><?php echo $tyreshealth?></td>
                        </tr>
                        <tr>
                            <td>Battery</td>
                            <td><?php echo $batteryhealth?></td>
                        </tr>
                        <tr>
                            <td>Fluids</td>
                            <td><?php echo $fluidshealth?></td>
                        </tr>
                        <tr>
                            <td>Exhaust</td>
                            <td><?php echo $exhausthealth?></td>
                        </tr>
                        <tr>
                            <td>Lights</td>
                            <td><?php echo $lightshealth?></td>
                        </tr>
                        <tr>
                            <td>Wipers</td>
                            <td><?php echo $wipershealth?></td>
                        </tr>
                        <tr>
                            <td>Interior</td>
                            <td><?php echo $interiorhealth?></td>
                        </tr>
                        <tr>
                            <td>Exterior</td>
                            <td><?php echo $exteriorhealth?></td>
                        </tr>
                        <tr>
                            <td>Report</td>
                            <td><a href="#">View Inspection Report</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--Depot Guarantees Tab-->
            <div class="guarantees">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Car Depot Guarantees</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!--PHP to create stars depending on dealer ratings-->

                            <td>Dealer Rating</td>
                            <td><?php echo $rating?>/10</td>
                        </tr>
                        <tr>
                            <td>Verification</td>
                            <td><?php echo $verification?></td>
                        </tr>
                        <tr>
                            <td>Logbook</td>
                            <td><?php echo $logbook?></td>
                        </tr>
                        <tr>
                            <td>Viewing</td>
                            <td><?php echo $viewing?></td>
                        </tr>
                        <tr>
                            <td>Depot Warranty</td>
                            <td><?php echo $warranty?></td>
                        </tr>
                        <tr>
                            <td>Service History</td>
                            <td><?php echo $servicehistory?></td>
                        </tr>
                        <tr>
                            <td>Accident History</td>
                            <td><?php echo $accidenthistory?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!--Editor-->
        <?php
        if (isset($_SESSION['userID']))
        {
            if ($_SESSION['userType'] == 'admin')
            {
                ?>
                <button id="editor" onclick="admin(event, 'editor');">Administrator Controls</button>
                <div class="editor">
                    <h2>Administrator Vehicle Editor Panel</h2>
                    <p>NOTE:
                        <br>
                        Editing the vehicle details will affect the vehicle listing on the website.
                        <br>
                        Ensure that the details are accurate before saving.
                        <br>
                        All fields are unset during editing
                        <br>
                        Fill in all fields when editing. For details remaining unchanged, fill in the original values.
                        <br>
                    </p>
                    <br>
                    <form action="/pageclasses/assets/php/vehicleupdate.php" method="POST">
                        <h3>Original details</h3>
                        <input type="hidden" name="vehicleID" value="<?php echo $vehicleID; ?>">
                        <label>Current price</label>
                        <input type="text" value="<?php echo $price?>" disabled>
                        <label>Mileage</label>
                        <input type="text" value="<?php echo $mileage?>" disabled>
                        <label>Year of manufacture</label>
                        <input type="text" value="<?php echo $YOM?>" disabled>
                        <label>Price status</label>
                        <input type="text" value="<?php echo $pricestatus?>" disabled>
                        <label>Collection</label>
                        <input type="text" value="<?php echo $collection?>" disabled>
                        <label>Tags</label>
                        <input type="text" value="<?php echo $tags?>" disabled>
                        <label>Availability</label>
                        <input type="text" value="<?php echo $availability?>" disabled>
                        <label>Plates</label>
                        <input type="text" value="<?php echo $plates?>" disabled>
                        <br>

                        <h3>Editor</h3>

                        <label>Edit price</label>
                        <input type="number" name="price">
                        <label>Edit mileage</label>
                        <input type="number" name="mileage">
                        <label>Edit year of manufacture</label>
                        <input type="number" name="YOM">
                        <label>Edit Price status</label>
                        <select name="pricestatus" required>
                            <option>N/A</option>
                            <option>Fixed</option>
                            <option>Negotiable</option>
                        </select>
                        <label>Edit collection</label>
                        <select name="collection" required>
                            <option>N/A</option>
                            <option>Exotics</option>
                            <option>City cars</option>
                            <option>Classics</option>
                            <option>Trucks</option>
                            <option>Asian Premiums</option>
                            <option>European Premiums</option>
                        </select>
                        <label>Edit tags</label>
                        <select name="tags" required>
                            <option>N/A</option>
                            <option>Special offer</option>
                            <option>Bestseller</option>
                            <option></option>
                        </select>
                        <label>Edit availability</label>
                        <select name="availability" required>
                            <option>Available</option>
                            <option>Sold</option>
                            <option>Reserved</option>
                            <option>Import</option>
                            <option>Showcase</option>
                        </select>
                        <label>Edit plates</label>
                        <input type="text" name="plates">
                        <hr>
                        <h3>
                            Edit all fields before submission
                            <br>
                            Fill unchanged fields with original values
                        </h3>
                        <hr>
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <?php
            }
        }
        ?>

        <!--Footer-->
        <!--Script-->
        <script src="/pageclasses/assets/js/viewer.js"></script>
        <?php
        $footer->footercont();
        ?>