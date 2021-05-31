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
        <title>Wedding Checklist</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/checklist-cha.css">
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
                        <li><a class="active" href="checklist-cha.php">CHECKLIST</a></li>
                        <li><a href="contact-cha.php">CONTACT</a></li>             
                    </ul>                    
                </div>    
            </nav>        
				<br><br><br><br>
				<center>
				<h1 id="ctd_hea1">Checklist</h1><br><br><br><br><br>
				</center>  
        </section>    
        <div class="content">
			<div id="checklist">
	
				<div class="page-divide">
					<div class="1"></div>
			
					<!--Page divide for collapsible-->
		
					<div class="2">
					<br>
						
						<!--15 months to go-->
						<h2 id="cth">15 months to go</h2>
						<button class="collapsible"  >You have only 15 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									Find your love 
								</li>
								<li>
									Got to know eachother
								</li>
								<li>
									 Got engaged 
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
			
						<!--12 months to go-->
						<h2 id="cth">12 months to go</h2>
						<button class="collapsible" >You have only 12 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									Discover your wedding style
								</li>
								<li>
									Research wedding costs in your area
								</li>
								<li>
									Book your venue
								</li>
								<li>
									Decide your guest list
								</li>
								<li>
									Discuss the financials with your partner and your family
								</li>
								<li>
									 Decide your wedding budget
								</li>
								<li>
									 Book a wedding planner
								</li>
								<br>		
							</ul>	
						</div>
						<br>
				
						<!--10 months to go-->
						<h2 id="cth">10 months to go</h2>
						<button class="collapsible" >You have only 10 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Contact and book your officient
								</li>
								<li>
									 Go dress shopping
								</li>
								<li>
									 Choose the suppliers
								</li>
								<li>
									 Decide your wedding party
								</li>
								<br>
							</ul>
						</div>
						<br>
				
						<!--8 months to go-->
						<h2 id="cth">8 months to go</h2>
						<button class="collapsible" >You have only 8 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Formally book your suppliers
								</li>
								<li>
									 Book wedding night accommodation
								</li>
								<li>
									 Place your dress order
								</li>
								<br><br>
							</ul>
						</div>
						<br>
				
						<!--6 months to go-->
						<h2 id="cth">6 months to go</h2>
						<button class="collapsible" >You have only 6 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Purchase your wedding rings
								</li>
								<li>
									 Print invitations
								</li>
								<li>
									 Finalize details with suppliers
								</li>
								<li>
									 Book your honeymoon
								</li>
								<li>
									 Book transportation
								</li>
								<li>
									 Finalize bridemaid and groomsmen attire
								</li>
								<li>
									 Book your makeup artist
								</li>
								<br>
							</ul>
						</div>
						<br>
				
						<!--4 months to go-->
						<h2 id="cth">4 months to go</h2>
						<button class="collapsible" >You have only 4 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Order your wedding cake
								</li>
								<li>
									 Plan your rehearsal
								</li>
								<li>
									 Confirm decor details
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--2 months to go-->
						<h2 id="cth">2 months to go</h2>
						<button class="collapsible" >You have only 2 months</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Meet with your officient to confirm your ceremony content
								</li>
								<li>
									 Send out your invitations
								</li>
								<li>
									 Buy gifts
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--6 weeks to go-->
						<h2 id="cth">6 weeks to go</h2>
						<button class="collapsible" >You have only 6 weeks</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Print all other stationary
								</li>
								<li>
									 Enjoy your last single days
								</li>
								<li>
									 Meet your loved ones
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--2 weeks to go-->
						<h2 id="cth">2 weeks to go</h2>
						<button class="collapsible" >You have only 2 weeks</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Have a dress fitting
								</li>
								<li>
									 Confirm the photographs
								</li>
								<li>
									 Finalize your music playlist
								</li>
								<li>
									 Choose your menu with your venue
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--1 week to go-->
						<h2 id="cth">1 week to go</h2>
						<button class="collapsible" >You have only 1 week</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Send your guest list to the venue
								</li>
								<li>
									 Break in your shoes
								</li>
								<li>
									 Confirm the supplier attendance
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--48 hours to go-->
						<h2 id="cth">48 hours to go</h2>
						<button class="collapsible" >You have only 48 hours</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Pick up your dress
								</li>
								<li>
									 Get the payments done with suppliers
								</li>
								<li>
									 Spend some extra time with your parents
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--1 day to go-->
						<h2 id="cth">1 day to go</h2>
						<button class="collapsible" >You have only 1 day</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Get your nails done
								</li>
								<li>
									 Have rehearsal
								</li>
								<li>
									 Pack for the dream day
								</li>
								<li>
									 Get a good night sleep
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
				
						<!--on the day-->
						<h2 id="cth">On the day</h2>
						<button class="collapsible" >Finally your dream day</button>
						<div class="content1">
							<ul class="list-item">
								<li>
									 Get a good breakfast
								</li>
								<li>
									 Allow yourself plenty of time to get ready
								</li>
								<li>
									 Give wedding rings and officient fee to best man
								</li>
								<li>
									 Relax, smile and enjoy your dream wedding
								</li>
								<br>
								<br>
							</ul>
						</div>
						<br>
			
					</div>
			
				</div> <!--End of the page-divide-->
			
			</div> <!--End of the checklist-->

			<script>
				var coll = document.getElementsByClassName("collapsible"); <!--Access all the elements in the collapsible class-->
				var i;

				for (i = 0; i < coll.length; i++) 
				{
					coll[i].addEventListener("click", function() <!--Add an event handler to collapsible class-->
					{
  
						this.classList.toggle("active"); <!--Toggle between hide and show-->
						var content1 = this.nextElementSibling; <!--Get the content of content1-->
	
						if (content1.style.maxHeight) 
						{
							content1.style.maxHeight = null;
						}
						else 
						{
							content1.style.maxHeight = content1.scrollHeight + "px"; <!--To return the maximum height of content1-->
						}
	
					}
  
					);
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