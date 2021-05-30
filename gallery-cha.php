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
        <title>Gallery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/gallery-cha.css"/>
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
                        <li><a class="active" href="gallery-cha.php">GALLERY</a></li>
                        <!-- if user has logged in, go to overview page, else, go to login -->
                        <li><a href="<?php if(isset($_SESSION['userID'])) { ?>overview-chr.php<?php } else { ?>log-in-say.php<?php }?>">OVERVIEW</a></li>                        
                        <li><a href="checklist-cha.php">CHECKLIST</a></li>
                        <li><a href="contact-cha.php">CONTACT</a></li>             
                    </ul>                    
                </div>    
            </nav>        
				<br><br><br><br><br>
				<center><h2 id="ctd_h2">Gallery</h2></center>
				
        </section>    
        <div class="content">
           
			<div class="gallery">
			<br><br>
			<?php
			require 'config.php';
			$sql= "SELECT image FROM wedding_gallery where ID=1";

			if($result=$con->query($sql))
			{

	
				if($result->num_rows > 0)
				{
			
					while($row = $result->fetch_assoc())
					{
						echo ("<div class=ct_slides>"); 						
						echo '<img src="data:image;base64,'.base64_encode($row['image']).'">';
						echo ("</div>");
						echo ("<br>");				
					}	
			
				}
		
				else
				{
					echo "no results";
				}
		
			}
			
			echo '<center><i><h1 id="ven1">Our Happy Customers</h1></i></center>';
			echo ("<br>");
			echo ("<br>");
			echo ("<br>");
			$sql= "SELECT * FROM wedding_gallery where  ID>13 ";

			if($result=$con->query($sql))
			{

	
				if($result->num_rows > 0)
				{
			
					while($row = $result->fetch_assoc())
					{
						echo ("<div class=ct_box1>"); 
						echo ("<div class=ctd>");
						echo ("<h3 id='ven'>".$row['vendor']."</h3>");	
						echo ("</div>");
						echo '<img id="left-image1">';
						echo ("<div class=ct1>");
						echo("<br>");
						echo ("</div>");
						echo '<img id="img-box1" src="data:image;base64,'.base64_encode($row['image']).'">';
						echo ("</div>");
						echo("<br>");						
					}	
			
				}
		
				else
				{
					echo "no results";
				}
		
			}
			
			echo ("<br>");
			echo '<center><i><h1 id="ven1">Our Vendor Gallery</h3></i></center>';
			
			$sql= "SELECT * FROM wedding_gallery where ID>1 AND ID<14 ";
			if($result=$con->query($sql))
			{

	
				if($result->num_rows > 0)
				{
			
					while($row = $result->fetch_assoc())
					{
						echo ("<div class=ct_box>"); 						
						echo '<img id="left-image">';
						echo ("<div class=ct>");
						echo ("<i><h3 id='ven'>".$row['vendor']."</h3></i>");
						echo ("<p id='vend'>".$row['description']."</p>");
						echo("<br>");
						echo ("<p id='vend'>".$row['link']."</p>");
						echo("<br>");
						echo ("</div>");
						echo '<img id="img-box" src="data:image;base64,'.base64_encode($row['image']).'">';
						echo ("</div>");							
					}	
			
				}
		
				else
				{
					echo "no results";
				}
		
			}
			
			echo ("<br>");
			echo ("<br>");
			echo "<center><i><h1 id='ven1'>Thank you for choosing CUPID's ARROW</h1></i></center>";
			echo ("<br>");
			
			$con->close();
			?>
			
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
                        <li><a class="active" href="gallery-cha.php"><i class="fa fa-angle-right"></i>&nbspGallery</a></li>
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