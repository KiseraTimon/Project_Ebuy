<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        .cart-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            margin-right: 20px;
            border-radius: 4px;
            object-fit: cover;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        .item-price {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }

        .remove-button {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-button:hover {
            background-color: #c0392b;
        }

        .total-container {
            margin-top: 20px;
            text-align: right;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Shopping Cart</h1>

        
        <div class="cart-item">
            <img src="https://via.placeholder.com/80" alt="Item Image" class="item-image">
            <div class="item-details">
                <p class="item-name">Item Name 1</p>
                <p class="item-price">Price: Ksh 500</p>
            </div>
            <button class="remove-button">Remove</button>
        </div>

        
        <div class="cart-item">
            <img src="https://via.placeholder.com/80" alt="Item Image" class="item-image">
            <div class="item-details">
                <p class="item-name">Item Name 2</p>
                <p class="item-price">Price: Ksh 300</p>
            </div>
            <button class="remove-button">Remove</button>
        </div>


        <div class="cart-item">
            <img src="https://via.placeholder.com/80" alt="Item Image" class="item-image">
            <div class="item-details">
                <p class="item-name">Item Name 2</p>
                <p class="item-price">Price: Ksh 300</p>
            </div>
            <button class="remove-button">Remove</button>
        </div>

        <div class="cart-item">
            <img src="https://via.placeholder.com/80" alt="Item Image" class="item-image">
            <div class="item-details">
                <p class="item-name">Item Name 2</p>
                <p class="item-price">Price: Ksh 100</p>
            </div>
            <button class="remove-button">Remove</button>
        </div>

        
        <div class="total-container">
            <p class="total-price">Total: Ksh 1200</p>
        </div>
    </div>
</body>
</html>
