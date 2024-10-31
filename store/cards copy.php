<div class="superpanel">
    <?php

    // Start building the query
    $query = "SELECT * FROM vehicles WHERE 1=1";

    // Filter by keyword
    if (!empty($keyword)) {
        $query .= " AND (make LIKE '%$keyword%' OR model LIKE '%$keyword%' OR description LIKE '%$keyword%')";
    }

    // Filter by make
    if (!empty($make)) {
        $query .= " AND makeID = '$make'";
    }

    // Filter by model
    if (!empty($model)) {
        $query .= " AND model = '$model'";
    }

    // Filter by year range
    if (!empty($minYear)) {
        $query .= " AND year >= $minYear";
    }
    if (!empty($maxYear)) {
        $query .= " AND year <= $maxYear";
    }

    // Filter by price range
    if (!empty($minPrice)) {
        $query .= " AND price >= $minPrice";
    }
    if (!empty($maxPrice)) {
        $query .= " AND price <= $maxPrice";
    }

    // Filter by mileage range
    if (!empty($minMileage)) {
        $query .= " AND mileage >= $minMileage";
    }
    if (!empty($maxMileage)) {
        $query .= " AND mileage <= $maxMileage";
    }

    // Filter by engine capacity range
    if (!empty($minCC)) {
        $query .= " AND engine_cc >= $minCC";
    }
    if (!empty($maxCC)) {
        $query .= " AND engine_cc <= $maxCC";
    }

    // Execute the query
    $results = $conn->query($query);

    //Display search results
    $cardId=1;
    while($row = $results->fetch_assoc())
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

    //Cards where search parameters are applied
    ?>
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

    if($results->num_rows === 0){
        echo 'Ooops! Nothing to show here';
    }


    $cardsPerPage = 32;

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
        echo 'Ooops! Nothing to show here';
    }

    // Get the total number of vehicles to calculate the total number of pages
    $stmtTotal = $conn->prepare("SELECT COUNT(*) AS total FROM vehicles");
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $totalVehicles = $resultTotal->fetch_assoc()['total'];

    // Calculate total pages
    $totalPages = ceil($totalVehicles / $cardsPerPage);
    ?>

</div>

<!-- Pagination -->
<div class="pagination">
    <?php
    // Calculate total pages
    $totalPages = ceil($totalVehicles / $cardsPerPage);

    // Define the range of pages to display
    $maxVisiblePages = 4;
    $startPage = max(1, $page - 2);
    $endPage = min($totalPages, $page + 2);

    // Adjust the start and end if we're near the beginning or end
    if ($totalPages <= $maxVisiblePages) {
        // Show all pages if total pages are less than max visible
        $startPage = 1;
        $endPage = $totalPages;
    } elseif ($page <= 2) {
        // If we're near the start, ensure the first 4 pages show
        $startPage = 1;
        $endPage = min($totalPages, $maxVisiblePages);
    } elseif ($page >= $totalPages - 1) {
        // If we're near the end, ensure the last 4 pages show
        $startPage = max(1, $totalPages - ($maxVisiblePages - 1));
        $endPage = $totalPages;
    }

    // Previous Button
    if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">&laquo; Prev</a>
    <?php endif; ?>

    <!-- Display page numbers within the range -->
    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <!-- "..." to indicate hidden pages on the left -->
    <?php if ($startPage > 1): ?>
        <span>...</span>
        <a href="?page=1">1</a>
    <?php endif; ?>

    <!-- "..." to indicate hidden pages on the right -->
    <?php if ($endPage < $totalPages): ?>
        <span>...</span>
        <a href="?page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a>
    <?php endif; ?>

    <!-- Next Button -->
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
    <?php endif; ?>
</div>