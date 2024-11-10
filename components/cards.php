<div class="superpanel">
    <?php

    //Search params
    // Retrieve search parameters from GET
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $subcategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : '';
    $minPrice = isset($_GET['minprice']) ? $_GET['minprice'] : '';
    $maxPrice = isset($_GET['maxprice']) ? $_GET['maxprice'] : '';
    $condition = isset($_GET['status']) ? $_GET['status'] : '';
    $availability = isset($_GET['availability']) ? $_GET['availability'] : '';
    $tags = isset($_GET['tags']) ? $_GET['tags'] : '';
    $rating = isset($_GET['rating']) ? $_GET['rating'] : '';


    // Check if any search parameters are set
    $isSearch = false;

    // Start building the base query
    $query = "SELECT * FROM products WHERE 1=1";

        // Filter by keyword
        if (!empty($keyword)) {
            $query .= " AND (productName LIKE ? OR productDesc LIKE ?)";
            $keywordParam = '%' . $keyword . '%';
            $params[] = $keywordParam;
            $params[] = $keywordParam;
            $types .= 'ss';
        }
    
        // Filter by category and subcategory
        if (!empty($category)) {
            $query .= " AND subcatID IN (SELECT subcatID FROM subcategories WHERE categoryID = ?)";
            $params[] = $category;
            $types .= 'i';
        }
        if (!empty($subcategory)) {
            $query .= " AND subcatID = ?";
            $params[] = $subcategory;
            $types .= 'i';
        }
    
        // Filter by price range
        if (!empty($minPrice)) {
            $query .= " AND price >= ?";
            $params[] = (float)$minPrice;
            $types .= 'd';
        }
        if (!empty($maxPrice)) {
            $query .= " AND price <= ?";
            $params[] = (float)$maxPrice;
            $types .= 'd';
        }
    
        // Filter by condition
        if (!empty($condition)) {
            $query .= " AND condition = ?";
            $params[] = $condition;
            $types .= 's';
        }
    
        // Filter by availability (mapped to quantity)
        if (!empty($availability)) {
            if ($availability == 'In stock') {
                $query .= " AND quantity > 0";
            } elseif ($availability == 'Out of stock') {
                $query .= " AND quantity = 0";
            }
        }
    
        // Filter by tags
        if (!empty($tags)) {
            $query .= " AND tags LIKE ?";
            $params[] = '%' . $tags . '%';
            $types .= 's';
        }
    
        // Filter by consumer rating
        if (!empty($rating)) {
            $query .= " AND rating >= ?";
            $params[] = (int)$rating;
            $types .= 'i';
        }

    // Execute the search query if parameters are set
    if ($isSearch) {
        $results = $conn->query($query);
    } else {
        // Otherwise, load default vehicles with pagination
        $cardsPerPage = 32;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $cardsPerPage;

        // Default query for all vehicles with pagination
        $stmt = $conn->prepare("SELECT * FROM products LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $cardsPerPage, $offset);
        $stmt->execute();
        $results = $stmt->get_result();
    }

    // Display the results
    $cardId = 1;
    while ($row = $results->fetch_assoc()) {
        // Fetch and display vehicle details (as in your current code)
        $productID = $row['productID'];
        $productName = $row['productName'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $productPrice = $row['price'];
        $images = $row['images'];
        $availability = $row['availability'];

        // Checking availability value
        $statusClass = '';
        switch ($availability) {
            case 'Available': $statusClass = 'available'; break;
            case 'Sold': $statusClass = 'sold'; break;
            case 'Reserved': $statusClass = 'reserved'; break;
            case 'Import': $statusClass = 'import'; break;
            case 'Showcase': $statusClass = 'showcase'; break;
            default: $statusClass = 'available'; break;
        }

        // Image JSON to PHP array
        $images = json_decode($images, true);

        // Number formatting
        $price = number_format($productPrice);

        // Display the card
        ?>
        <div class="supercard">
            <div class="status">
                <h2 class="sm-title <?php echo $statusClass; ?>"><?php echo $availability; ?></h2>
            </div>
            <div class="cardimage" id="card-<?php echo $cardId; ?>">
                <!--Loading animation-->
                <!-- <canvas class="loading-canvas"></canvas> -->
                <?php
                foreach ($images as $key => $image) {
                    $display = ($key == 0) ? 'block' : 'none';
                    echo '<img class="slides" src="'.$image.'" alt="'.$productName.'" style="display:'.$display.'">';
                }
                echo '<div class="navbuttons">';
                echo '<button class="navbutton" onclick="plusSlides(-1, ' . $cardId . ')"><i class="ri-arrow-left-s-line"></i></button>';
                echo '<button class="navbutton" onclick="plusSlides(1, ' . $cardId . ')"><i class="ri-arrow-right-s-line"></i></button>';
                echo '</div>';
                ?>
            </div>
            <div class="cardcontent" ondblclick="viewer(<?php echo $productID; ?>);">
                <p><?php echo $productName; ?></p>
                <span><?php echo $category.' | '.$subcategory; ?></span>
                <p><?php echo $price; ?><sup>KES</sup></p>
                <div class="add-cart">
                    <button onclick="addToCart('<?php echo $productID; ?>', '<?php echo addslashes($productName); ?>', <?php echo $productPrice; ?>, <?php echo $row['quantity']; ?>)">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>

            </div>
        </div>
        <?php
        $cardId++;
    }

    if ($results->num_rows === 0) {
        echo 'Ooops! Nothing to show here';
    }


    //Pagination logic
    $cardsPerPage = 32;

    // Get the current page or set default to 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the offset for the query
    $offset = ($page - 1) * $cardsPerPage;

    // Get the total number of vehicles to calculate the total number of pages
    $stmtTotal = $conn->prepare("SELECT COUNT(*) AS total FROM products");
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