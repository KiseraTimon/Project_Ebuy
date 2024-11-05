<?php


class buypage
{
    function buyhead()
    {
        ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Product Catalogue | Ebuy</title>
                <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
                rel="stylesheet"
                />
                <link rel="stylesheet" href="/pageclasses/assets/css/buy.css" />
                <link rel="stylesheet" href="/styles.css" />
                <link rel="stylesheet" href="/defaults.css" />
                <!-- font awesome -->
                <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
            </head>
            <body>
        <?php
    }

    function buy()
    {
        ?>
            <div class = "products">
                <div class = "container">
                    <h1 class = "lg-title">The Ebuy Collection</h1>
                    <p class = "text-light">Grab your favourite products with us and experience a convenient shopping experience</p>

                    <div class="searching">
                        <?php include '../components/search.php';?>
                    </div>

                    <!--Custom card-->
                    <?php require '../components/database.php'?>
                    <?php include '../components/cards.php'?>
                </div>
            </div>

            <!--script to navigate images-->
            <script src="/pageclasses/assets/js/product.js"></script>
        <?php
    }
}
?>