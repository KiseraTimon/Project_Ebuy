<?php
// Session Start
session_start();

//Database connectivity
require '../../components/database.php';

if (!isset($_SESSION['userType']) && $_SESSION['userType'] != 'client') {
  echo '<script>
          alert("You are not authorized to view this page.");
          window.location.href = "/index.php";
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

    $profilepic = $row['profilepic'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $uname = $row['uname'];
    $email = $row['email'];
    $password = $row['password'];

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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- CSS -->
    <link rel="stylesheet" href="/profile/clientprofile/css/style.css" />
    <link rel="stylesheet" href="/defaults.css" />
    <link rel="stylesheet" href="/pageclasses/assets/css/buy.css" />
  </head>
  <body>
    <!--Header-->
    <div class="header__wrapper">
      <header></header>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
              <img src="<?php echo $profilepic; ?>">
            <span></span>
          </div>
          <h2><?php echo $fname.' '.$lname?></h2>
          <p><?php echo $uname?></p>
          <p><?php echo $email?></p>

          <ul class="about">
            <li><span>4</span>Favourites</li>
            <li><span>7</span>Testimonials</li>
            <li><span>200,543</span>Visits</li>
          </ul>

          <div class="content">
            <p>
              <!--Welcome note from car depot-->
              Welcome to EBuy! We are glad to have you here. We are a platform that connects buyers and sellers within the Strathmore University Region. Feel free to explore the website and purchase whatever may interest you. Enjoy your stay!
              <br>
              <br>
              Follow us on social media
            </p>

            <ul>
              <li><i class="fab fa-twitter"></i></li>
              <i class="fab fa-pinterest"></i>
              <i class="fab fa-facebook"></i>
              <i class="fab fa-dribbble"></i>
            </ul>

            <br>
            <br>
            <button onclick="window.location.href='/index.php'">Home</button>
            <button onclick="window.location.href='/forms/logout.php'">Logout</button>
            <button style="background-color: red" onclick="window.location.href='#'">Delete</button>
          </div>
        </div>

        <!--Tabs-->
        <div class="right__col">
          <nav>
            <ul>
              <li><button onclick="tabselect(event, 'cart');">My Shopping Cart</button></li>
              <li><button onclick="tabselect(event, 'testimonials');">Testimonials</button></li>
              <li><button onclick="tabselect(event, 'inquiries');">Inquiries</button></li>
              <li><button onclick="tabselect(event, 'account');">Account</button></li>
            </ul>
          </nav>

          <!--Favourites Tab-->
          <div id="cart" class="tab-content active-tab">
          </div>

          <!--Testimonials Tab-->
          <div id="testimonials" class="tab-content">
          <div class="testpanel">
            <?php
            // Database connection
            require_once '../../components/database.php';

            // Query to select testimonial details
            $userID = $_SESSION['userID'];

            $stmt = $conn->prepare("SELECT * FROM testimonials WHERE userID = $userID");
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc())
            {
                $dispname = $row['dispname'];
                $tests = $row['tests'];
                $testreview = $row['testreview'];
            ?>
              <div class="testcard">
                <div class="testname">
                  <p><?php echo $dispname;?></p>
                </div>
                <div class="testtext">
                  <p>
                    <?php echo $tests?>
                  </p>
                </div>
                <div class="testrating">
                  <?php
                  echo displayStars($testreview)
                  ?>
                </div>
              </div>

        
              <?php
            }
            if($result->num_rows === 0)
            {
              ?>
              <div class="testcard">
                <div class="testname">
                  <p>Oopps</p>
                </div>
                <div class="testtext">
                  <p>
                    Nothing to show here. Add a testimonial to get started
                  </p>
                  <br>
                  <p>
                    At EBuy we value your feedback. Kindly, leave a rating score when adding a testimonial.
                  </p>
                </div>
                <div class="testrating">
                  <p>
                    No ratings to show
                  </p>
                </div>
              </div>
              <?php
            }
            ?>
            <div class="testcard">
                <div class="addtest" title="Add a testimonial" onclick="addTest();">
                  <span class="material-symbols-outlined">
                    add
                  </span>
                </div>
                <div class="testform" id="testform">
                  <form action="http://localhost:5000/profile/clientprofile/php/testimonials.php" method="POST">
                    <p>DISCLAIMER:<br>Your testimonials are visible to the general public. Kindly, portray sensitivity and ethics when adding one<br>Testimonials are subject to deletion
                    </p>
                    <div class="form-group">
                      <label for="dispname">Type your display name</label>
                      <input type="text" name="dispname">
                    </div>
                    <div class="form-group">
                      <label for="tests">Type your testimonial here</label><br>
                      <textarea name="tests" maxlength="300"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="testreview">Leave a review (0-100)</label><br>
                      <input type="number" maxlength="3" max="100" min="0" name="testreview">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Submit">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--Inquiries Tab-->
          <div id="inquiries" class="tab-content">
              <div class="inquiry">
                <div class="inqnote">
                  <p>Hello, <b><?php echo $lname.' '.$fname?></b></p>
                  <br>
                </div>
                <div class="inqtext">
                  <A>
                    Due to security reasons, we encourage all our clients wishing to make an inquiry to contact us directly through our company mobile number below:
                    <br>
                    <br>
                    <b>000 000 0000</b>
                    <br>
                    <br>
                    <br>
                </div>
              </div>
            <?php
            ?>
          </div>

          <!--Account Tab-->
          <div id="account" class="tab-content">
            <div class="account">
              <div class="accnote">
                <p>Account Information</p>
              </div>
              <div class="acctext">
                  <form action="http://localhost:5000/profile/updator.php" method="POST" enctype="multipart/form-data">
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

                    <label for="password">Current Password</label>
                    <input type="password" name="currentpassword" value="<?php echo $password?>" readonly><br>

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
                    <button type="submit" name="update">Update</button>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!--Scripts-->
    <script  src="/productpages/product.js"></script>
    <script src="/profile/clientprofile/js/client.js"></script>

    <!--Ratings-->
    <?php
    function displayStars($rating) {
      $stars = '';
      // Empty stars
      if ($rating <= 10) {
          $stars = str_repeat('<i class="far fa-star"></i>', 5);
      }
      // 1 half-filled star, the rest are empty
      elseif ($rating >= 11 && $rating <= 25) {
          $stars = '<i class="fas fa-star-half-alt"></i>' . str_repeat('<i class="far fa-star"></i>', 4);
      }
      // 2 stars, the rest are empty
      elseif ($rating >= 26 && $rating <= 35) {
          $stars = str_repeat('<i class="fas fa-star"></i>', 2) . str_repeat('<i class="far fa-star"></i>', 3);
      }
      // 3 stars, the rest are empty
      elseif ($rating >= 36 && $rating <= 55) {
          $stars = str_repeat('<i class="fas fa-star"></i>', 3) . str_repeat('<i class="far fa-star"></i>', 2);
      }
      // 3 stars and 1 half-star, the remaining are empty
      elseif ($rating >= 56 && $rating <= 65) {
          $stars = str_repeat('<i class="fas fa-star"></i>', 3) . '<i class="fas fa-star-half-alt"></i>' . '<i class="far fa-star"></i>';
      }
      // 4 stars, the remaining one is empty
      elseif ($rating >= 66 && $rating <= 75) {
          $stars = str_repeat('<i class="fas fa-star"></i>', 4) . '<i class="far fa-star"></i>';
      }
      // 4 stars and 1 half star
      elseif ($rating >= 76 && $rating <= 85) {
          $stars = str_repeat('<i class="fas fa-star"></i>', 4) . '<i class="fas fa-star-half-alt"></i>';
      }
      // 5 stars for 86+
      else {
          $stars = str_repeat('<i class="fas fa-star"></i>', 5);
      }
      return $stars;
    }
    ?>
</body>
</html>
