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
        <title>Contact Us</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/contact-cha.css">
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
                        <li><a class="active" href="contact-cha.php">CONTACT</a></li>             
                    </ul>                    
                </div>    
            </nav>        
				<br><br><br><br><br>
				<h2 id="ctd_h2">Contact Us</h2>
				<p id="ctd_p">Feel free to contact</p>  
        </section>    
        <div class="content">
           <div id="Contact">
				<div class="ctd_box">
				<br>
					<div class="contact-form">
			
						<div class="ctd_icon">
							<a class="fa fa-map-marker"></a><span class="contact-info">123, Colombo Road, Colombo</span><br>
							<a class="fa fa-phone"></a><span class="contact-info">+94773365415</span><br>
							<a class="fa fa-envelope"></a><span class="contact-info">cupidsarrowps@gmail.com</span><br>
							<a class="fa fa-facebook-square"></a><span class="contact-info">Cupid's arrow</span><br>
							<a class="fa fa-twitter"></a><span class="contact-info">#Cupidsarrow</span><br>
							<a class="fa fa-pinterest"></a><span class="contact-info">Cupidsarrow</span><br>
							<a class="fa fa-instagram"></a><span class="contact-info">@Cupidsarrow</span><br>
						</div>
						<?php
							require 'config.php';
						?>
			
						<div class="ctd_infor">
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="ctd_info">
								<label for="fname">Name</label><br>
								<input id="ctd_input" type="text" name="fname" placeholder="Your Name" required><br>
								<label for="email">Email</label><br>
								<input id="ctd_input" type="text" name="email" placeholder="Your Email" pattern="[a-z0-9._%+_-]+@[a-z0-9._]+\.[a-z]{2,3}" required><br>
								<label for="subject">Subject</label><br>
								<select id="ctd_select" name="subject"required>
									<option value = "Genaral Inquiry ">Genaral Inquiry</option>
									<option value = "Advertising ">Advertising</option>
									<option value = "Jobs ">Jobs</option>
									<option value = "Vendor issue ">Vendor issue</option>
									<option value = "Account settings ">Account settings</option>
									<option value = "Availability ">Availability</option>
									<option value = "Reviews ">Reviews</option>
									<option value = "Feedback ">Feedback</option>
									<option value = "Other ">Other</option>	
								</select><br><br>
								<label for="message">How can we help?</label><br>
								<textarea id="ctd_message" name="message" placeholder="Type your message" rows="10" cols="50" required></textarea><br>
								<input  type="submit" id="ctd_btn1" name="ct_btn1" value="Send"><br><br>	
							</form>
						</div>
			
					</div>
			
				</div>
			</div>
			<?php
	
		
				if(isset($_POST["ct_btn1"]))
				{
					$fname = $_POST["fname"];
					$email = $_POST["email"];
					$subject = $_POST["subject"];
					$message = $_POST["message"];
		
					$sql= "INSERT INTO ct_con(name,email,subject,message)VALUES('$fname','$email','$subject','$message')";
					if($con->query($sql))
					{
						echo '<script>alert("Success")</script>';
					}
					else
					{
						echo "Error". $con->error;
					}
				}
	
				$con->close();

			?>
			
			<script>
				if ( window.history.replaceState ) {
				window.history.replaceState( null, null, window.location.href );
				}
			</script>
			
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
                        <li><a class="active" href="contact-cha.php"><i class="fa fa-angle-right"></i>&nbspContact</a></li>
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
