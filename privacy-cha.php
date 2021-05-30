<?php
    session_start();
    require 'config.php';
    $userID="";
    if(isset($_SESSION['userID']))
    {
        $userID = $_SESSION['userID'];
    }
   $con->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Privacy Policy & Terms Of Usage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/privacy-cha.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
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
                        <li><a href="index.php">HOME</a></li>
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
            <br><br><br><br><center><h1 id="ct_h1">Privacy Policy & Terms of Usage</h2></center>  
        </section>    
        <div class="content">
            <div class="p_t">	
				<br>
				<h2 class="thath_h1">Privacy Policy<h2><br>
				<p>CUPID's ARROW is committed to protect your privacy. This privacy Policy explains how your personal information is collected, used, and disclosed by CUPID's ARROW.</p>
				<p>This privacy policy applies to our CUPID's Arrow website. By accessing or using our service, you signify that you have clearly  read and understood, and agree to our  use and disclosure of your personal information as explained in this Privacy Policy and our Terms of Service.</p>
				<br>
					
				<h2 class="thath_h1">Terms Of Usage<h2><br>
				<p>By using and placing a vendor order with CUPID's ARROW, you confirm that you are in agreement with our terms and usage as given below. This will be applied to our whole website.</p>
				<br>
					
				<h2 class="thath_h1">What Data Do We Collect?<h2><br>
				<p>Our website gather information from you when you visit our vendors, register, place an order to cart, subscribe to newsletter, and when filling the forms of our website.</p>
				<li>Name / Username</li>
				<li>Phone Numbers (If necessary)</li>
				<li>Email Addresses</li>
				<li>Debit / credit card information</li>
				<li>Password</li>
				<br>
					
				<h2 class="thath_h1">How Do We Use The Data We Collect From Our Website?<h2><br>
				<p>These are the ways that we use your data</p>
				<li>To personalize your experience when you search a vendor</li>
				<li>To improve our vendor service and customer service</li>
				<li>To improve our website services according to your feedbacks</li>
				<li>To process online payments</li>
				<br>
					
				<h2 class="thath_h1">Where And When Is Data Collected From Customers And Vendors?<h2><br>
				<p>The data you submit will be collected by our website.</p>
				<br>
					
				<h2 class="thath_h1">How Do We Use The Email Address You Entered When You Are Registering?<h2><br>
				<p>When you  subscribe to our Newsletter, you agree to receive emails from us. You can cancel receiving emails from us by clicking unsubscribe button. The payment processing email will not be used for any subscribed services.</p>
				<br>
					
				<h2 class="thath_h1">Can A Customer Or A Vendor Can Update The Data They Entered?<h2><br>
				<p>Customer or vendor can update their personal data from the profile update option. Passwords can also be updated using the forgot password option when you are logging to the system.<p/>
				<br>
					
				<h2 class="thath_h1">How long do we keep your data entered to the website?<h2><br>
				<p>Our website will keep your data as long as you use our website. When there is no need to keep your data, we will remove your data from the system.</p>
				<br>
					
				<h2 class="thath_h1">How Do We secure Your Data?<h2><br>
				<p>We ensure that the vendor contract details, username and password details, and the payment details will not be disclosed to anyone.</p>
				<br>
					
				<h2 class="thath_h1">Term And Termination<h2><br>
				<p>The agreement will remain until terminated by our website, vendor or customer</p>
				<br>
					
				<h2 class="thath_h1">Customer And Vendor Consent<h2><br>
				<p>By accessing our website, registering to our website account, or making online payment, Cusomer and Vendor should consent to our privacy Policy and Terms of usage.</p>
				<br>
					
				<h2 class="thath_h1">Updates To Our Privacy Policy And Terms Of Usage<h2><br>
				<p>We may update our privacy policy and terms of usages anytime according to the needs of our website.</p>
				<br>
					
				<h2 class="thath_h1">Cookies<h2><br>
				<p>Our website use cookies to personalize the content you visited in our website. A cookie is a small piece of data on your device stored by your web browser. You can disable your cookies by your browser. If you disable the cookies, you cannot be accessed the our website functions correctly.</p>
				<br>
					
				<h2 class="thath_h1">Sessions<h2><br>
				<p>Our website use sessions to identify the places of the website you have visited. A session is a small piece of data on your device stored by your web browser.</p>
				<br>
					
				<h2 class="thath_h1">Contact Us<h2><br>
				<p>Feel free to contact us</p>
				<li>Via Email: cupidsarrowps@gmail.com</li>
				<br>
				<br>
			</div>
			
            <div class="social">
                <a id="fb" href="#facebook"><i class="fab fa-facebook"></i></a>
                <a id="tw" href="#twitter"><i class="fab fa-twitter"></i></a>
                <a id="pin" href="#pinterest"><i class="fab fa-pinterest"></i></a>
                <a id="ig" href="#instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
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
                <h6>&copy&nbsp2021 Cupid's Arrow. All rights reserved.<a class="active" href="privacy-cha.php">&nbspPrivacy&nbspPolicy&nbsp&amp;&nbspTerms&nbspof&nbspUsage</a><p>&nbsp|&nbspDesign&nbspby&nbsp</p><p id="group">MLB_01.01_06</p></h6>
            </div>
          </div>
        </footer>
    </body>
</<html>
