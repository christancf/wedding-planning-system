<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/transport-chr.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--<div id="scrollbar"></div>-->
        <section class="header">
            <div class="topicon">
                <a class="fas fa-shopping-cart" href="cart.html"></a>
                <a class="fas fa-question-circle" href="help.html"></a>            
                <div class="login">
                    <ul>
                        <li><a id="user" href="user.html"><i class="fas fa-user-circle"></i></a></li>
                        <div class="in">                                                                    
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>                            
                        </div>    
                    </ul>    
                </div>    
            </div>                     
            <nav>
                <div class="logo">
                    <a href="index.html">CUPID's<span>&nbspARROW</span></a>
                </div>                           
                <div class="topnav">
                    <ul>
                        <li><a class="active" href="#">HOME</a></li>
                        <div class="vendor-cat">
                            <li><a href="vendor.html">VENDOR</a></li>
                            <div class="dropdown">
                                <ul>                                                    
                                    <li><a href="overview.html">Overview</a></li>
                                    <li><a href="venue.html">Venues</a></li>
                                    <li><a href="flower.html">Flowers & Decor</a></li>
                                    <li><a href="beauty.html">Beauty & Health</a></li>
                                    <li><a href="bridal.html">Bridal Wear</a></li>
                                    <li><a href="groom.html">Groom Wear</a></li>
                                    <li><a href="photography.html">Photography</a></li>
                                    <li><a class="active" href="#">Catering</a></li>
                                    <li><a href="cake.html">Cake</a></li>
                                    <li><a href="band.html">DJ/Bands</a></li>
                                    <li><a href="transportation.html">Transportation</a></li>
                                    <li><a href="invitation.html">Invitation</a></li>
                                    <li><a href="officiant.html">Officiants</a></li>
                                </ul>
                            </div>
                        </div>
                        <li><a href="gallery.html">GALLERY</a></li>                       
                        <li><a href="overview.html">OVERVIEW</a></li>                        
                        <li><a href="checklist.html">CHECKLIST</a></li>
                        <li><a href="contact.html">CONTACT</a></li>             
                    </ul>                    
                </div>                
            </nav> 
			<br><br><br><br><br><br><br><br><br><br><br><br>
			<?php
				require 'config.php';
			?>
			
			<div class="search-bar-chr">
				<form method="post" action="#">
                    			<input type="text" id="search-chr" name="business_name" placeholder="(E.g: Wedding Limos)">
                    			<button type="submit" name="ctd_search"><img src="images/search.png"></button>                    
                		</form>
            		</div>
					
        </section> 
			 
        <div class="content">
