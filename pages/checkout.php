<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="/pageclasses/assets/css/checkout.css">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/defaults.css">
</head>
<body>
    <?php
    //Load navbar
    require_once('../loader.php');
    $header->navigation();

    if (!isset($_SESSION['userID']))
    {
        echo '<script>
        alert("You must be authenticated to proceed with checkout");
        window.location.href="login.php";
        </script>';
        exit;
    }
    ?>

    <div class="main">
        <!--Cart Items-->
        <div class="products">
            <h1>Items Ordered</h1>
            <div class="list-items">
                <!-- <div class="item">
                    <h2>Product Name</h2>
                    <p>Price</p>
                    <p>Quantity</p>
                    <p>Total</p>
                </div>
                <div class="item">
                    <h2>Product Name</h2>
                    <p>Price</p>
                    <p>Quantity</p>
                    <p>Total</p>
                </div>
                <div class="item">
                    <h2>Product Name</h2>
                    <p>Price</p>
                    <p>Quantity</p>
                    <p>Total</p>
                </div>
                <div class="item">
                    <h2>Product Name</h2>
                    <p>Price</p>
                    <p>Quantity</p>
                    <p>Total</p>
                </div>
                <div class="item">
                    <h2>Product Name</h2>
                    <p>Price</p>
                    <p>Quantity</p>
                    <p>Total</p>
                </div> -->
            </div>
            <!--Populate from JS-->
        </div>

        <!--Checkout Container-->
        <div class="checkout-container">
            <form action="/pageclasses/assets/php/checkout.php" method="POST">
                <h1>Shipping Details</h1>

                <!--Name-->
                <div class="form-group">
                    <div class="form-comp">
                        <label>First Name</label>
                        <input type="text" name="fname" value="<?php echo $_SESSION['fname']?>" required>
                        <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']?>">
                    </div>
                    <div class="form-comp">
                        <label>Last Name</label>
                        <input type="text" name="lname" value="<?php echo $_SESSION['lname']?>" required>
                    </div>
                </div>

                <!--Email-->
                <div class="form-group">
                    <div class="form-comp">
                        <label>Email</label>
                        <input type="email " name="email" value="<?php echo $_SESSION['email']?>" required>
                    </div>
                </div>

                <!--City & Address-->
                <div class="form-group">
                    <div class="form-comp">
                        <label for="city">City</label>
                        <input type="text" name="city" required>
                    </div>
                    <div class="form-comp">
                        <label for="address">Address</label>
                        <input type="text" name="address" required>
                    </div>
                </div>

                <!--Phone Number-->
                <div class="form-group">
                    <div class="form-comp">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" required>
                    </div>
                </div>
                <button type="submit" class="submit-button">Complete Order</button>
                <p>The business is fully liable for delivery and damages, making your money refundable in such cases</p>
            </form>
        </div>
    </div>

<?php
$footer->footercont();
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const cart = JSON.parse(localStorage.getItem("cart")) || {};
    const listItemsContainer = document.querySelector(".list-items");
    listItemsContainer.innerHTML = ""; // Clear default template content

    for (const [productID, item] of Object.entries(cart)) {
        const itemElement = document.createElement("div");
        itemElement.classList.add("item");
        itemElement.innerHTML = `
            <h2>${item.name}</h2>
            <p>Price: ${item.price} KES</p>
            <p>Quantity: ${item.quantity}</p>
            <p>Total: ${(item.price * item.quantity).toFixed(2)} KES</p>
        `;
        listItemsContainer.appendChild(itemElement);
    }
});
</script>