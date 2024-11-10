<?php
// Database connection
session_start();
require ('../../../../components/database.php');
require_once('../../../../loader.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productName = $_POST['productName'];
    $productDesc = $_POST['productDesc'];
    $price = $_POST['price'];
    $pricestatus = $_POST['pricestatus'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $userID = $_SESSION['userID'];
    $availability = $_POST['availability'];

    // Handle the image uploads
    $images = $_FILES['images'];
    $uploadedImages = [];
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    $uploadDir = '../../../../inventory/'; // Ensure this directory exists and is writable

    // Process each uploaded image
    foreach ($images['tmp_name'] as $key => $imageTmpName) {
        $imageName = $images['name'][$key];
        $imageSize = $images['size'][$key];
        $imageError = $images['error'][$key];

        if ($imageError === 0 && $imageSize <= $maxFileSize) {
            $imageType = mime_content_type($imageTmpName);
            if (in_array($imageType, $allowedTypes)) {
                $imagePath = $uploadDir . basename($imageName);
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $uploadedImages[] = $imagePath; // Store image paths in an array
                } else {
                    echo '<script>
                alert("Error uploading file: $imageName");
                window.history.back();
                </script>';
                }
            } else {
                echo '<script>
                alert("Invalid file type");
                window.history.back();
                </script>';
            }
        } else {
            echo '<script>
            alert("Error uploading file: $imageName");
            window.history.back();
            </script>';
        }
    }

    // Convert image paths array to JSON string for storing in the database
    $images = json_encode($uploadedImages);

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO products (productName, productDesc, price, pricestatus, quantity, category, subcategory, userID, images, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisiisiss", $productName, $productDesc, $price, $pricestatus, $quantity, $category, $subcategory, $userID, $images, $availability);

    // Execute statement and check for success
    if ($stmt->execute()) {
        echo '<script>
                alert("Product has been suceessfully added!");
                window.location.href = "/profile/sellerprofile/index.php";
                </script>';
    } else {
        echo '<script>
                alert("Error uploading product");
                window.history.back();
                </script>';
    }

    $stmt->close();
}
?>

<?php
// Query to get all categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Query to get all subcategories and organize them by categoryID
$subcategoryQuery = "SELECT * FROM subcategories";
$subcategoryResult = mysqli_query($conn, $subcategoryQuery);

$subcategoriesByCategory = [];
while ($row = mysqli_fetch_assoc($subcategoryResult)) {
    $subcategoriesByCategory[$row['categoryID']][] = $row['subcat'];
}

// Initialize selected category and subcategories
$selectedCategory = '';
$selectedSubcategories = [];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products | Ebuy</title>

    <link rel="stylesheet" href="../css/addproducts.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/defaults.css">
</head>
<body>

    <div class="add-prod">
        <form class="add-form" action="addproducts.php" method="POST" enctype="multipart/form-data">
            <h1>Add a New Product</h1>
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>
            
            <label for="productDesc">Description:</label>
            <textarea id="productDesc" name="productDesc" required></textarea>
    
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="pricestatus">Price Status:</label>
            <select id="pricestatus" name="pricestatus" required>
                <option value="Negotiable">Negotiable</option>
                <option value="Fixed">Fixed</option>
            </select>
            
            <label for="category">Category:</label>
            <!-- <input type="text" id="category" name="category" required> -->
            <form method="GET">
                <select id="category" name="category" required>
                    <option value="">Select category</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($categoryResult)) {
                        $selected = ($row['categoryID'] == $selectedCategory) ? 'selected' : '';
                        echo '<option value="'.$row['categoryID'].'" '.$selected.'>'.$row['category'].'</option>';
                    }
                    ?>
                </select>
    
    
                <label for="subcategory">Subcategory:</label>
                <select id="subcategory" name="subcategory" required>
                    <option value="">Select subcategory</option>
                    <!-- Script to populate subcategories based on selected category -->
                    <script>
                        document.getElementById('category').addEventListener('change', function() {
                            var selectedCategoryID = this.value;
                            var subcategories = <?php echo json_encode($subcategoriesByCategory); ?>;
                            var subcategoryDropdown = document.getElementById('subcategory');
                            subcategoryDropdown.innerHTML = '<option value="">Select subcategory</option>';
                            if (selectedCategoryID in subcategories) {
                                subcategories[selectedCategoryID].forEach(function(subcat) {
                                    var option = document.createElement('option');
                                    option.value = subcat;
                                    option.text = subcat;
                                    subcategoryDropdown.add(option);
                                });
                            }
                        });
                    </script>
                </select>
            
            
                <label for="images">Images:</label>
                <input type="file" id="images" name="images[]" multiple required>
                
                <label for="availability">Availability:</label>
                <select id="availability" name="availability" required>
                    <option value="Available">Available</option>
                    <option value="Sold">Sold</option>
                    <option value="Reserved">Reserved</option>
                    <option value="Import">Import</option>
                    <option value="Showcase">Showcase</option>
                </select>
                
                <input type="submit" value="Add Product">
            </form>
        </form>
    </div>


    <!--Footer-->
    <?php
    $footer->footercont();
    ?>