<?php
	
	// Dispaly vendors
	$sql= "SELECT * FROM flower";

	if($result=$con->query($sql))
	{

	
		if($result->num_rows > 0)
		{
			
			while($row = $result->fetch_assoc())
			{
						
						
				echo ("<div class=transportation-chr>"); 						
				echo ("<div class=transport-table-chr>");
                        		echo ("<div class=display-left>");                                                              
                            		echo '<img id="left-img" src="data:company_image;base64,'.base64_encode($row['company_image']).'">';
                                	echo ("<button onclick=document.getElementById(".$row['vendor_ID'].").style.display='block' class=myBtn>Read more</button>");
						echo ("<div id=".$row['vendor_ID']." class=category>");
							echo ("<div class=transportation-content>");
							echo ("<span onclick=document.getElementById(".$row['vendor_ID'].").style.display='none' class=close>&times;</span>");
                                        			echo ("<h3>".$row['business_name']."</h3>");
								echo ("<p>".$row['description']."</p>");
								echo ("<p>"."Typcal Price : Rs ".$row['price']."</p>");
                                        			echo ('<form method="post" action="#">');
								echo ('<input type="hidden" name="hidden_ID" value="'.$row['vendor_ID'].'">');
                                        			echo ('<input type="submit" name="btn3" value="+Add">');
								echo ("</form>");
							echo ("</div>");
						echo ("</div>");
					echo ("</div>");								
                               
						
					// Display outside of the modal
					echo ("<div class=display-left>"); 
                                		echo '<img id="left-img1" class=border>';
                                			echo ("<div class=ct>");
								echo ("<h3>".$row['business_name']."</h3>");
								echo ("<p>".$row['description']."</p>");
								echo("<br>");
						echo ("</div>");
                        		echo ("</div>");
				
				echo ("</div>");
				echo ("</div>");
						 
						
				
			}	
			
		}
		
		else
		{
			echo "no results";
		}
		
	}

	// Search the vendors	
	if(isset($_POST["ctd_search"]))
	{
		$business_name = $_POST["business_name"];
		$sql= "SELECT * from flower where business_name LIKE '%$business_name%'";
		if($result=$con->query($sql))
		{
			if($result->num_rows > 0)
			{
			
				while($row = $result->fetch_assoc())
				{
					echo ("<h1>Search Results for $business_name </h1>");
					echo ("<div class=transport-table-chr>");
					
                        		echo ("<div class=display-left>");                                                              
                                	echo '<img id="left-img" src="data:company_image;base64,'.base64_encode($row['company_image']).'">';
                                	echo ("<button onclick=document.getElementById('vendor').style.display='block' class=myBtn>Read more</button>");
                                	echo ("<div id=vendor class=category>");
						echo ("<div class=transportation-content>");
						echo ("<span onclick=document.getElementById('vendor').style.display='none' class=close>&times;</span>");
							echo ("<h3>".$row['business_name']."</h3>");
							echo ("<p>".$row['description']."</p>");
							echo ("<p>".$row['price']."</p>");
							echo ('<form method="post" action="#">');
							echo ('<input type="hidden" name="hidden_ID" value="'.$row['vendor_ID'].'">');
							echo ('<input type="submit" name="btn3" value="+Add">');
							echo ("</form>");
						echo ("</div>");                                                  
                                	echo ("</div>");
					echo ("</div>"); 
				
					echo ("<div class=display-left>"); 
                                		echo '<img id="left-img1" class=border>';
                                		echo ("<div class=ct>");
							echo ("<h3>".$row['business_name']."</h3>");
							echo ("<p>".$row['description']."</p>");
							echo("<br>");
						echo ("</div>");
                        		echo ("</div>");
						
					echo ("</div>");	
				
				}
			
			}
			else
			{
				echo "no results";
			}
		}
	}

	// Insert to cart	
	if(isset($_POST["btn3"]))
	{
		$hidden_ID = $_POST["hidden_ID"];
		$sql= "SELECT vendor_ID,business_name,price from flower where vendor_ID = '$hidden_ID'";
		if($result=$con->query($sql))
		{
			if($result->num_rows > 0)
			{
			
				while($row = $result->fetch_assoc())
				{
					$ctID=$row['vendor_ID'];
					$ctName =$row['business_name'] ;
					$ctPrice=$row['price'] ;
					$ctcategory="Flowers & Decor";
				
					$sql= "INSERT INTO cart(vendor_ID,company_name,price,category)VALUES('$ctID','$ctName','$ctPrice','$ctcategory')";
					if($con->query($sql))
					{
						echo '<script>alert("Success")</script>';
					}
					else
					{
						echo "Error:". $con->error;
					}
				
				
				}
			
			}
			
			else
			{
				echo "no results";
			}
		}

	}
	


	$con->close();

?>



            
            <!--Write your code here-->
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
                    <p>Lorem ipsum magna, vehicula ut scelerisque ornare porta ete</p>
                </div>
                <div class="ftlink">
                    <h3>Top links</h3>
                    <ul>
                        <li><a href="account.html"><i class="fa fa-angle-right"></i>&nbspMy Account</a></li>
                        <li><a href="vendors.html"><i class="fa fa-angle-right"></i>&nbspVendors</a></li>
                        <li><a href="gallery.html"><i class="fa fa-angle-right"></i>&nbspGallery</a></li>
                        <li><a href="service.html"><i class="fa fa-angle-right"></i>&nbspService</a></li>
                        <li><a href="contact.html"><i class="fa fa-angle-right"></i>&nbspContact</a></li>
                        <li><a href="help.html"><i class="fa fa-angle-right"></i>&nbspHelp</a></li>
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
                <h6>&copy&nbsp2021 Cupid's Arrow. All rights reserved.<a href="privacy.html">&nbspPrivacy&nbspPolicy&nbsp&amp;&nbspTerms&nbspof&nbspUsage</a><p>&nbsp|&nbspDesign&nbspby&nbsp</p><p id="group">MLB_01.01_06</p></h6>
            </div>
          </div>
        </footer>
    </body>
