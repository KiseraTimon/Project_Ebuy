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
                <title>About | Car Depot</title>
                <!--External CSSs-->
                <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
                rel="stylesheet"
                />
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
        ?>
            <div class="container">
                <div class="context">
                    <!--Introduction-->
                    <div id="intro" class="intro">
                        <h1>We are Car Depot</h1>
                        <p>Car Depot is a car dealership company that has been in the business for over 20 years. We have a wide range of cars that cater to all your needs. We have a team of experts who will help you find the perfect car for you. We also provide car servicing and maintenance services. Our goal is to provide our customers with the best car buying experience
                        </p>
                        <p><button onclick="window.location.href='/pages/signup.php'">Join Us</button></p>
                    </div>
            
                    <!--Numbers-->
                    <div id="numbers" class="numbers">
                        <div class="box">
                            <i class="ri-car-washing-line"></i>
                            <h2>1000+</h2>
                            <p>Vehicles in Stock</p>
                        </div>
                        <div class="box">
                            <i class="ri-group-3-line"></i>
                            <h2>500+</h2>
                            <p>Satisfied Customers</p>
                        </div>
                        <div class="box">
                            <i class="ri-map-line"></i>
                            <h2>10+</h2>
                            <p>Dealer locations</p>
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
                                    Our team of experts is here to help you find the perfect car for you. We have a team of experienced professionals who will guide you through the car buying process. We have a wide range of cars that cater to all your needs. Our goal is to provide our customers with the best car buying experience.
                                </p>
                                <p><button>Our Team</button></p>
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
                                    <h2>Quality Cars</h2>
                                    <p>We have a wide range of cars that cater to all your needs. We have a team of experts who will help you find the perfect car for you.</p>
                                </div>
                                <div class="box">
                                    <i class="ri-money-dollar-circle-line"></i>
                                    <h2>Best Prices</h2>
                                    <p>We offer the best prices on all our cars. We have a team of experts who will help you find the perfect car for you.</p>
                                </div>
                                <div class="box">
                                    <i class="ri-tools-line"></i>
                                    <h2>Car Servicing</h2>
                                    <p>We provide car servicing and maintenance services. We have a team of experts who will help you find the perfect car for you.</p>
                                </div>
                            </div>
                            <div class="description">
                                <p>
                                    Our goal is to provide our customers with the best car buying experience. We have a team of experts who will help you find the perfect car for you. We have a wide range of cars that cater to all your needs. We also provide car servicing and maintenance services.
                                </p>
                            </div>
                        </div>
                    </div>
            
                    <!--Story-->
                    <div id="story" class="story">
                        <div class="content">
                            <div class="contentimage">
                                <img src="/pageclasses/assets/images/about/story.png" alt="story">
                            </div>
                            <h1>Our Story</h1>
                            <p>
                                Car Depot is a car dealership company that has been in the business for over 20 years. We have a wide range of cars that cater to all your needs. We have a team of experts who will help you find the perfect car for you. We also provide car servicing and maintenance services. Our goal is to provide our customers with the best car buying experience.
                                <br>
                                As the car dealership industry has evolved, we have adapted to the changing times. We have embraced new technologies and trends to provide our customers with the best car buying experience. We have a team of experts who will help you find the perfect car for you. We have a wide range of cars that cater to all your needs. We also provide car servicing and maintenance services.
                                <br>
                                Our story begins from 1999 when we started our journey in the car dealership industry. We have come a long way since then and have established ourselves as a trusted name in the industry. We have a team of experts who will help you find the perfect car for you. We have a wide range of cars that cater to all your needs. We also provide car servicing and maintenance services.
                            </p>
                        </div>
                    </div>

                    <!--Services-->
                    <div id="services" class="services">
                        <div class="content">
                            <h1>Our Services</h1>
                            <div class="servicebox">
                                <div class="box">
                                    <i class="ri-car-washing-fill"></i>
                                    <h2>Car Wash</h2>
                                    <p>We offer car wash services to keep your car clean and shiny. We have a team of experts who will help you find the perfect car for you.</p>
                                </div>
                                <div class="box">
                                    <i class="ri-tools-line"></i>
                                    <h2>Car Servicing</h2>
                                    <p>We provide car servicing and maintenance services. We have a team of experts who will help you find the perfect car for you.</p>
                                </div>
                                <div class="box">
                                    <i class="ri-car-washing-line"></i>
                                    <h2>Car Detailing</h2>
                                    <p>We offer car detailing services to keep your car looking brand new. We have a team of experts who will help you find the perfect car for you.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Work with us-->
                    <div id="work" class="work">
                        <div class="content">
                            <h1>Work with Us</h1>
                            <p>
                                We are always looking for talented individuals to join our team. If you are passionate about cars and have a desire to work in the car dealership industry, then we want to hear from you. We offer competitive salaries and benefits to all our employees. We have a team of experts who will help you find the perfect car for you. We have a wide range of cars that cater to all your needs. We also provide car servicing and maintenance services.
                            </p>
                            <p><button>Join Us</button></p>
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

                                //Ratings function
                                require_once '../components/ratings.php';
                                $ratings = new ratings();

                                //Populating variables
                                $sql = "SELECT * FROM testimonials";
                                $result = $conn->query($sql);

                                //Populating Testimonials
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="testimonialcard">
                                        <div class="testname">
                                            <h2><?php echo $row['dispname'];?></h2>
                                        </div>
                                        <div class="testcontent">
                                            <p><?php echo $row['tests'];?></p>
                                        </div>
                                        <div class="testrating">
                                            <span>
                                                
                                                <?php
                                                $rating = $row['testreview'];

                                                echo $ratings->displayStars($rating);
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