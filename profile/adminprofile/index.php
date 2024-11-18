<?php
//Database connection
require ('../../components/database.php');
require_once('../../loader.php');

//Sessions
session_start();

//Verify identity
if (!isset($_SESSION['accountType']) || $_SESSION['accountType'] !== 'admin') {
    echo '<script>
    alert("You are not authorized to access this page");
    window.location.href = "/pages/login.php";
    </script>';
    exit();
}

//Fetch user data
if(isset($_SESSION['userID']))
{
    $userID = $_SESSION['userID'];
    $sql = "SELECT * FROM users WHERE userID = '$userID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $profilepic = $row['profilePic'];
    $fname = $row['fName'];
    $lname = $row['lName'];
    $uname = $row['uname'];
    $email = $row['email'];
    $password = $row['passw'];
	$contact = $row['contactphone'];

    // BLOB conversion
    $profilepic = base64_encode($profilepic);
    $profilepic = 'data:image/jpeg;base64,'.$profilepic;
}
else
{
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
	<!-- My CSS -->
	<link rel="stylesheet" href="/profile/adminprofile/assets/css/style.css">
	<link rel="stylesheet" href="/style.css">
	<link rel="stylesheet" href="/defaults.css">

	<title>Admin Portal</title>
</head>
<body>


	<!--Sidebar-->
	<section id="sidebar">
		<a href="#" class="brand">
			<span class="text">Ebuy</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Product Listings</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Businesses</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Testimonials</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/formclasses/assets/php/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!--Sidebar-->



	<!--Content-->
	<section id="content">
		<!--Navbar-->
		<nav>
			<!--Sidebar toggle-->
			<i class='bx bx-menu' ></i>

			<!--Search Box-->
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>

			<!--Dark/Light mode-->
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>

			<!--Welcome Text-->
			<p>Hello, <?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></p>
			<a href="#" class="profile">
			<img src="<?php echo $profilepic;?>" alt="<?php echo $fname.' '.$lname?>">
			</a>
		</nav>
		<!--Navbar-->

		<!--Dashboard Page-->
		<main id="dashboardpage">
			<!--Title-->
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a> -->
			</div>

			<!--Cards-->
			<ul class="box-info">
				<!--Orders Card-->
				<li>
					<?php
					$sql = "SELECT COUNT(*) AS total FROM orders";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$totalorders = $row['total'];

					if($totalorders == NULL)
					{
						$totalorders = 0;
					}
					?>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $totalorders?></h3>
						<p>Orders</p>
					</span>
				</li>

				<!--Businesses Card-->
				<li>
					<?php
					$sql = "SELECT COUNT(*) AS total FROM businesses";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$totalbusinesses = $row['total'];

					if($totalbusinesses == NULL)
					{
						$totalbusinesses = 0;
					}
					?>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $totalbusinesses?></h3>
						<p>Active Businesses</p>
					</span>
				</li>

				<!--Transactions Card-->
				<li>
					<?php
					//Sum content of Amount column in mpesa table
					$sql = "SELECT SUM(Amount) AS total FROM mpesa";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$totaltransactions = $row['total'];

					if($totaltransactions == NULL)
					{
						$totaltransactions = 0;
					}
					?>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo $totaltransactions?><sup style="font-family: 'Poppins', sans-serif">KES</sup></h3>
						<p>Total Transactions</p>
					</span>
				</li>
			</ul>
			
			<!--Top Businesses-->
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Top Businesses</h3>
						<!-- <i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i> -->
					</div>
					<table>
						<thead>
							<tr>
								<th>Business</th>
								<th>CEO</th>
								<th>Order Value</th>
							</tr>
						</thead>
						<tbody>
							<!--Fetch top businesses by order value from order table-->
							<?php
							$sql = "SELECT businesses.bname, businesses.fname, businesses.lname, SUM(orders.totalPrice) AS totalPrice FROM businesses INNER JOIN orders ON businesses.userID = orders.sellerUID GROUP BY businesses.bname ORDER BY totalPrice DESC LIMIT 5";

							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_assoc($result))
								{
									$businessname = $row['bname'];
									$ceofname = $row['fname'];
									$ceolname = $row['lname'];
									$ordervalue = $row['totalPrice'];
									?>
									<tr>
										<td><?php echo $businessname?></td>
										<td><?php echo $ceofname.' '.$ceolname?></td>
										<td><?php echo $ordervalue?></td>
									</tr>
									<?php
								}
							}
							?>

							<!-- <tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status process">Process</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr> -->
						</tbody>
					</table>
				</div>

				<!--Todo list-->
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>

		<!--Product Listings-->
		<main id="productlistings" hidden>
			<div class="head-title">
				<div class="left">
					<h1>Product Listings</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Product Listings</a>
						</li>
					</ul>
				</div>
			</div>

			<!--Product Listings-->
			<table class="listingtable">
				<!--Table Head-->
				<thead>
					<tr>
						<th>Product</th>
						<th>Category</th>
						<th>Subcategory</th>
						<th>Price</th>
						<th>Business</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$sqlProducts = "SELECT * FROM products";
					$resultProducts = mysqli_query($conn, $sqlProducts);

					if (mysqli_num_rows($resultProducts) > 0) {
						while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
							$productID = $rowProduct['productID'];
							$product = $rowProduct['productName'];
							$categoryID = $rowProduct['category'];
							$subcategory = $rowProduct['subcategory'];
							$price = $rowProduct['price'];
							$ownerID = $rowProduct['userID'];

							//Number formatting
							$price = number_format($price);

							// Fetch category name
							$sqlCategory = "SELECT category FROM categories WHERE categoryID = '$categoryID'";
							$resultCategory = mysqli_query($conn, $sqlCategory);
							$rowCategory = mysqli_fetch_assoc($resultCategory);
							$categoryName = $rowCategory['category'];

							// Fetch business name
							$sqlBusiness = "SELECT bname FROM businesses WHERE userID = '$ownerID'";
							$resultBusiness = mysqli_query($conn, $sqlBusiness);
							$rowBusiness = mysqli_fetch_assoc($resultBusiness);
							$businessName = $rowBusiness['bname'];
							?>
							<tr>
								<td><?php echo $product; ?></td>
								<td><?php echo $categoryName; ?></td>
								<td><?php echo $subcategory; ?></td>
								<td><?php echo $price; ?><sup>KES</sup></td>
								<td><?php echo $businessName; ?></td>
								<td><a href="/pages/viewer.php?productID=<?php echo $productID?>">View</a></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</main>

		<!--Businesses-->
		<main id="businesses" hidden>
			<div class="head-title">
				<div class="left">
					<h1>Registered Businesses</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Businesses</a>
						</li>
					</ul>
				</div>
				<!-- <a href="#" class="btn-download">
						<i class='bx bxs-cloud-download' ></i>
						<span class="text">Download PDF</span>
					</a> -->
			</div>

			<!--Businesses-->
			<table class="listingtable">
				<!--Table Head-->
				<thead>
					<tr>
						<th>Business</th>
						<th>CEO</th>
						<th>Email</th>
						<th>Contact</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sqlBusinesses = "SELECT * FROM businesses";
					$resultBusinesses = mysqli_query($conn, $sqlBusinesses);

					if (mysqli_num_rows($resultBusinesses) > 0) {
						while ($rowBusiness = mysqli_fetch_assoc($resultBusinesses)) {
							$businessID = $rowBusiness['bID'];
							$businessName = $rowBusiness['bname'];
							$ceoFname = $rowBusiness['fname'];
							$ceoLname = $rowBusiness['lname'];
							$email = $rowBusiness['bemail'];
							$contact = $rowBusiness['bcontact'];
							?>
							<tr>
								<td><?php echo $businessName; ?></td>
								<td><?php echo $ceoFname . ' ' . $ceoLname; ?></td>
								<td><?php echo $email; ?></td>
								<td><?php echo $contact; ?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</main>

		<!--Testimonials-->
		<main id="testimonials" hidden>
			<div class="head-title">
				<div class="left">
					<h1>Testimonials</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Testimonials</a>
						</li>
					</ul>
				</div>

				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a> -->
			</div>

			<!--Testimonials-->
			<table class="listingtable">
				<!--Table Head-->
				<thead>
					<tr>
						<th>Customer</th>
						<th>Rating</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$sqlTestimonials = "SELECT * FROM testimonials";
					$resultTestimonials = mysqli_query($conn, $sqlTestimonials);

					if (mysqli_num_rows($resultTestimonials) > 0) {
						while ($rowTestimonial = mysqli_fetch_assoc($resultTestimonials)) {
							$testimonialID = $rowTestimonial['testID'];
							$dispname = $rowTestimonial['dispname'];
							$rating = $rowTestimonial['testreview'];
							$date = $rowTestimonial['date'];
							$customerID = $rowTestimonial['userID'];

							// Fetch customer name
							$sqlCustomer = "SELECT fName, lName FROM users WHERE userID = '$customerID'";
							$resultCustomer = mysqli_query($conn, $sqlCustomer);
							$rowCustomer = mysqli_fetch_assoc($resultCustomer);
							$customerName = $rowCustomer['fName'] . ' ' . $rowCustomer['lName'];
							
							//Rating stars
							require_once ('../../components/ratings.php');
							$value = $ratings->displayStars($rating);
							?>
							<tr>
								<td><?php echo $customerName; ?></td>
								<td><?php echo $value;?></td>
								<td><?php echo $date; ?></td>
							</tr>
							<?php
							}
					}
					?>
				</tbody>
			</table>
		</main>

		<!--Settings-->
		<main id="settings" hidden>
			<div class="head-title">
				<div class="left">
					<h1>Settings</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Settings</a>
						</li>
					</ul>
				</div>
			</div>

			<!--Settings-->
			<div class="settings">
				<img
				src="<?php
				//Display image
				echo $profilepic;
				?>">
			</div>

			<div class="account">
				<div class="accnote">
				<h1>Account Information</h1>
				</div>
				<div class="acctext">
					<form action="/formclasses/assets/php/updator.php" method="POST" enctype="multipart/form-data">
					<!--fname-->
					<label for="fname">First Name</label>
					<input type="text" name="fname" value="<?php echo $fname?>"><br>

					<!--lname-->
					<label for="lname">Last Name</label>
					<input type="text" name="lname" value="<?php echo $lname?>"><br>

					<!--uname-->
					<label for="uname">Username</label>
					<input type="text" name="uname" value="<?php echo $uname?>"><br>

					<!--email-->
					<label for="email">Email</label>
					<input type="email" name="email" value="<?php echo $email?>"><br>

					<!--contact-->
					<label for="contact">Contact</label>
					<input type="text" name="contact" value="<?php echo $contact?>"><br>

					<!--Current password-->
					<input type="hidden" name="currentpassword" value="<?php echo $password?>" readonly>

					<!--New password-->
					<label for="password">New Password</label>
					<input type="password" name="password"><br>

					<!--Confirm password-->
					<label for="confirmpassword">Confirm Password</label>
					<input type="password" name="confirmpassword"><br>`

					<!--profilepic-->
					<label for="profilepic">Profile Picture</label>
					<input type="file" name="profilepic"><br>

					<!--Submit-->
					<input type="submit" name="update" value="update">
					</form>
				</div>
			</div>
		</main>

		<!--Main-->
	</section>
	<!--Content-->

	<!--PHP Functions-->
	<?php
	
	function displayStars($rating)
    {
        $stars = '';

        //half star if rating is < 15
        //1 star if rating is < 25
        //1.5 stars if rating is < 35
        //2 stars if rating is < 45
        //2.5 stars if rating is < 55
        //3 stars if rating is < 65
        //3.5 stars if rating is < 75
        //4 stars if rating is < 85
        //4.5 stars if rating is < 95
        //5 stars if rating is > 95

        if ($rating < 15) {
            $stars = '<i class="ri-star-half-line"></i>';
        } elseif ($rating < 25) {
            $stars = '<i class="ri-star-fill"></i>';
        } elseif ($rating < 35) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } elseif ($rating < 45) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        } elseif ($rating < 55) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } elseif ($rating < 65) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        } elseif ($rating < 75) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } elseif ($rating < 85) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        } elseif ($rating < 95) {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-line"></i>';
        } else {
            $stars = '<i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>';
        }

        return $stars;
    }
	?>

	<script src="/profile/adminprofile/assets/js/script.js"></script>
</body>
</html>