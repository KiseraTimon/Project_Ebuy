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
                    <img src="assets/header.png" alt="header" />
                </div>
                <div class="header__content">
                    <h1><?php if(isset($_SESSION['uname'])){echo 'Hello, '.$_SESSION['uname'].'. ';}?>Discover amazing products on Ebuy</h1>
                    <p>
                        Explore our wide range of items to suit your needs, taste, pocket and preferences
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
                <h2 class="section__header">Ebuy has a simple 3 step process</h2>
                <div class="steps__grid">
                    <div class="steps__card" onclick="window.location.href='/productpages/index.php'">
                        <span>
                            <i class="ri-search-eye-fill"></i>
                        </span>
                        <p class="title">Find your perfect</p>
                        <p>
                        Browse through our wide range of products and select the one that just does it
                        </p>
                    </div>
                    <div class="steps__card" onclick="window.location.href='/productpages/index.php'">
                        <span>
                            <i class="ri-customer-service-fill"></i>
                        </span>
                        <p class="title">Contact the seller</p>
                        <p>
                            Interact directly with the seller through our curated messaging system to get more details about the product
                        </p>
                    </div>
                    <div class="steps__card" onclick="window.location.href='/productpages/index.php'">
                        <span>
                            <i class="ri-key-2-fill"></i>
                        </span>
                        <p class="title">Pay & Collect</p>
                        <p>
                            Pay for the product and collect it from the seller or have it delivered to your doorstep
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
                    We're more than just an online market
                    </h2>
                    <ul class="service__list">
                    <li>
                        <span><i class="ri-ship-2-fill"></i></span>
                        <div>
                        <h4>Import Services</h4>
                        <p>
                            We have a wide network of suppliers and can help you import any product from any part of the world
                        </p>
                        </div>
                    </li>
                    <li>
                        <span><i class="ri-calendar-event-fill"></i></span>
                        <div>
                        <h4>Seasonal promotions</h4>
                        <p>
                            Enjoy exclusive deals and discounts on your favorite products during special seasons and give-aways
                        </p>
                        </div>
                    </li>
                    <li>
                        <span><i class="ri-home-gear-fill"></i></span>
                        <div>
                        <h4>Business support</h4>
                        <p>
                            This platform is designed to help you grow your business and reach a wider market, as well as an opportunity to network with other sellers
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
                    <h4>We Fit Everyone</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-bank-card-fill"></i></span>
                    <h4>Flexible Payment</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-award-fill"></i></span>
                    <h4>Scam-safe</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-service-fill"></i></span>
                    <h4>24/7 Support</h4>
                    </div>
                    <div class="experience__card">
                    <span><i class="ri-car-fill"></i></span>
                    <h4>Product Diversity</h4>
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
                Explore our curated collections
            </h2>
            <div class="collections  download__content">
                <div class="collectionspanel">

                <!--Electronics-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/electronics.jpg" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Electronics</h3>
                    <p>
                        The latest and rarest electronic devices and equipment
                    </p>
                    <a href="/pages/stock.php?collection=Exotics">View Collection</a>
                    </div>
                </div>
                
                <!--Clothing & Fashion-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/fashion.jpg" />
                    </div>
                    <div class="collection__content">
                    <h3>Clothing & fashion</h3>
                    <p>
                        Timeless and elegant clothing and fashion accessories
                    </p>
                    <a href="/pages/stock.php?collection=Classics">View Collection</a>
                    </div>
                </div>

                <!--Makeup & Beauty-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/makeup.jpg" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Makeup & Beauty</h3>
                    <p>
                        The best beauty products to keep you looking fresh and young
                    </p>
                    <a href="/pages/stock.php?collection=Asian Premiums">View Collection</a>
                    </div>
                </div>

                <!--Farming, Home & Garden-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/farming.jpg" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Farm, Home & Garden</h3>
                    <p>
                        Everything you need to keep your backyard in top shape
                    </p>
                    <a href="/pages/stock.php?collection=City Cars">View Collection</a>
                    </div>
                </div>


                <!--Sports & Outdoor-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/sports.jpg" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Sports & Outdoor</h3>
                    <p>
                        Get the best gear for your outdoor adventures and games
                    </p>
                    <a href="/pages/stock.php?collection=Trucks">View Collection</a>
                    </div>
                </div>

                <!--Gaming-->
                <div class="collectioncard">
                    <div class="collimg">
                    <img src="/assets/games.jpg" alt="collection" />
                    </div>
                    <div class="collection__content">
                    <h3>Gaming</h3>
                    <p>
                        All kinds of games to keep you entertained
                    </p>
                    <a href="/pages/stock.php?collection=European Premiums">View Collection</a>
                    </div>
                </div>
            </div>
            </section>
        <?php
    }
}
?>