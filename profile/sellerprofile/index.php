<?php
//Database connection
require ('../../components/database.php');
require_once('../../loader.php');

//Fetch categories
// Query to get all categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Query to get all subcategories and organize them by categoryID
$subcategoryQuery = "SELECT * FROM subcategories";
$subcategoryResult = mysqli_query($conn, $subcategoryQuery);

$subcategoriesByCategory = [];
while ($row = mysqli_fetch_assoc($subcategoryResult)) {
    $subcategoriesByCategory[$row['categoryID']][] = $row['subcat'];
}

// Initialize selected category and subcategories
$selectedCategory = '';
$selectedSubcategories = [];

session_start();

if (!isset($_SESSION['accountType']) || $_SESSION['accountType'] !== 'seller') {
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
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<title>Business Portal</title>
	<link rel="stylesheet" href="/profile/sellerprofile/assets/css/sellerstyle.css">
	<link rel="stylesheet" href="/style.css">
	<link rel="stylesheet" href="/defaults.css">
</head>
<body>
	
	<!--Sidebar-->
	<section id="sidebar">
		<!--Logo-->
		<a href="#" class="brand"><!--<i class='bx bxs-smile icon'>--></i>Ebuy</a>
		<ul class="side-menu">

			<!--Dashboard-->
			<li><a href="#" id="dashboard-tab" data-target="dashboardpage" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>

			<!--Catalogue-->
			<li class="divider" data-text="Catalogue">Catalogue</li>
			<!-- <li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> Products <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
				</ul>
			</li> -->
			<li><a href="#" id="addproduct-tab" data-target="addprodspage"><i class='bx bxs-inbox icon' ></i>Add product</a></li>
			<li><a href="#" id="prodlist-tab" data-target="prodlistpage"><i class='bx bxs-cart icon' ></i>Product Listings</a></li>
			<li><a href="#" id="orders-tab" data-target="orderspage"><i class='bx bxs-chart icon' ></i> Orders</a></li>

			<!--Account-->
			<li class="divider" data-text="Account">Account</li>
			<li><a href="#" id="editprofile-tab" data-target="editprofilepage"><i class='bx bx-cog icon' ></i> Edit profile</a></li>
		</ul>

		<!--Buttons-->
		<div class="ads">
			<div class="wrapper">
				<a href="/index.php" class="btn-upgrade">Home</a>
				<a href="/formclasses/assets/php/logout.php" class="btn-upgrade">Logout</a>
			</div>
		</div>
	</section>
	<!--Sidebar-->

	<!--Content-->
	<section id="content">
		<!--Navbar-->
		<nav>
			<!--Sidebar toggle-->
			<i class='bx bx-menu toggle-sidebar' ></i>

			<!--Search-->
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>

			<!--Welcome-->
			<p>Welcome, <?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></p>

			<!--Profile-->
			<span class="divider"></span>
			<div class="profile">
				<img src="<?php echo $profilepic;?>" alt="<?php echo $fname.' '.$lname?>">
				<ul class="profile-link">
					<li><a href="/index.php"><i class='bx bxs-user-circle icon' ></i>Home</a></li>
					<li><a href="#" id="profile-tab" data-target="editprofilepage"><i class='bx bxs-cog' ></i> Profile</a></li>
					<li><a href="/formclasses/assets/php/logout.php"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!--Navbar-->

		<!--Start of tabs-->
		<!--Dashboard-->
		<main id="dashboardpage">
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>

			<!--Stats Cards-->
			<div class="info-data">

				<!--Product Count-->
				<?php
				$sql = "SELECT COUNT(productID) AS productCount FROM products WHERE userID = '$userID'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$productCount = $row['productCount'];
				?>
				<div class="card">
					<div class="head">
						<div>
							<h2><?php echo $productCount?></h2>
							<p>Products</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="40%"></span>
					<span class="label">40%</span>
				</div>

				<!--Orders-->
				<?php
				$sql = "SELECT COUNT(orderID) AS orderCount FROM orders WHERE sellerUID = '$userID'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$orderCount = $row['orderCount'];

				?>
				<div class="card">
					<div class="head">
						<div>
							<h2><?php echo $orderCount?></h2>
							<p>Orders</p>
						</div>
						<i class='bx bx-trending-down icon down' ></i>
					</div>
					<span class="progress" data-value="60%"></span>
					<span class="label">60%</span>
				</div>

				<!--Catalogue value-->
				<?php
				$sql = "SELECT SUM(price * quantity) AS catalogueValue FROM products WHERE userID = '$userID'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$catalogueValue = $row['catalogueValue'];

				//Number formating
				$catalogueValue = number_format($catalogueValue);
				?>
				<div class="card">
					<div class="head">
						<div>
							<h2><?php echo $catalogueValue?><sup>KES</sup></h2>
							<p>Catalogue value</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="30%"></span>
					<span class="label">30%</span>
				</div>

				<!--Order value-->
				<?php
				$sql = "SELECT SUM(totalPrice) AS orderValue FROM orders WHERE sellerUID = '$userID'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$orderValue = $row['orderValue'];

				//Number formating
				$orderValue = number_format($orderValue);
				?>
				<div class="card">
					<div class="head">
						<div>
							<h2><?php echo $orderValue?><sup>KES</sup></h2>
							<p>Orders value</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					<span class="progress" data-value="80%"></span>
					<span class="label">80%</span>
				</div>
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Sales Report</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="chart">
						<div id="chart"></div>
					</div>
				</div>
				<div class="content-data">
					<div class="head">
						<h3>Chatbox</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="chat-box">
						<p class="day"><span>Today</span></p>
						<div class="msg">
							<img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
							<div class="chat">
								<div class="profile">
									<span class="username">Alan</span>
									<span class="time">18:30</span>
								</div>
								<p>Hello</p>
							</div>
						</div>
						<div class="msg me">
							<div class="chat">
								<div class="profile">
									<span class="time">18:30</span>
								</div>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque voluptatum eos quam dolores eligendi exercitationem animi nobis reprehenderit laborum! Nulla.</p>
							</div>
						</div>
						<div class="msg me">
							<div class="chat">
								<div class="profile">
									<span class="time">18:30</span>
								</div>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, architecto!</p>
							</div>
						</div>
						<div class="msg me">
							<div class="chat">
								<div class="profile">
									<span class="time">18:30</span>
								</div>
								<p>Lorem ipsum, dolor sit amet.</p>
							</div>
						</div>
					</div>
					<form action="#">
						<div class="form-group">
							<input type="text" placeholder="Type...">
							<button type="submit" class="btn-send"><i class='bx bxs-send' ></i></button>
						</div>
					</form>
				</div>
			</div>
		</main>

		<!--Add Products-->
		<main id="addprodspage" hidden>
			<h1>Add a product</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Catalogue</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Add products</a></li>
			</ul>
			
			<div class="add-prod">
				<form class="add-form" action="/profile/sellerprofile/assets/php/addproducts.php" method="POST" enctype="multipart/form-data">

					<!--Product Name-->
					<label for="productName">Product Name:</label>
					<input type="text" id="productName" name="productName" required>

					<!--Product Description-->
					<label for="productDesc">Description:</label>
					<textarea id="productDesc" name="productDesc" required></textarea>

					<!--Quantity-->
					<label for="quantity">Quantity:</label>
					<input type="number" id="quantity" name="quantity" min="1" required>

					<!--Price-->
					<label for="price">Price:</label>
					<input type="number" id="price" name="price" required>

					<!--Price Status-->
					<label for="pricestatus">Price Status:</label>
					<select id="pricestatus" name="pricestatus" required>
						<option value="Negotiable">Negotiable</option>
						<option value="Fixed">Fixed</option>
					</select>

					<!--Category-->
					<label for="category">Category:</label>
					<form method="GET">
						<select id="category" name="category" required>
							<option value="">Select category</option>
							<?php
							while ($row = mysqli_fetch_assoc($categoryResult)) {
								$selected = ($row['categoryID'] == $selectedCategory) ? 'selected' : '';
								echo '<option value="'.$row['categoryID'].'" '.$selected.'>'.$row['category'].'</option>';
							}
							?>
						</select>
    
    
                <label for="subcategory">Subcategory:</label>
                <select id="subcategory" name="subcategory" required>
                    <option value="">Select subcategory</option>

                    <!-- Script to populate subcategories based on selected category -->
                    <script>
                        document.getElementById('category').addEventListener('change', function() {
                            var selectedCategoryID = this.value;
                            var subcategories = <?php echo json_encode($subcategoriesByCategory); ?>;
                            var subcategoryDropdown = document.getElementById('subcategory');
                            subcategoryDropdown.innerHTML = '<option value="">Select subcategory</option>';
                            if (selectedCategoryID in subcategories) {
                                subcategories[selectedCategoryID].forEach(function(subcat) {
                                    var option = document.createElement('option');
                                    option.value = subcat;
                                    option.text = subcat;
                                    subcategoryDropdown.add(option);
                                });
                            }
                        });
                    </script>
				</form>

				<!--Images-->
				<label for="images">Images:</label>
				<input type="file" id="images" name="images[]" multiple required>

				<!--Availability-->
				<label for="availability">Availability:</label>
                <select id="availability" name="availability" required>
                    <option value="Available">Available</option>
                    <option value="Sold">Sold</option>
                    <option value="Reserved">Reserved</option>
                    <option value="Import">Import</option>
                    <option value="Showcase">Showcase</option>
                </select>

				<input type="submit" value="Add Product">
				</form>
			</div>
			
		</main>

		<!--Product Listings-->
		<main id="prodlistpage" hidden>
			<h1>Product Listings</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Catalogue</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Product listings</a></li>
			</ul>

			<div class="prodtable">
				<table>
					<thead>
						<tr>
							<th>Product</th>
							<th>Price</th>
							<th>Fixation</th>
							<th>Quantity</th>
							<th>Category</th>
							<th>Subcategory</th>
							<th>Status</th>
							<th>Update</th>
							<th>View</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = "SELECT * FROM products WHERE userID = '$userID'";
						$result = mysqli_query($conn, $sql);

						if ($result && mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$productID = $row['productID'];
								$name = $row['productName'];
								$price = $row['price'];
								$pricestatus = $row['pricestatus'];
								$quantity = $row['quantity'];
								$category = $row['category'];
								$subcategory = $row['subcategory'];
								$image = $row['images'];

								$catquery = "SELECT category FROM categories WHERE categoryID = '$category'";
								$catresult = mysqli_query($conn, $catquery);
								$catrow = mysqli_fetch_assoc($catresult);
								$category = $catrow['category'];

								//Number formating
								$price = number_format($price);
								$quantity = number_format($quantity);

								// BLOB conversion
								$image = base64_encode($image);
								$image = 'data:image/jpeg;base64,'.$image;

								?>
									<tr>
										<td><?php echo $name?></td>
										<td><?php echo $price?></td>
										<td><?php echo $pricestatus?></td>
										<td><?php echo $quantity?></td>
										<td><?php echo $category?></td>
										<td><?php echo $subcategory?></td>
										<td><a href="/pages/viewer.php?productID=<?php echo $productID?>">View</a></td>
										<td><a href="#">Delete</a></td>
									</tr>
								<?php
							}
						} else {
							echo "No products found.";
						}
						?>
					</tbody>
				</table>
			</div>
		</main>

		<!--Orders-->
		<main id="orderspage" hidden>
			<h1>Orders</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Catalogue</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Orders</a></li>
			</ul>
			
			<table class="prodtable">
				<thead>
					<tr>
						<th>Product</th>
						<th>Buyer</th>
						<th>Quantity</th>
						<th>Price/Unit</th>
						<th>Total</th>
						<th>Status</th>
						<th>Update</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * FROM orders WHERE sellerUID = '$userID'";
					$result = mysqli_query($conn, $sql);

					if ($result && mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$orderID = $row['orderID'];
							$productName = $row['itemNames'];
							$buyer = $row['fname'].' '.$row['lname'];
							$quantity = $row['itemQuantities'];
							$price = $row['itemPrices'];
							$total = $row['totalPrice'];
							$status = $row['status'];

							//Number formating
							$price = number_format($price);
							$total = number_format($total);

							?>
								<tr>
									<td><?php echo $productName?></td>
									<td><?php echo $buyer?></td>
									<td><?php echo $quantity?></td>
									<td><?php echo $price?></td>
									<td><?php echo $total?></td>
									<td><?php echo $status?></td>
									<td>
												<form method="POST" action="/profile/sellerprofile/assets/php/tracking.php">
													<input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
													<input type="hidden" name="sellerUID" value="<?php echo $userID; ?>">
													<select name="status">
														<option value="<?php echo $status?>"><?php echo $status?></option>
														<option value="Pending">Pending</option>
														<option value="Processing">Processing</option>
														<option value="Shipped">Shipped</option>
														<option value="Delivered">Completed</option>
													</select>
													<input type="submit" value="Update">

												</form>
											</td>

								</tr>
							<?php
						}
					} else {
						echo "No orders found.";
					}
					?>
				</tbody>
			</table>
		</main>

		<!--Edit Profile-->
		<main id="editprofilepage" hidden>
			<h1>Edit Profile</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Profile</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Edit profile</a></li>
			</ul>
			
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
		<!--End of Tabs-->
	</section>
	<!--Content-->

	<!--Scripts-->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="/profile/sellerprofile/assets/js/script.js"></script>
</body>
</html>