<div class = "product-items">
            <?php
                // Database connection
                $servername = 'localhost';
                $username = 'root';
                $password_db = 'timonkisera123456_';
                $dbname = 'cardepot';

                $conn = new mysqli($servername, $username, $password_db, $dbname);

                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

                $stmt = $conn->prepare("SELECT * FROM vehicles");
                $stmt->execute();
                $result = $stmt->get_result();
                
                while($row = $result->fetch_assoc()){
                    $make = $row['make'];
                    $model = $row['model'];
                    $YOM = $row['YOM'];
                    $price = $row['price'];
                    $mileage = $row['mileage'];
                    $fueltype = $row['fueltype'];
                    $transmission = $row['transmission'];
                    $images = $row['images'];
                    $availability = $row['availability'];
                    $engineoutput = $row['engineoutput'];

                    //Image JSON to PHP array
                    $images = json_decode($images, true);

                    //Number formatting
                    $price = number_format($price);
                    $mileage = number_format($mileage);


                    ?>
                    <!-- single product -->
                    <div class = "product">
                        <div class = "product-content">
                            <div class = "product-img">
                                <!--Display the last image-->
                                <img src = "<?php echo $images[1]?>" alt = "<?php echo $make.' '.$model?>">
                            </div>
                            <!-- <div class = "product-btns">
                                <button type = "button" class = "btn-cart"> Gallery
                                    <span><i class="fa fa-star"></i></span>
                                </button>
                                
                            </div> -->
                        </div>
        
                        <div class = "product-info">
                            <div class = "product-info-top">
                                <h2 class = "sm-title"><?php echo $make.' '.$model?></h2>
                                <div class = "rating">
                                    <!-- <span><i class = "fas fa-star"></i></span> -->
                                    <span onclick="favourite();"><i class = "far fa-star"></i></span>
                                    <!--JS to add item to favourites by changing the star-->
                                    <script>
                                        function favourite() {
                                            var element = document.querySelector(".fa-star");
                                            element.classList.toggle("fas");
                                        }
                                    </script>
                                </div>
                            </div>
                            <a href = "#" class = "product-name">
                                <?php echo $engineoutput.' CC | '.$mileage.' km | '.$YOM.' | '.$fueltype.' | '.$transmission?>
                            </a>
                            <p class = "product-price"><?php echo $price?><sup>KES</sup></p>
                        </div>
        
                        <div class = "off-info">
                            <h2 class = "sm-title"><?php echo $availability?></h2>
                        </div>
                    </div>
                    <?php
                }

                if($result->num_rows === 0){
                    echo 'No vehicles found';
                }
                ?>
        </div>