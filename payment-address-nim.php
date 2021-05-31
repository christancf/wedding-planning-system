<?php
  session_start();
  $userID="";
  if(isset($_SESSION['userID']))
  {
      $userID = $_SESSION['userID'];
  }

    require 'config.php';

    if(isset($_POST['btnSubmit'])){
        if(isset($_SESSION['userID'])){
          $_SESSION['fname'] = $_POST['fname'];
          $_SESSION['email'] = $_POST['email'];
          $_SESSION['address'] = $_POST['address'];
          $_SESSION['city'] = $_POST['city'];
          $_SESSION['zip'] = $_POST['zip'];
          $_SESSION['differentAdr'] = $_POST['differentAdr'];

          if(isset($_POST['differentAdr'])){
            $_SESSION['sName'] = $_POST['sName'];
            $_SESSION['sAddress'] = $_POST['sAddress'];
            $_SESSION['sCity'] = $_POST['sCity'];
            $_SESSION['sZip'] = $_POST['sZip'];
            $_SESSION['sTelephone'] = $_POST['sTelephone'];
            $_SESSION['sInstructions'] = $_POST['sInstructions'];
            $_SESSION['shippingMethod'] = $_POST['shippingMethod'];

            //$shippingAdr = "insert into shipping (user_id, ship_name, ship_address, ship_city, ship_zip_code, ship_telephone, ship_instructions, ship_method) values ('$userID', '$sName', '$sAddress', '$sCity', '$sZip', '$sTelephone', '$sInstructions', '$shippingMethod')";
          //  $shippingAdr_result = $con->query($shippingAdr);
          }

          //if($con->query($billingAdr) === TRUE){
            header('Location:payment-info-nim.php');
          }
          //else{
            //echo "Error: ".$billingAdr."<br>".$con->error;
          //}
        //}
        else{
          $message = 'Please login before making payment';
          echo "
            <script>
            alert('$message')
            window.location.replace('log-in-say.php');
            </script>";
        }
    }
    //$con->close();


 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cupid's Arrow | Payment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/payment-address-nim.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=e560">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap">
        <script src="https://kit.fontawesome.com/37f65abdaa.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--<div id="scrollbar"></div>-->
        <section class="header">
            <div class="topicon">
                <!-- when shopping cart icon is clicked, go to cart page is user has logged in, if not go to login page -->
                <a class="fas fa-shopping-cart" href="<?php if(isset($_SESSION['userID'])) { ?>cart-chr.php<?php } else { ?>log-in-say.php<?php }?>"></a>
                <div class="login">
                    <ul>
                        <?php if(!isset($_SESSION['userID'])) { //if user has not logged in show user profile icon?>
                        <li><a id="user" href="log-in-say.php" style="margin-top:.2em;"><i class="fas fa-user-circle"></i></a></li>
                        <?php } ?>
                        <div>
                            <li>
                                <?php
                                    require 'config.php';
                                    $get_image = "SELECT *
                                                            FROM users
                                                            WHERE user_ID = '$userID'
                                                            LIMIT 1";
                                    if($get_image_result=$con->query($get_image))
                                    {
                                        if($get_image_result->num_rows>0)
                                        {
                                            $row=$get_image_result->fetch_assoc();
                                            if(isset($_SESSION['userID']))
                                            {
                                                if(!empty($row['user_image']))  //display user picture
                                                {
                                                    echo'<center><img class="user-image" src="data:image/image;base64,'.base64_encode($row['user_image']).'" width="100" height="100" style="border-radius:50%"></center>';
                                                }
                                                else                //if user has no profile picture, display default picture
                                                {
                                                    ?>
                                                    <center><img src="images/user.png" width="100" height="100" class="user-image" ></center>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    $con->close();
                                ?>
                            </li>
                            <?php if(isset($_SESSION['userID'])){       //if user has logged in, show user account link and log out?>
                            <div>
                                <ul class="in">
                                    <li><a href="user-account-say.php">User Account</a></li>
                                    <li><a href="log-out-say.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php }else{        //if user has not logged in, show login/register options?>
                        <div class="in">
                            <li><a href="log-in-say.php">Login</a></li>
                            <li><a href="sign-up-say.php">Register</a></li>
                        </div>
                       <?php }?>
                    </ul>
                </div>
            </div>
            <nav>
                <div class="logo">
                    <a href="index.php">CUPID's<span>&nbspARROW</span></a>
                </div>
                <div class="topnav">
                    <ul>
                        <li><a class="active" href="index.php">HOME</a></li>
                        <div class="vendor-cat">
                            <li>VENDOR</li>
                            <div class="dropdown">
                                <ul>
                                    <li><a href="venue-mal.php">Venues</a></li>
                                    <li><a href="flower-cha.php">Flowers & Decor</a></li>
                                    <li><a href="beauty-cha.php">Beauty & Health</a></li>
                                    <li><a href="bridal-wear-mal.php">Bridal Wear</a></li>
                                    <li><a href="groom-chr.php">Groom Wear</a></li>
                                    <li><a href="photography-say.php">Photography</a></li>
                                    <li><a href="catering-nim.php">Catering</a></li>
                                    <li><a href="cake-nim.php">Cake</a></li>
                                    <li><a href="bands-nim.php">DJ/Bands</a></li>
                                    <li><a href="transportation-chr.php">Transportation</a></li>
                                    <li><a href="invitation-chr.php">Invitation</a></li>
                                    <li><a href="officiant-cha.php">Officiants</a></li>
                                </ul>
                            </div>
                        </div>
                        <li><a href="gallery-cha.php">GALLERY</a></li>
                        <!-- if user has logged in, go to overview page, else, go to login -->
                        <li><a href="<?php if(isset($_SESSION['userID'])) { ?>overview-chr.php<?php } else { ?>log-in-say.php<?php }?>">OVERVIEW</a></li>
                        <li><a href="checklist-cha.php">CHECKLIST</a></li>
                        <li><a href="contact-cha.php">CONTACT</a></li>
                    </ul>
                </div>
            </nav>
            <div class="page-name">Cupid's Arrow Shop</div>
        </section>
        <div class="content">
          <div class="address-content">
            <form class="billing-address-nim" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="billing-content">
                <div class="address-heading">
                  <h3>Billing Address</h3>
                </div>
                <div class="address-body">
                  <label for="fname"><i class="fas fa-user"></i>&nbsp;Name:</label><br>
                  <input type="text" name="fname" id="fname" placeholder="Saman M. Perera" required><br>
                  <label for="email"><i class="fas fa-envelope"></i>&nbsp;Email:</label><br>
                  <input type="text" name="email" id="email" placeholder="samanperera@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required><br>
                  <label for="address"><i class="fas fa-address-card"></i>&nbsp;Street Address:</label><br>
                  <input type="text" name="address" id="address" placeholder="452 W. 15th Street" required><br>
                  <label for="city"><i class="fas fa-city"></i>&nbsp;City:</label><br>
                  <input type="text" name="city" id="city" placeholder="Sri Jayewardenepura Kotte" required><br>
                  <label for="zip"><i class="fas fa-map-marker-alt"></i>&nbsp;Zip Postal Code:</label><br>
                  <input type="text" name="zip" id="zip" placeholder="10100" pattern="[0-9]+[0-9]+[0-9]+[0-9]+[0-9]" required><br>
                  <p>Don't know your zip code? <a href="http://www.geonames.org/postalcode-search.html?q=&country=LK" target="_blank">Find here</a></p><br>
                  <label for="differentAdr">Different shipping address</label>
                  <input type="checkbox" name="differentAdr" id="differentAdr" value="different" onclick="displayShippingForm()"><br>
                </div>
              </div>
              <div class="address-content" id="display">
                <div class="shipping-content">
                  <div class="address-heading">
                    <h3>Shipping Address</h3>
                  </div>
                  <div class="address-body">
                    <label for="sName"><i class="fas fa-user"></i>Name:</label><br>
                    <input type="text" name="sName" id="sName" placeholder="Saman M. Perera"><br>
                    <label for="sAddress"><i class="fas fa-address-card"></i>Street Address:</label><br>
                    <input type="text" name="sAddress" id="sAddress" placeholder="452 W. 15th Street"><br>
                    <label for="sCity"><i class="fas fa-city"></i>City:</label><br>
                    <input type="text" name="sCity" id="sCity" placeholder="Sri Jayewardenepura Kotte"><br>
                    <label for="sZip"><i class="fas fa-map-marker-alt"></i>Zip Postal Code:</label><br>
                    <input type="text" name="sZip" id="sZip" placeholder="10100" pattern="[0-9]+[0-9]+[0-9]+[0-9]+[0-9]"><br>
                    <p>Don't know your zip code? <a href="http://www.geonames.org/postalcode-search.html?q=&country=LK" target="_blank">Find here</a></p><br>
                    <label for="sTelephone"><i class="fas fa-envelope"></i>Telephone:</label><br>
                    <input type="text" name="sTelephone" id="sTelephone" placeholder="0771234567" pattern="[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]"><br>
                    <p>Instructions for order processing:</p>
                    <textarea name="sInstructions" rows="5" cols="50" placeholder="Enter the instrucions to process your order"></textarea><br>
                    <div class="shipping-method-nim">
                      <h3>Shipping Method</h3>
                      <label><input type="radio" name="shippingMethod" value="standard">Standard</label><br>
                      <label><input type="radio" name="shippingMethod" value="expedited">Expedited</label><br>
                      <label><input type="radio" name="shippingMethod" value="urgent">Urgent</label><br>
                    </div>
                  </div>
                </div>
              </div>
                <div class="address-buttons">
                  <button type="submit" name="btnSubmit" id="btnSubmit">Submit</button>
                  <button type="reset" name="btnReset" id="btnReset">Reset</button>
                </div>
              </div>
            </form>
          <div class="social">
              <a id="fb" href="#facebook"><i class="fab fa-facebook"></i></a>
              <a id="tw" href="#twitter"><i class="fab fa-twitter"></i></a>
              <a id="pin" href="#pinterest"><i class="fab fa-pinterest"></i></a>
              <a id="ig" href="#instagram"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <!--  FOOTER  -->

        <footer>
          <div class="footer-container">
            <div class="container">
                <div class="about">
                    <h3>About Us</h3>
                    <p>Cupid's Arrow is a user-friendly platform built for managing wedding planning tasks, payments and vendors.</p>
                </div>
                <div class="ftlink">
                    <h3>Top links</h3>
                    <ul>
                        <li><a href="<?php if(isset($_SESSION['userID'])) { ?>user-account-say.php<?php } else { ?>log-in-say.php<?php }?>"><i class="fa fa-angle-right"></i>&nbspUser Account</a></li>
                        <li><a href="gallery-cha.php"><i class="fa fa-angle-right"></i>&nbspGallery</a></li>
                        <li><a href="contact-cha.php"><i class="fa fa-angle-right"></i>&nbspContact</a></li>
                    </ul>
                </div>
                <div class="form">
                    <form action="php/subscription.php">
                        <h3>Subscribe to our newsletter:</h3></br>
                        <div class="sus">
                            <input type="email" id="subscription" name="subscription" placeholder="Enter your e-mail address"></br>
                            <input type="submit" id="subscribe" value="GO">
                        </div>
                    </form>
                </div>
            </div>
            <div class="ft">
                <h6>&copy&nbsp2021 Cupid's Arrow. All rights reserved.<a href="privacy-cha.php">&nbspPrivacy&nbspPolicy&nbsp&amp;&nbspTerms&nbspof&nbspUsage</a><p>&nbsp|&nbspDesign&nbspby&nbsp</p><p id="group">MLB_01.01_06</p></h6>
            </div>
          </div>
        </footer>
          <script async type="text/javascript" src="scripts/payment-address-nim.js"></script>
    </body>
  </html>
