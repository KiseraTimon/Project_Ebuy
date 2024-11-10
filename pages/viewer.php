<?php
//Database Connection
require '../components/database.php';

//Loader file
require_once ('../loader.php');

//Validating the vehicleID
if (isset($_GET['productID'])) {
    $productID= $_GET['productID'];
    
    //Fetching the vehicle details
    $sql = "SELECT * FROM products WHERE productID = '$productID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Populating reference variables
        while ($row = $result->fetch_assoc())
        {
            // Database fields
            $productName = $row['productName'];
            $productDesc = $row['productDesc'];
            $price = $row['price'];
            $pricestatus = $row['pricestatus'];
            $quantity = $row['quantity'];
            $category = $row['category'];
            $subcategory = $row['subcategory'];
            $userID = $row['userID'];
            $images = $row['images'];

            //Decoding JSON image paths to PHP array
            $images = json_decode($images, true);

            // Fetching category name
            $catquery = "SELECT category FROM categories WHERE categoryID = '$category'";
            $catresult = $conn->query($catquery);
            $catrow = $catresult->fetch_assoc();
            $catname = $catrow['category'];
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
    <title><?php echo $productName?></title>

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

    <!--Header-->
    <?php
    $header->navigation();
    ?>

    <div class="mainpanel">
        <!--Vehicle Navigation Panel-->
        <div class="navigator">
            <p>
                <a href="stock.php">Products > </a>
                <a href="stock.php?subcategory='<?php $catname?>'"><?php echo $catname?> > </a>
                <a href="stock.php?subcategory='<?php $subcategory?>'"><?php echo $subcategory?> > </a>
            <?php echo $productName?></p>
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
                    <?php echo '<img id="first" src="/inventory/'.$images[0].'" alt="'.$productName.'">';?>

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
                            echo '<img id="row" src="/inventory/'.$image.'" alt="'.$productName.'" onclick="showImg('.$index.')">';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="detailspanel">
                <div class="name">
                    <p>
                        <?php echo $productName?>
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
                    <p><?php echo $productDesc?></p>
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
                <!-- <div class="stats">
                    <span><?php echo $engineoutput.' cc'?></span>
                    <span><?php echo $mileage.' km'?></span>
                    <span><?php echo $transmission?></span>
                    <span><?php echo $YOM?></span>
                </div> -->
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
                            <td>ebuy@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Visit</td>
                            <td>Ole Sangale Dr</td>
                        </tr>
                    </table>
                </div>
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