<?php

class auth
{
    //Signup header
    function authhead()
    {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="/formclasses/assets/css/forms.css" />
                <title>Authenticate | Ebuy</title>
            </head>
            <body>
        <?php
    }

    //Signup function
    function signup()
    {
        ?>
            <div class="container">
                <div class="content">
                    <h1>Join Us</h1>
                    <p>Please enter your details.</p>
                    <form action="/formclasses/assets/php/signup.php" method="post" enctype="multipart/form-data">
                        <!--First name-->
                        <div class="input__group">
                            <label for="fName">First name</label>
                            <input type="text" name="fName" placeholder="Enter your first name" />
                        </div>

                        <!--Last name-->
                        <div class="input__group">
                            <label for="lName">Last name</label>
                            <input type="text" name="lName" placeholder="Enter your last name" />
                        </div>

                        <!--Username-->
                        <div class="input__group">
                            <label for="uname">Username</label>
                            <input type="text" name="uname" placeholder="Set your username" />
                        </div>

                        <!--Email-->
                        <div class="input__group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" placeholder="Enter your e-mail" />
                        </div>

                        <!--Contact-->
                        <div class="input__group">
                            <label for="contactphone">Phone number</label>
                            <input type="number" name="contactphone" placeholder="Enter your phone number" />
                        </div>

                        <!--Password-->
                        <div class="input__group">
                            <label for="passw">Password</label>
                            <input type="password" name="passw" placeholder="Set your password" />
                        </div>

                        <!--Password confirmation-->
                        <div class="input__group">
                            <label for="confirmpassword">Confirm password</label>
                            <input type="password" name="confirmpassword" placeholder="Confirm your password" />
                        </div>

                        <!--Profile picture-->
                        <div class="input__group">
                            <label for="profilePic">Profile Picture</label>
                            <input type="file" name="profilePic" required/>
                        </div>

                        <!--Submission-->
                        <button type="submit">Sign Up</button>
                    </form>
                    <p>Already have an account? <a href="/pages/login.php">Sign In here</a></p>
                </div>
            </div>
        <?php
    }

    //Login function
    function login()
    {
        ?>
            <div class="container">
                <div class="content">
                    <h1>Welcome Back</h1>
                    <p>Please enter your details.</p>
                    <form action="/formclasses/assets/php/login.php" method="POST">

                        <!--Username-->
                        <div class="input__group">
                            <label for="uname">Username</label>
                            <input type="text" name="uname" placeholder="Enter your username" />
                        </div>

                        <!--Password-->
                        <div class="input__group">
                            <label for="passw">Password</label>
                            <input type="password" name="passw" placeholder="Enter your password" />
                        </div>

                        <!--Submission-->
                        <button type="submit">Log In</button>
                    </form>
                    <p>Don't have an account? <a href="signup.php">Sign Up here</a></p>
                </div>
            </div>
        <?php
    }

    function business()
    {
        ?>
            <div class="container">
                <div class="content">
                    <h1>Register a business account</h1>
                    <p>Please enter your details.</p>
                    <form action="/formclasses/assets/php/business.php" method="POST">

                        <!--fname-->
                        <div class="input__group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" placeholder="Enter your first name" />
                        </div>

                        <!--lname-->
                        <div class="input__group">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" placeholder="Enter your last name" />
                        </div>

                        <!--Business Name-->
                        <div class="input__group">
                            <label for="bname">Business Name</label>
                            <input type="text" name="bname" placeholder="Enter your business' name" />
                        </div>

                        <!--Business Email-->
                        <div class="input__group">
                            <label for="bemail">E-mail</label>
                            <input type="email" name="bemail" placeholder="Enter your business email" />
                        </div>

                        <!--Business Contact-->
                        <div class="input__group">
                            <label for="bcontact">Phone number</label>
                            <input type="number" name="bcontact" placeholder="Enter your business phone number" />
                        </div>

                        <!--Headquarters-->
                        <div class="input__group">
                            <label for="hq">Headquarters</label>
                            <input type="text" name="hq" placeholder="Enter your HQ location" />
                        </div>

                        <!--Submission-->
                        <button type="submit">Apply</button>
                    </form>
                    <p>You will access your account using your normal password details</p>
                </div>
            </div>
        <?php
    }


}
?>