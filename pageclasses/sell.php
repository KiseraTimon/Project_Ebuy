<?php


class sellpage
{
    function sellhead()
    {
        if (!isset($_SESSION['userType']) && $_SESSION['userType'] != 'admin') {
            echo '<script>
                    alert("You are not authorized to view this page.");
                    window.location.href = "/index.php";
                    </script>';
            exit();
        }
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sell your car | Car Depot</title>
                <link
                    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
                    rel="stylesheet"
                />
                <link rel="stylesheet" href="/pageclasses/assets/css/sell.css" />
                <link rel="stylesheet" href="/styles.css" />
                <link rel="stylesheet" href="/defaults.css" />
            </head>
            <body>
        <?php
    }

    function sell()
    {
        ?>
            <div class="major">
                <h1>Sell with Car Depot</h1>
                <p>Fill in the form below to initiate a request to sell your car with us</p>

                <div class="form">
                    <form action="assets/php/sell.php" method="POST" enctype="multipart/form-data">
                        <h2>Contact Details</h2>
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="name" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="number" name="phone" id="phone" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="county">County/City</label>
                            <input type="text" name="county" id="county" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="natID">National ID number</label>
                            <input type="number" name="natID" id="natID" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="frontnatID">National ID Photo (front)</label>
                            <input type="file" name="natfront" id="natIDfront" multiple required max="1">
                        </div>
                        <div class="form-group">
                            <label for="backnatID">National ID Photo (back)</label>
                            <input type="file" name="natback" id="natIDback" multiple required max="1">
                        </div>
                        <div class="form-group">
                            <label for="method">Preferred Contact Method</label><br>
                            <select name="method">
                                <option>Email</option>
                                <option>Phone</option>
                                <option>Either</option>
                            </select>
                        </div>
            
                        <hr>
                        <p class="note">*** all your contact information is secure with us ***</p>
                        <hr>
            
                        <h2>Car Details</h2>
                        <div class="form-group">
                            <label for="numplate">Number plate</label>
                            <input type="text" name="numplate" id="numplate" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="make">Make</label>
                            <input type="text" name="make" id="make" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" name="model" id="model" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="year">Year of Manufacture</label>
                            <input type="number" name="year" id="year" required maxlength="4">
                        </div>
                        <div class="form-group">
                            <label for="mileage">Mileage</label>
                            <input type="number" name="mileage" id="mileage" required maxlength="7">
                        </div>
                        <div class="form-group">
                            <label for="accident">Accident history</label>
                            <select name="accident" required>
                                <option>None</option>
                                <option>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="logbook">Logbook</label>
                            <select name="logbook" required>
                                <option>Available</option>
                                <option>Unavailable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Asking price (ksh.)</label>
                            <input type="number" name="price" id="price" required maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="carimages">One car image</label>
                            <input type="file" name="carimage" id="images" multiple required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        <?php
    }
}
?>