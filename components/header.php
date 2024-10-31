<?php


class header
{
  function navigation()
  {
    session_start();
    ?>
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <a href="/index.php">Car Depot</a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="/pages/about.php">About us</a></li>
          <li><a href="/pages/stock.php">Buy a car</a></li>
          <li><a href="/pages/sell.php">Sell a car</a></li>
          <li><a href="/pages/stock.php?availability=Import">Import</a></li>
          <!-- <li><a href="#contact">Contact</a></li> -->
          <?php
          if(isset($_SESSION['uname']))
          {
            ?>
              <li class="nav__links__btn">
              <a class="btn" href="/formclasses/assets/php/logout.php">Logout</a>
              </li>
              <li class="nav__links__btn">
              <a class="btn" href="/formclasses/assets/php/verifier.php">Profile</a>
              </li>
            <?php
          }
          else
          {
            ?>
            <li class="nav__links__btn">
            <a class="btn" href="/pages/signup.php".>Sign Up</a>
            </li>
            <li class="nav__links__btn">
            <a class="btn" href="/pages/login.php">Sign In</a>
            </li>
            <?php
          }
          ?>
        </ul>
        <div class="nav__btns">
          <?php
          if(isset($_SESSION['uname']))
          {
            // echo '<a class="btn btn__primary" href="/forms/logout.php">Logout</a>';
            // echo '<a class="btn btn__secondary" href="/forms/login.html"><img src="/forms/assets/account3.png"></a>';

            //Database connection
            require_once 'database.php';

            //Fetch profilepic from database
            $stmt = $conn->prepare("SELECT profilepic FROM users WHERE uname = ?");
            $stmt->bind_param("s", $_SESSION['uname']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($profilepic);
            $stmt->fetch();
            
            // BLOB conversion
            $profilepic = base64_encode($profilepic);
            $profilepic = 'data:image/jpeg;base64,'.$profilepic;
            
            $stmt->close();

            ?>
            <!--Displaying the image-->
            <img src="<?php echo $profilepic;?>" class="user-pic" onclick="toggleMenu()">
            <!-- <img src="/forms/assets/account3.png" class="user-pic" onclick="toggleMenu()"> -->

            <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                <div class="user-info">
                  <img src="
              <?php
              //Display image
              echo $profilepic;
              ?>">
                  <h3>Hello, <?php echo $_SESSION['uname'];?></h3>
                </div>
                <hr>
                <a href="/formclasses/assets/php/verifier.php" class="sub-menu-link">
                  <img src="/components/assets/user.png">
                  <p>My account</p>
                  <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
                  <img src="/components/assets/help.png">
                  <p>Help & Support</p>
                  <span>></span>
                </a>
                <a href="/formclasses/assets/php/logout.php" class="sub-menu-link">
                  <img src="/components/assets/exit.png">
                  <p>Logout</p>
                  <span>></span>
                </a>
                <?php
                if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin')
                {
                  ?>
                  <hr>
                      <p style="font-size: 13px; text-align: center; margin: auto;">You have administrator priviledges</p>
                  <?php
                }
                ?>
              </div>
            </div>
            <?php
          }
          else
          {
            ?>
              <a class="btn btn__primary" href="/pages/signup.php">Sign Up</a>
              <a class="btn btn__secondary" href="/pages/login.php">Sign In</a>
            <?php
          }
          ?>
        </div>
      </nav>

      <!--Script for profile menus-->
      <script>
        let subMenu =document.getElementById('subMenu');

        function toggleMenu(){
          subMenu.classList.toggle('open-menu');
        }

        //On esc key press close the menu
        document.addEventListener('keydown', function(event){
          if(event.key === 'Escape'){
            subMenu.classList.remove('open-menu');
          }
        });
      </script>
    <?php
  }
}
?>