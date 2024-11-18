<?php

//Fetching classes
require ('formclasses/auth.php');
require ('home.php');
require ('pageclasses/about.php');
require ('pageclasses/sell.php');
require ('pageclasses/buy.php');
require ('components/header.php');
require ('components/footer.php');
require ('components/ratings.php');


//Header object
$header = new header();

//Footer object
$footer = new footer();

//Homepage object
$home = new homepage();

//About object
$about = new aboutpage();

//Sell object
$sell = new sellpage();

//Buy object
$buy = new buypage();

//Auth object
$auth = new auth();

//Ratings object
$ratings = new ratings();