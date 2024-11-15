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
// Cart functionality in checkout page
document.addEventListener("DOMContentLoaded", function () {
    const cart = JSON.parse(localStorage.getItem("cart")) || {};
    const listItemsContainer = document.querySelector(".list-items");
    const totalPriceElement = document.createElement("div");

    let totalPrice = 0;
    let itemNames = [];
    let itemQuantities = [];
    let itemPrices = [];
    let itemTotalPrices = [];
    let sellerUID = [];

    // Clear the container
    listItemsContainer.innerHTML = "";

    for (const [productID, item] of Object.entries(cart)) {
        // Skip if item data is invalid
        if (!item.name || !item.price || !item.quantity) continue;

        // Calculate total price for current item
        const itemTotalPrice = item.price * item.quantity;
        totalPrice += itemTotalPrice;

        // Populate arrays for form submission
        itemNames.push(item.name);
        itemQuantities.push(item.quantity);
        itemPrices.push(item.price);
        itemTotalPrices.push(itemTotalPrice);
        sellerUID.push(item.sellerUID);

        // Create item element
        const itemElement = document.createElement("div");
        itemElement.classList.add("item");
        itemElement.innerHTML = `
            <h2>${item.name}</h2>
            <p>Price: ${item.price} KES</p>
            <p>Quantity: ${item.quantity}</p>
            <p>Total: ${itemTotalPrice.toFixed(2)} KES</p>
        `;
        listItemsContainer.appendChild(itemElement);
    }

    // Show total price
    totalPriceElement.innerHTML = `<h2>Total Price: ${totalPrice.toFixed(2)} KES</h2>`;
    listItemsContainer.appendChild(totalPriceElement);

    // Add hidden inputs to form
    const form = document.querySelector(".checkout-container form");

    const inputs = [
        { name: "totalPrice", value: totalPrice.toFixed(2) },
        { name: "itemNames", value: JSON.stringify(itemNames) },
        { name: "itemQuantities", value: JSON.stringify(itemQuantities) },
        { name: "itemPrices", value: JSON.stringify(itemPrices) },
        { name: "itemTotalPrices", value: JSON.stringify(itemTotalPrices) },
        { name: "sellerUID", value: JSON.stringify(sellerUID) },
    ];

    inputs.forEach(({ name, value }) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        form.appendChild(input);
    });

    // Handle empty cart scenario
    if (Object.keys(cart).length === 0) {
        const emptyMessage = document.createElement("p");
        emptyMessage.textContent = "Your cart is empty.";
        window.loaction.href="/pages/stock.php";
        listItemsContainer.appendChild(emptyMessage);
    }
});

</script>
