<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Receipt</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        
        .receipt-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px dashed #aaa;
            border-radius: 8px;
            background-color: #fefefe;
            font-family: 'Courier New', Courier, monospace;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .receipt-container::before,
        .receipt-container::after {
            content: "";
            position: absolute;
            top: 10px;
            width: 30px;
            height: 10px;
            border-radius: 5px;
            background-color: #fefefe;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .receipt-container::before {
            left: -15px;
        }
        .receipt-container::after {
            right: -15px;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .receipt-details p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #aaa;
        }

        .receipt-item:last-child {
            border-bottom: none;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
            color: #333;
            margin-top: 15px;
        }

        .thank-you {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

       
        .dotted-line {
            width: 100%;
            height: 1px;
            background: repeating-linear-gradient(
                to right,
                #aaa,
                #aaa 5px,
                transparent 5px,
                transparent 10px
            );
            margin: 20px 0;
        }

        
        .finish-button {
            display: block;
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            background-color: orange;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .finish-button:hover {
            background-color: orange;
        }

       
        .confirmation-message {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #2D3E4E;
            display: none;
        }

        
        .mpesa-input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <h1>Order Receipt</h1>
        
        
        <div class="receipt-details">
            <div class="receipt-item">
                <span>Name:</span> <span><?php echo $_SESSION['fname'].' '.$_SESSION['lname']?></span>
            </div>
            <div class="receipt-item">
                <span>Delivery Address:</span>
                <input type="text" class="delivery_address" id="delivery_address" placeholder="Enter Your Delivery Address" required>
            </div>
            <div class="receipt-item">
                <span>Email Address:</span>
                <input type="text" class="email_address" id="email_address" value="<?php echo $_SESSION['email']?>" required>
            </div>
            <div class="receipt-item">
                <span>MPesa Number:</span>
                <input type="text" class="mpesa-input" id="mpesaNumber" placeholder="Enter MPesa Number" required>
            </div>
        </div>

        <div class="dotted-line"></div>

        
        <div class="total">Total: Ksh 1200.00</div>

        
        <button class="finish-button" onclick="showConfirmation()">Finish</button>


        <div class="confirmation-message" id="confirmationMessage">You will receive a prompt to pay for your order</div>
        
    
        <div class="thank-you">Thank you for shopping with us!</div>
    </div>

    <script>
        function showConfirmation() {
           
            const mpesaNumber = document.getElementById("mpesaNumber").value;
            if (mpesaNumber) {
                document.getElementById("confirmationMessage").style.display = "block";
            } else {
                alert("Please enter your MPesa number.");
            }
        }
    </script>
</body>
</html>
