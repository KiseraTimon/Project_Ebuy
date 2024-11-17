<div class="superpanel">
    <?php
    // Include database connection
    require('database.php');

    // Search parameters with defaults
    $searchParams = [
        'keyword' => $_GET['keyword'] ?? '',
        'category' => $_GET['category'] ?? '',
        'subcategory' => $_GET['subcategory'] ?? '',
        'minprice' => $_GET['minprice'] ?? '',
        'maxprice' => $_GET['maxprice'] ?? '',
        'status' => $_GET['status'] ?? '',
        'availability' => $_GET['availability'] ?? '',
        'tags' => $_GET['tags'] ?? '',
        'rating' => $_GET['rating'] ?? ''
    ];

    // Base query and filters
    $query = "SELECT * FROM products WHERE 1=1";
    $params = [];
    $types = '';

    foreach ($searchParams as $key => $value) {
        if (!empty($value)) {
            $isSearch = true;
            switch ($key) {
                case 'keyword':
                    $query .= " AND (productName LIKE ? OR productDesc LIKE ?)";
                    $params[] = "%$value%";
                    $params[] = "%$value%";
                    $types .= 'ss';
                    break;
                case 'category':
                    $query .= " AND subcatID IN (SELECT subcatID FROM subcategories WHERE categoryID = ?)";
                    $params[] = (int)$value;
                    $types .= 'i';
                    break;
                case 'subcategory':
                    $query .= " AND subcatID = ?";
                    $params[] = (int)$value;
                    $types .= 'i';
                    break;
                case 'minprice':
                    $query .= " AND price >= ?";
                    $params[] = (float)$value;
                    $types .= 'd';
                    break;
                case 'maxprice':
                    $query .= " AND price <= ?";
                    $params[] = (float)$value;
                    $types .= 'd';
                    break;
                case 'status':
                    $query .= " AND condition = ?";
                    $params[] = $value;
                    $types .= 's';
                    break;
                case 'availability':
                    $query .= $value == 'In stock' ? " AND quantity > 0" : " AND quantity = 0";
                    break;
                case 'tags':
                    $query .= " AND tags LIKE ?";
                    $params[] = "%$value%";
                    $types .= 's';
                    break;
                case 'rating':
                    $query .= " AND rating >= ?";
                    $params[] = (int)$value;
                    $types .= 'i';
                    break;
            }
        }
    }

    // Pagination logic
    $cardsPerPage = 32;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $cardsPerPage;

    $query .= " LIMIT ? OFFSET ?";
    $params[] = $cardsPerPage;
    $params[] = $offset;
    $types .= 'ii';

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows === 0) {
        echo '<p>Oops! No results found.</p>';
    } else {
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

            //Category
            $catquery = "SELECT category FROM categories WHERE categoryID = ?";
            $stmt = $conn->prepare($catquery);
            $stmt->bind_param("i", $category);
            $stmt->execute();
            $result = $stmt->get_result();
            $category = $result->fetch_assoc()['category'];

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

                    <!--Add to cart button-->
                    <div class="add-cart">
                        <button onclick="addToCart('<?php echo $productID; ?>', '<?php echo addslashes($productName); ?>', <?php echo $productPrice; ?>, <?php echo $row['quantity']; ?>, <?php echo $row['userID'];?>)">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>

                </div>
            </div>
            <?php
            $cardId++;
        }
    }

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