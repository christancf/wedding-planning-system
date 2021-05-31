<?php
  session_start();
  require 'config.php';

  $_SESSION['payAmount'] = $payAmount;
  $pay_date = date("Y-m-d H:i:s");
  if(isset($_SESSION['userID'])){
    $fname = $_SESSION['fname'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];
    $city = $_SESSION['city'];
    $zip = $_SESSION['zip'];
    $shippingAdr = $_SESSION['differentAdr'];

    if($shippingAdr == "different"){
      $sName = $_SESSION['sName'];
      $sAddress = $_SESSION['sAddress'];
      $sCity = $_SESSION['sCity'];
      $sZip = $_SESSION['sZip'];
      $sTelephone = $_SESSION['sTelephone'];
      $sInstructions = $_SESSION['sInstructions'];
      $shippingMethod = $_SESSION['shippingMethod'];
    }
  }

  $userID="";
  if(isset($_SESSION['userID']))
  {
      $userID = $_SESSION['userID'];
  }
   //$name = $_SESSION['fname'];
   if(isset($_POST['btnConfirmPay'])){

     $deleteCart = 'DELETE from cart WHERE user_ID ='.$userID;

     $con->query($deleteCart);


     if(isset($_SESSION['userID'])){

       $addPayment = "insert into payment (user_id, bill_name, bill_email, bill_address, bill_city, bill_zip_code, pay_date, pay_amount) values ('$userID', '$fname', '$email', '$address', '$city', '$zip', '$pay_date', '$payAmount')";
       $addPaymentResult = $con->query($addPayment);

       if($con->query($addPayment) === TRUE){

         $message = 'Payment Successful. Redirecting to Cart';
         echo "
           <script>
           alert('$message')
           window.location.replace('cart-chr.php');
           </script>";
       }
       else{
         echo "Error: ".$addPayment."<br>".$con->error;
       }
     }
     else{
       $message = 'Please login before making payment';
       echo "
         <script>
         alert('$message')
         window.location.replace('log-in-say.php');
         </script>";
     }
   }
   $con->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cupid's Arrow | Payment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/payment-confirm-nim.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=e560">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap">
        <script src="https://kit.fontawesome.com/37f65abdaa.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--<div id="scrollbar"></div>-->
        <section class="header headWidth">
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
        <?php
        require 'config.php';
          echo '<div class="displayDetails">';
            echo '<div class="billingDetails">';
              echo '<h2>Billing Details</h2>';
                echo '<p>'.$fname.'<br>'.$email.'<br>'.$address.'<br>'.$city.'<br>'.$zip.'</p>';
            echo '</div>';
            echo '<div class="shippingDetails">';
            if($shippingAdr == "different"){
              echo '<h2>Shipping Details</h2>';
                echo '<p>'.$sName.'<br>'.$sAddress.'<br>'.$sCity.'<br>'.$sZip.'<br>'.$sTelephone.'</p>';
                echo '<br><h3>Shipping Method: </h3><p>'.$shippingMethod.'</p>';
                echo '<br><h3>Shipping Instructions:</h3>';
                echo '<p>'.$sInstructions.'</p>';
              echo '</div>';
            }
            else{
              echo '<h4>shipping to billing address</h4>';
            }
            echo '<div class="paymentDetails">';
              echo '<h2>Payment Details</h2>';
               $displayPayment = 'SELECT company_name, price, category FROM cart WHERE user_ID ='.$userID;
               $displayPaymentResult = $con->query($displayPayment);

               if($displayPaymentResult !== false && $displayPaymentResult->num_rows > 0){
                 while($row = $displayPaymentResult->fetch_assoc()){
                   echo '<div class="displayPayment">';
                     echo '<p>'.$row['company_name'].' : Rs.'.$row['price'].'/=</p>';
                   echo '</div>';
                 }
               }
               else{
                 echo "Cart is empty";
               }
            echo '</div>';
          echo '</div>';
          //echo '</div>';
          $con->close();
         ?>
        <form class="confirm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
          <button name="btnConfirmPay" id="confirm-payment">Confirm & Pay</button>
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
    </body>
</<html>
