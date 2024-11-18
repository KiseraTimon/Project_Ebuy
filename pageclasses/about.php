<?php

class aboutpage
{
    //Header function
    function abouthead()
    {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>About | Ebuy</title>
                <!--External CSSs-->
                <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
                rel="stylesheet"
                />
                <!-- Font Awesome -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
                />
                <!-- Google Fonts -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqS1pt6ER7jxBqNC1L+1VRcPH4C8m25tTzI89e4OhoPHd+1qWl26d" crossorigin="anonymous">

                <!--Internal CSSs-->
                <link rel="stylesheet" href="/pageclasses/assets/css/about.css">
                <link rel="stylesheet" href="/styles.css">
                <link rel="stylesheet" href="/defaults.css">

            </head>
            <body>
        <?php
    }

    //About page
    function about()
    {
        global $ratings;
        ?>
            <div class="container">
                <div class="context">
                    <!--Introduction-->
                    <div id="intro" class="intro">
                        <h1>We are Ebuy</h1>
                        <p>
                            Ebuy is an e-commerce platform that has been in business for over 5 years. We have  wide range of products to cater for all your shopping needs. We have a team of experts who will help you find the perfect product for you. Our goal is to provide our customers with the best shopping experience.
                        </p>
                        <p><button onclick="window.location.href='/pages/stock.php'">Explore</button></p>
                    </div>
            
                    <!--Numbers-->
                    <div id="numbers" class="numbers">
                        <div class="box">
                            <i class="ri-car-washing-line"></i>
                            <h2>1,000+</h2>
                            <p>Registered Businesses</p>
                        </div>
                        <div class="box">
                            <i class="ri-group-3-line"></i>
                            <h2>500,000+</h2>
                            <p>Satisfied Shoppers</p>
                        </div>
                        <div class="box">
                            <i class="ri-map-line"></i>
                            <h2>40+</h2>
                            <p>Ebuy outlets</p>
                        </div>
                    </div>
            
                    <!--Team-->
                    <div id="team" class="team">
                        <div class="content">
                            <div class="teamimage">
                                <img src="/pageclasses/assets/images/about/team.jpg" alt="team">
                            </div>
                            <div class="teamnote">
                                <p>
                                    Our team is made up of passionate individuals who are dedicated to providing our customers with the best shopping experience. We have a team of experts who will help you find the perfect product for you. We have a wide range of products that cater to all your needs. We also provide customer support services to assist you with any queries you may have.
                                </p>
                            </div>
                        </div>
                    </div>
            
                    <!--Why us-->
                    <div id="unique" class="unique">
                        <div class="content">
                            <h1>Why Choose Us?</h1>
                            <div class="uniquebox">
                                <div class="box">
                                    <i class="ri-shield-check-line"></i>
                                    <h2>Quality Products</h2>
                                    <p>
                                        We offer quality products that are sourced from trusted suppliers. We have a team of experts who will help you find the perfect product for you.
                                    </p>
                                </div>
                                <div class="box">
                                    <i class="ri-money-dollar-circle-line"></i>
                                    <h2>Best Prices</h2>
                                    <p>
                                        We offer the best prices on all our products. We have a team of experts who will help you find the perfect product for you.
                                    </p>
                                </div>
                                <div class="box">
                                    <i class="ri-truck-line"></i>
                                    <h2>Free Delivery</h2>
                                    <p>
                                        Cut on delivery costs with our free delivery services. Our businesses ensure you get everything you need right from your point of comfort
                                    </p>
                                </div>
                            </div>
                            <div class="description">
                                <p>
                                    Ebuy ensures a seamless shopping experience for all customers. We offer convenient payment options, diverse and available products, fast and free delivery as well as dedicated customer support services, ensuring you get the best shopping experience.
                                </p>
                            </div>
                        </div>
                    </div>
            
                    <!--Story-->
                    <div id="story" class="story">
                        <div class="content">
                            <div class="contentimage">
                                <img src="/pageclasses/assets/images/about/experience.jpg" alt="story">
                            </div>
                            <h1>Our Story</h1>
                            <p>
                                Ebuy was founded in 2019 with the aim of providing customers with a convenient and reliable shopping experience. We have a team of experts who will help you find the perfect product for you. We have a wide range of products that cater to all your needs. We also provide customer support services to assist you with any queries you may have.
                                <br>
                                <br>
                                Our goal is to provide our customers with the best shopping experience. We offer quality products at the best prices. We also provide free delivery services to ensure that you get your products on time. We are committed to providing our customers with the best shopping experience.
                            </p>
                        </div>
                    </div>

                    <!--Services-->
                    <div id="services" class="services">
                        <div class="content">
                            <h1>Business Services</h1>
                            <div class="servicebox">
                                <div class="box">
                                    <i class="ri-bank-fill"></i>
                                    <h2>Business Funding</h2>
                                    <p>
                                        We offer business funding services to help you grow your business. We have a team of experts who will help you find the perfect product for you.
                                    </p>
                                </div>
                                <div class="box">
                                    <i class="ri-flag-line"></i>
                                    <h2>Advertising</h2>
                                    <p>
                                        We offer advertising services to help you promote your business. We have a team of experts who will help you find the perfect product for you.
                                    </p>
                                </div>
                                <div class="box">
                                    <i class="ri-pie-chart-fill"></i>
                                    <h2>Analytics</h2>
                                    <p>
                                        We offer analytics services to help you track your business performance. We have a team of experts who will help you find the perfect product for you.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Work with us-->
                    <div id="work" class="work">
                        <div class="content">
                            <h1>Become a member</h1>
                            <p>
                                You could be the youngest E-buyer today.
                                Join our platform today and experience what convenience, speed and efficiency in shopping is all about.
                            </p>
                            <p><button onclick="window.location.href='/pages/signup.php'">Sign Up</button></p>
                        </div>
                    </div>

                    <!--Testimonials-->
                    <div id="testimonials" class="testimonials">
                        <div class="content">
                            <h1>What others say about us</h1>
                            <div class="testpanel">
                                <?php
                                // Database Connection
                                include '../components/database.php';

                                //Populating variables
                                $sql = "SELECT * FROM testimonials";
                                $result = $conn->query($sql);

                                //Populating Testimonials
                                if ($result->num_rows > 0) {
                                    
                                    while($row = $result->fetch_assoc()) {
                                        //Variables

                                        $dispname = $row['dispname'];
                                        $tests = $row['tests'];
                                        $testreview = $row['testreview'];

                                    ?>
                                    <div class="testimonialcard">
                                        <div class="testname">
                                            <h2><?php echo $dispname;?></h2>
                                        </div>
                                        <div class="testcontent">
                                            <p><?php echo $tests;?></p>
                                        </div>
                                        <div class="testrating">
                                            <span>
                                                <?php
                                                if(isset($testreview))
                                                {
                                                    require_once ('../loader.php');
                                                    echo $ratings->displayStars($testreview);
                                                }
                                                else
                                                {
                                                    echo 'No rating';
                                                }
                                            ?>
                                            </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "Nothing to show here";
                                }
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--Partners-->
                    <div id="partners" class="partners">
                        <div class="content">
                            <h1>Our Partners</h1>
                            <div class="partnerbox">
                                <div class="box">
                                    <img src="/pageclasses/assets/images/about/amg.png" alt="partner">
                                </div>
                                <div class="box">
                                    <img src="/pageclasses/assets/images/about/alpine.png" alt="partner">
                                </div>
                                <div class="box">
                                    <img src="/pageclasses/assets/images/about/redbull.png" alt="partner">
                                </div>
                                <div class="box">
                                    <img src="/pageclasses/assets/images/about/f1.png" alt="partner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}
?>