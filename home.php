<?php

class homepage
{
    function homehead()
    {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Car Depot</title>
                
                <!--Remix icons-->
                <link
                href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
                rel="stylesheet"
                />
                
                <!--Fontawesome icons-->
                <link
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
                rel="stylesheet"
                />
                
                <!--U icons-->
                <link href="/your-path-to-uicons/css/uicons-[your-style].css" rel="stylesheet">
                
                <!--General styles-->
                <link rel="stylesheet" href="styles.css" />
                <link rel="stylesheet" href="defaults.css" />
                <!-- <link rel="stylesheet" href="/productpages/main.css" /> -->
            </head>
            <body>
        <?php
    }

    function header()
    {
        ?>
            <!--Header-->
            <header>
            <!--Loading the navbar-->
            <?php
            require_once ('components/header.php');
            $header = new header();
            $header->navigation();
            ?>

            <div class="section__container header__container" id="home">
                <div class="header__image">
                    <img src="assets/header3.png" alt="header" />
                </div>
                <div class="header__content">
                    <h1><?php if(isset($_SESSION['uname'])){echo 'Hello, '.$_SESSION['uname'].'. ';}?>Get your new car with us today</h1>
                    <p>
                        We offer a wide variety of vehicles to suit your taste, budget and style.
                    </p>
                    <div class="header__links">
                        <?php include 'components/search.php'?>
                        <!-- <a href="#">
                        <img src="assets/store.jpg" alt="app store" />
                        </a>
                        <a href="#">
                        <img src="assets/play.png" alt="play" />
                        </a> -->
                    </div>
                </div>
            </div>
            </header>
        <?php
    }

    function steps()
    {
        ?>
            <section class="section__container steps__container" id="rent">
                <p class="section__subheader">ONLINE PURCHASE PROCESS</p>
                <h2 class="section__header">Car Depot has a simple 3 step process</h2>
                <div class="steps__grid">
                    <div class="steps__card" onclick="window.location.href='/productpages/index.php'">
                        <span>
                            <i class="ri-search-eye-fill"></i>
                        </span>
                        <p class="title">Select your desired vehicle</p>
                        <p>
                        From our diverse range , select the car that appeals to you the most
                        </p>
                    </div>
                    <div class="steps__card" onclick="window.location.href='/productpages/index.php'">
                        <span>
                            <i class="ri-customer-service-fill"></i>
                        </span>
                        <p class="title">Make an inquiry</p>
                        <p>
                            Fill in the inquiry form and we will get back to you for formal planning and verification
                        </p>
                    </div>
                    <div class="steps__card" onclick="window.location.href='/productpages/index.php'">
                        <span>
                            <i class="ri-key-2-fill"></i>
                        </span>
                        <p class="title">Buy and get your car</p>
                        <p>
                            Pay for your vehicle through our online invoicing system and get your car delivered to you within the stipulated time
                        </p>
                    </div>
                </div>
            </section>
        <?php
    }

    function service()
    {
        ?>
            <section class="section__container service__container" id="service">
                <div class="service__image">
                    <img src="assets/tyres.png" alt="service" />
                </div>
                <div class="service__content">
                    <p class="section__subheader">BEST SERVICES</p>
                    <h2 class="section__header">
                    We're more than just a car dealership
                    </h2>
                    <ul class="service__list">
                    <li>
                        <span><i class="ri-ship-2-fill"></i></span>
                        <div>
                        <h4>Imports & Exports</h4>
                        <p>
                            We import and export vehicles to and from different countries to give you a wide range of options to choose from, as well as to fetch you a global market
                        </p>
                        </div>
                    </li>
                    <li>
                        <span><i class="ri-calendar-event-fill"></i></span>
                        <div>
                        <h4>Events</h4>
                        <p>
                            We host events and car shows to showcase our latest collections and to give you a chance to interact with our team and other car enthusiasts.
                        </p>
                        </div>
                    </li>
                    <li>
                        <span><i class="ri-home-gear-fill"></i></span>
                        <div>
                        <h4>Performance Lab</h4>
                        <p>
                            We have an in-house performance-oriented lab for tuning and configuring your vehicles for the best possible performance stats
                        </p>
                        </div>
                    </li>
                    </ul>
                </div>
        </section>
        <?php
    }

    function experience()
    {
        ?>
            <section class="section__container experience__container" id="ride">
                <p class="section__subheader">CUSTOMER EXPERIENCE</p>
                <h2 class="section__header">
                    We are ensuring the best customer experience
                </h2>
                <div class="experience__content">
                    <div class="experience__card">
                    <span><i class="ri-price-tag-fill"></i></span>
                    <h4>Competitive Pricing</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-team-fill"></i></span>
                    <h4>We fit everyone</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-bank-card-fill"></i></span>
                    <h4>Flexible Payment</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-award-fill"></i></span>
                    <h4>Car Depot Warranty</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-service-fill"></i></span>
                    <h4>On-sale Services</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-car-fill"></i></span>
                    <h4>Diverse Motor Range</h4>
                    </div>
                    <img src="assets/experience.png" alt="experience" />
                </div>
            </section>
        <?php
    }

    function download()
    {
        ?>
            <section class="section__container download__container" id="contact">
            <p class="section__subheader">COLLECTIONS</p>
            <h2 class="section__header">
                Our special collections for you
            </h2>
            <div class="collections  download__content">
                <div class="collectionspanel">

                <!--Exotics-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/track.png" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Exotics</h3>
                    <p>Rare high performance luxury cars for your track days</p>
                    <a href="/pages/stock.php?collection=Exotics">View Collection</a>
                    </div>
                </div>

                <!--City cars-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/city.png" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>City Cars</h3>
                    <p>Small, compact and efficient cars for city driving and parking</p>
                    <a href="/pages/stock.php?collection=City Cars">View Collection</a>
                    </div>
                </div>

                <!--Classics-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/classics.png" />
                    </div>
                    <div class="collection__content">
                    <h3>Classics</h3>
                    <p>Old school vehicles that never go out of that liberal style</p>
                    <a href="/pages/stock.php?collection=Classics">View Collection</a>
                    </div>
                </div>

                <!--Trucks-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/trucks.png" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Trucks</h3>
                    <p>Heavy duty trucks for all your hauling needs</p>
                    <a href="/pages/stock.php?collection=Trucks">View Collection</a>
                    </div>
                </div>

                <!--European premiums-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/cover/audis4_cover.jpg" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>European Premiums</h3>
                    <p>
                        High end luxury vehicles from the European market
                    </p>
                    <a href="/pages/stock.php?collection=European Premiums">View Collection</a>
                    </div>
                </div>

                <!--Asian premiums-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/cover/cx5.png" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Asian Premiums</h3>
                    <p>
                        Modern and efficient vehicles from the Asian market
                    </p>
                    <a href="/pages/stock.php?collection=Asian Premiums">View Collection</a>
                    <!-- <a href="/pages/stock.php?collection='Asian Premiums'">View Collection</a>
                    </div> -->
                </div>
                </div>
            </div>
            </section>
        <?php
    }
}
?>