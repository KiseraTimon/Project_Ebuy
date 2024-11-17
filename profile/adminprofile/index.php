<?php
//Start Session
//session_start();

/*if (!isset($_SESSION['accountType']) && $_SESSION['accountType'] != 'admin') {
    echo '<script>
            alert("You are not authorized to view this page.");
            window.location.href = "/index.php";
            </script>';
    exit();
}*/

//Database Connection
require_once '../../components/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Car Depot</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../defaults.css">
    <link rel="stylesheet" href="../clientprofile/css/style.css">
    
</head>
<body>
  <div class="container">
    <!--Sidepanel-->
    <aside>
        <div class="top">
          <div class="logo">
            <h2>Hello, Admin <span class="danger"></span> </h2>
          </div>
          <div class="close" id="close_btn">
          <span class="material-symbols-sharp">
            close
            </span>
          </div>
        </div>
        <!-- end top -->
        <div class="sidebar">

          <a href="#" onclick="showTab('dashboard')">
            <span class="material-symbols-sharp">grid_view </span>
            <h3>Dashboard</h3>
          </a>
          <a href="divisions/userreport.php" onclick="showTab('users')">
            <span class="material-symbols-sharp">person_outline </span>
            <h3>View users</h3>
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">insights </span>
            <h3>Analytics</h3>
          </a> -->
          
          
          <!-- <a href="#">
            <span class="material-symbols-sharp">mail_outline </span>
            <h3>Inquiries</h3>
            <span class="msg_count">14</span>
          </a> -->
          <a href="divisions/allreports.php" onclick="showTab('reports')">
            <span class="material-symbols-sharp">report_gmailerrorred </span>
            <h3>Reports</h3>
          </a>
          <a href="divisions/settings.php" onclick="showTab('settings')">
            <span class="material-symbols-sharp">settings </span>
            <h3>settings</h3>
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">add </span>
            <h3>Add Product</h3>
          </a> -->
          <a href="/index.php">
            <span class="material-symbols-sharp">home </span>
            <h3>Home</h3>
          </a>
          <a href="/formclasses/assets/php/logout.php">
            <span class="material-symbols-sharp">logout </span>
            <h3>logout</h3>
          </a>
        </div>
    </aside>

    <!--Topbar for shrinked screens-->
    <div class="topbar">
      <div class="quicklinks">
          <a href="/index.php">
            <span class="material-symbols-sharp">home</span>
            <!-- <h3>Dashboard</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('dashboard')">
            <span class="material-symbols-sharp">grid_view </span>
            <!-- <h3>Dashboard</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('users')">
            <span class="material-symbols-sharp">person_outline </span>
            <!-- <h3>View users</h3> -->
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">insights </span>
            <h3>Analytics</h3>
          </a> -->
          <a href="javascript:void(0);" onclick="showTab('vehicles')">
            <span class="material-symbols-sharp">car_tag</span>
            <!-- <h3>Add Vehicle</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('inventory')">
            <span class="material-symbols-sharp">garage</span>
            <!-- <h3>Inventory</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('inventory')">
            <span class="material-symbols-sharp">event</span>
            <!-- <h3>Inventory</h3> -->
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">mail_outline </span>
            <h3>Inquiries</h3>
            <span class="msg_count">14</span>
          </a> -->
          <a href="javascript:void(0);" onclick="showTab('reports')">
            <span class="material-symbols-sharp">report_gmailerrorred </span>
            <!-- <h3>Reports</h3> -->
          </a>
          <a href="javascript:void(0);" onclick="showTab('settings')">
            <span class="material-symbols-sharp">settings </span>
            <!-- <h3>settings</h3> -->
          </a>
          <!-- <a href="#">
            <span class="material-symbols-sharp">add </span>
            <h3>Add Product</h3>
          </a> -->
          <a href="/forms/logout.php">
            <span class="material-symbols-sharp">logout </span>
            <!-- <h3>logout</h3> -->
          </a>
      </div>
    </div>


    <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
          <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
          <p class="mb-4">
            Check the sales, value and bounce rate by country.
          </p>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                  <h4 class="mb-0">5300</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+% </span>than last week</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                  <h4 class="mb-0">5</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+0% </span>than last month</p>
            </div>
          </div>
        </div>
        <!--
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Ads Views</p>
                  <h4 class="mb-0">3,462</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
            </div>
          </div>
        </div>-->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Sales</p>
                  <h4 class="mb-0">0.00</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+% </span>than yesterday</p>
            </div>
          </div>
        </div>
      </div>
    
    
    

<!--Scripts-->
<script src="script.js"></script>

</body>
</html>