<?php
// Database and session setup
session_start();
if(isset($_SESSION['userID']) && isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin')
{

    require ('../../components/database.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // First database insertion
        // Vehicle general information
        $make = $_POST['make'];
        $model = $_POST['model'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $plates = $_POST['plates'];
        $VIN = $_POST['VIN'];
        $chassis = $_POST['chassis'];
        $availability = $_POST['availability'];
        $status = $_POST['status'];
        $YOM = $_POST['YOM'];
        $mileage = $_POST['mileage'];
        $drivetrain = $_POST['drivetrain'];
        $pricestatus = $_POST['pricestatus'];
        $collection = $_POST['collection'];
        $tags = $_POST['tags'];
    
        // Vehicle images
        $uploadDir = '../../inventory/';
        $imagePaths = [];
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = basename($_FILES['images']['name'][$key]);
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
        $images = json_encode($imagePaths);
    
        // Second database insertion
        // Driving stats
        $cityconsumption = $_POST['cityconsumption'];
        $highwayconsumption = $_POST['highwayconsumption'];
        $combinedconsumption = $_POST['combinedconsumption'];
        $turningcircle = $_POST['turningcircle'];
        $groundclearance = $_POST['groundclearance'];
        $seatingcapacity = $_POST['seatingcapacity'];
        $doors = $_POST['doors'];
        $bootcapacity = $_POST['bootcapacity'];
        $towingcapacity = $_POST['towingcapacity'];
        $wheelsize = $_POST['wheelsize'];
        $tyresize = $_POST['tyresize'];
        $wheeltype = $_POST['wheeltype'];
    
        // Third database insertion
        // Performance stats
        $fuelcapacity = $_POST['fuelcapacity'];
        $fueltype = $_POST['fueltype'];
        $engineoutput = $_POST['engineoutput'];
        $aspiration = $_POST['aspiration'];
        $horsepower = $_POST['horsepower'];
        $torque = $_POST['torque'];
        $enginelayout = $_POST['enginelayout'];
        $transmission = $_POST['transmission'];
        $gears= $_POST['gears'];
        $sprint = $_POST['sprint'];
        $topspeed = $_POST['topspeed'];
        $braketype = $_POST['braketype'];
    
        // Fourth database insertion
        // Features
        $package = $_POST['package'];
        $extcolour = $_POST['extcolour'];
        $intcolour = $_POST['intcolour'];
        $intmaterial = $_POST['intmaterial'];
        $intpanels = $_POST['intpanels'];
        $audio = $_POST['audio'];
        $air = $_POST['air'];
        $infotainment = $_POST['infotainment'];
        $keyless = $_POST['keyless'];
        $sunroof = $_POST['sunroof'];
        $heatseats = $_POST['heatseats'];
        $ventseats = $_POST['ventseats'];
        $heatsteering = $_POST['heatsteering'];
        $rearsteering = $_POST['rearsteering'];
        $steeringtype = $_POST['steeringtype'];
        $tpmonitor = $_POST['tpmonitor'];
    
        // Fifth database insertion
        // Safety
        $ABS = $_POST['ABS'];
        $ESC = $_POST['ESC'];
        $TCS = $_POST['TCS'];
        $CBC = $_POST['CBC'];
        $AEB = $_POST['AEB'];
        $FCW = $_POST['FCW'];
        $ISOFIX = $_POST['ISOFIX'];
        $BSM = $_POST['BSM'];
        $ACC = $_POST['ACC'];
        $LKA = $_POST['LKA'];
        $LDW = $_POST['LDW'];
        $DFD = $_POST['DFD'];
        $cameras = $_POST['cameras'];
        $dashcam = $_POST['dashcam'];
        $parking = $_POST['parking'];
        $airbags = $_POST['airbags'];
        $sideairbags = $_POST['sideairbags'];
        $curtainairbags = $_POST['curtainairbags'];
        $kneeairbags = $_POST['kneeairbags'];
        $immobilizer = $_POST['immobilizer'];
        $alarm = $_POST['alarm'];
        $headlights = $_POST['headlights'];
    
        // Sixth database insertion
        // Health score
        $enginehealth = $_POST['enginehealth'];
        $electricalshealth = $_POST['electricalshealth'];
        $transmissionhealth = $_POST['transmissionhealth'];
        $suspensionhealth = $_POST['suspensionhealth'];
        $brakeshealth = $_POST['brakeshealth'];
        $tyreshealth = $_POST['tyreshealth'];
        $batteryhealth = $_POST['batteryhealth'];
        $fluidshealth = $_POST['fluidshealth'];
        $exhausthealth = $_POST['exhausthealth'];
        $lightshealth = $_POST['lightshealth'];
        $wipershealth = $_POST['wipershealth'];
        $interiorhealth = $_POST['interiorhealth'];
        $exteriorhealth = $_POST['exteriorhealth'];
        $healthdescription = $_POST['healthdescription'];
    
        // Seventh database insertion
        // Standards
        $rating = $_POST['rating'];
        $verification = $_POST['verification'];
        $logbook = $_POST['logbook'];
        $viewing = $_POST['viewing'];
        $warranty = $_POST['warranty'];
        $servicehistory = $_POST['servicehistory'];
        $accidenthistory = $_POST['accidenthistory'];
    
        //Check if the vehicle already exists by referencing the plates, Vin and chassis number
        $stmt = $conn->prepare("SELECT * FROM vehicles WHERE plates = ? OR VIN = ? OR chassis = ?");
        $stmt->bind_param("sss", $plates, $VIN, $chassis);
        $stmt->execute();
        $stmt->store_result();
        $stmt->fetch();
        if ($stmt->num_rows > 0) {
            echo '<script>alert("Vehicle with the same plates, VIN or chassis number already exists in the database");window.history.back();</script>';
            exit();
        }
    
        // Populating database
        $stmt = $conn->prepare("INSERT INTO vehicles (make, model, category, description, price, plates, VIN, chassis, availability, status, YOM, mileage, drivetrain, pricestatus, collection, tags, images, cityconsumption, highwayconsumption, combinedconsumption, turningcircle, groundclearance, seatingcapacity, doors, bootcapacity, towingcapacity, wheelsize, tyresize, wheeltype, fuelcapacity, fueltype, engineoutput, aspiration, horsepower, torque, enginelayout, transmission, gears, sprint, topspeed, braketype, package, extcolour, intcolour, intmaterial, intpanels, audio, air, infotainment, keyless, sunroof, heatseats, ventseats, heatsteering, rearsteering, steeringtype, tpmonitor, ABS, ESC, TCS, CBC, AEB, FCW, ISOFIX, BSM, ACC, LKA, LDW, DFD, cameras, dashcam, parking, airbags, sideairbags, curtainairbags, kneeairbags, immobilizer, alarm, headlights, enginehealth, electricalshealth, transmissionhealth, suspensionhealth, brakeshealth, tyreshealth, batteryhealth, fluidshealth, exhausthealth, lightshealth, wipershealth, interiorhealth, exteriorhealth, healthdescription, rating, verification, logbook, viewing, warranty, servicehistory, accidenthistory) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        if ($stmt) {
            $stmt->bind_param("ssssisssssiisssssiiiiiiiiiiisisisiissiiisssssssssssssssssssssssssssssssssssssssiiiiiiiiiiiiisdssssss", $make, $model, $category, $description, $price, $plates, $VIN, $chassis, $availability, $status, $YOM, $mileage, $drivetrain, $pricestatus, $collection, $tags, $images, $cityconsumption, $highwayconsumption, $combinedconsumption, $turningcircle, $groundclearance, $seatingcapacity, $doors, $bootcapacity, $towingcapacity, $wheelsize, $tyresize, $wheeltype, $fuelcapacity, $fueltype, $engineoutput, $aspiration, $horsepower, $torque, $enginelayout, $transmission, $gears, $sprint, $topspeed, $braketype, $package, $extcolour, $intcolour, $intmaterial, $intpanels, $audio, $air, $infotainment, $keyless, $sunroof, $heatseats, $ventseats, $heatsteering, $rearsteering, $steeringtype, $tpmonitor, $ABS, $ESC, $TCS, $CBC, $AEB, $FCW, $ISOFIX, $BSM, $ACC, $LKA, $LDW, $DFD, $cameras, $dashcam, $parking, $airbags, $sideairbags, $curtainairbags, $kneeairbags, $immobilizer, $alarm, $headlights, $enginehealth, $electricalshealth, $transmissionhealth, $suspensionhealth, $brakeshealth, $tyreshealth, $batteryhealth, $fluidshealth, $exhausthealth, $lightshealth, $wipershealth, $interiorhealth, $exteriorhealth, $healthdescription, $rating, $verification, $logbook, $viewing, $warranty, $servicehistory, $accidenthistory);
            $stmt->execute();
            $stmt->close();
    
            echo '<script>
                alert("Vehicle has been suceessfully added to the database");
                window.location.href = "/profile/adminprofile/index.php";
                </script>';
    
            $conn->close();
        } else {
            echo '<script>alert("Error preparing statements. Check backend entries'. $conn->error.'");window.history.back();</script>';
        }
    }
}
else
{
    echo '<script>alert("You are not authorized to complete this procedure");
    window.location.href = "/index.php";
    </script>';
}

?>
