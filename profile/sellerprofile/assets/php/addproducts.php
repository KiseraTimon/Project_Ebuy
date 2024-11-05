<?php
// Database connection
require ('../../../../components/database.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productName = $_POST['productName'];
    $productDesc = $_POST['productDesc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
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
    $stmt = $conn->prepare("INSERT INTO products (productName, productDesc, price, quantity, category, subcategory, images, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdissss", $productName, $productDesc, $price, $quantity, $category, $subcategory, $images, $availability);

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
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>

        <!--Header-->
        <?php
        require_once('/loader.php');

        $header->navigation();
        $footer->footercont();
        ?>

    <h1>Add a New Product</h1>
    <form action="addproducts.php" method="POST" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>
        
        <label for="productDesc">Description:</label>
        <textarea id="productDesc" name="productDesc" required></textarea>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        
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
                <option value="in stock">In Stock</option>
                <option value="out of stock">Out of Stock</option>
            </select>
            
            <input type="submit" value="Add Product">
        </form>
    </form>
</body>
</html>
