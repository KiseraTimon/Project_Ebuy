<div class="superpanel">
    <?php

    // $stmt = $conn->prepare("SELECT * FROM vehicles");
    // $stmt->execute();
    // $result = $stmt->get_result();

    // Number of cards per page
    $cardsPerPage = 1;

    // Get the current page or set default to 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the offset for the query
    $offset = ($page - 1) * $cardsPerPage;

    // Prepare the paginated query
    $stmt = $conn->prepare("SELECT * FROM vehicles LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $cardsPerPage, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $cardId=1;
    while($row = $result->fetch_assoc())
    {
        $vehicleID = $row['vehicleID'];
        $make = $row['make'];
        $model = $row['model'];
        $YOM = $row['YOM'];
        $price = $row['price'];
        $mileage = $row['mileage'];
        $fueltype = $row['fueltype'];
        $transmission = $row['transmission'];
        $images = $row['images'];
        $availability = $row['availability'];
        $engineoutput = $row['engineoutput'];

        //Checking availability value
        // Determine the class based on availability
        $statusClass = '';
        switch ($availability) {
            case 'Available':
                $statusClass = 'available';
                break;
            case 'Sold':
                $statusClass = 'sold';
                break;
            case 'Reserved':
                $statusClass = 'reserved';
                break;
            case 'Import':
                $statusClass = 'import';
                break;
            case 'Showcase':
                $statusClass = 'showcase';
                break;
            default:
                $statusClass = 'available';
                break;
        }

        //Image JSON to PHP array
        $images = json_decode($images, true);

        //Number formatting
        $price = number_format($price);
        $mileage = number_format($mileage);
        ?>

        <!--Product cards-->
        <div class="supercard">
            <div class = "status">
            <h2 class="sm-title <?php echo $statusClass; ?>"><?php echo $availability; ?></h2>
            </div>
            <div class="cardimage" id="card-<?php echo $cardId; ?>">
                <?php
                //Loop through images
                foreach($images as $key => $image){
                    $display = ($key == 0) ? 'block' : 'none';
                    echo '<img class="slides" src="'.$image.'" alt="'.$make.' '.$model.'" style="display:'.$display.'">';
                }
                //Image navigation buttons
                echo '<div class="navbuttons">';
                echo '<button class="navbutton" onclick="plusSlides(-1, ' . $cardId . ')"><i class="ri-arrow-left-s-line"></i></button>';
                echo '<button class="navbutton" onclick="plusSlides(1, ' . $cardId . ')"><i class="ri-arrow-right-s-line"></i></button>';
                echo '</div>';
                ?>
            </div>
            <div class="cardcontent" onclick="viewer(<?php echo $vehicleID;?>);">
                <p><?php echo $make.' '.$model; ?></p>
                <span><?php echo $engineoutput.' CC | '.$mileage.' KM | '.$transmission.' | '.$YOM; ?></span>
                <p><?php echo $price; ?><sup>KES</sup></p>
                <!-- <a href="/productpages/viewer/index.php?vehicleID=<?php echo $vehicleID; ?>">
            </a> -->
            </div>
        </div>
        <?php

        $cardId++;
    }

    if($result->num_rows === 0){
        echo 'No vehicles found';
    }

    // Get the total number of vehicles to calculate the total number of pages
    $stmtTotal = $conn->prepare("SELECT COUNT(*) AS total FROM vehicles");
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $totalVehicles = $resultTotal->fetch_assoc()['total'];

    // Calculate total pages
    $totalPages = ceil($totalVehicles / $cardsPerPage);
    ?>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</div>