<?php
  session_start();

  require 'config.php';

  $userID = "";
  if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
  }

  if(isset($_POST['btnPay'])){
    if(isset($_SESSION['userID'])){

      //if($con->query($addPayment) === TRUE){
        header('Location: payment-confirm-nim.php');
    //  }
    //  else{
        //echo "Error: ".$addPayment."<br>".$con->error;
    //  }
    }
    else{
      $message = 'Please login before making payment';
      echo "<script>
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
        <link rel="stylesheet" href="styles/payment-info-nim.css">
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

          <!-- ********** payment method page content ********** -->
          <div class="payement-method-nim">
            <div class="payment-method-heading-nim">
              <h2>Payment Details</h2>
            </div>
            <div class="payment-method-body-nim">
              <form class="form-payment-method-nim" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="payment-details-nim">
                  <!--<a href="" ><button name="btnPayPal">PayPal</button></a>-->
                  <div class="credit-card-nim" id="creditCard">
                    <div class="c1">
                      <div class="c2">
                        <label for="cardName">Name(as it appears on card) :</label><br>
                        <input type="text" name="cardName" id="cardName" required>
                      </div>
                      <div class="c3">
                        <label for="cvv">CVV:</label><br>
                        <input type="text" name="cvv" id="cvv" pattern="[0-9]+[0-9+[0-9]]" required>
                      </div>
                    </div>
                    <label for="cardNumber">Card Number:</label><br>
                    <input type="text" name="cardNumber" id="cardNumber"><br>
                    <div class="c4">
                      <div class="expireDate">
                        <p>Expire</p>
                        <label for="expMonth">Month</label>
                        <select class="expireMonth" name="expMonth" id="expMonth">
                          <option value="jan">01</option>
                          <option value="feb">02</option>
                          <option value="mar">03</option>
                          <option value="apr">04</option>
                          <option value="may">05</option>
                          <option value="jun">06</option>
                          <option value="jul">07</option>
                          <option value="aug">08</option>
                          <option value="sep">09</option>
                          <option value="oct">10</option>
                          <option value="nov">11</option>
                          <option value="dec">12</option>
                        </select>
                        <label for="expYear">Year</label>
                        <select class="expYear" name="expYear">
                          <option value="21">2022</option>
                          <option value="22">2023</option>
                          <option value="23">2024</option>
                          <option value="24">2025</option>
                          <option value="25">2026</option>
                          <option value="26">2027</option>
                          <option value="27">2028</option>
                          <option value="28">2029</option>
                          <option value="29">2030</option>
                          <option value="30">2031</option>
                        </select><br>
                      </div>
                      <div class="cardIcons">
                        <img src="images/master-icon.png" alt="master card icon" width="70px" height="auto">
                        <img src="images/Visa-icon.png" alt="visa card icon" width="70px" height="auto">
                      </div>
                    </div>
                  </div>
                  <div class="payment-buttons">
                    <button type="submit" name="btnPay" id="btnPay">Next</button>
                    <button type="reset" name="btnReset" id="btnReset">Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="social">
              <a id="fb" href="#facebook"><i class="fab fa-facebook"></i></a>
              <a id="tw" href="#twitter"><i class="fab fa-twitter"></i></a>
              <a id="pin" href="#pinterest"><i class="fab fa-pinterest"></i></a>
              <a id="ig" href="#instagram"><i class="fab fa-instagram"></i></a>
          </div>
        </div>

        <!-- ############# FOOTER ############# -->


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
      <script type="text/javascript" src="scripts/payment-info-nim.js"></script>
  </body>
</html>
