<!DOCTYPE html>
<html>
    <head>
        <title>Cupid's Arrow</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/transport-chr.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <section class="header">
            <div class="topicon">                
                    <a href="cart-chr.php"><i class="fas fa-shopping-cart"></i></a>
                    <a href="help.html"><i class="fas fa-question-circle"></i></a>            
                    
                    <div class="login">
                        <ul>
                            
                            <div class="in">                                        
                                <li><a href="login.html">Sign in</a></li>
                                <li>|</li>
                                <li><a href="register.html">Sign up</a></li>
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
                        <li><a href="index.html">HOME</a></li>
                        <div class="vendor-cat">
                            <li>VENDOR</li>
                            <div class="dropdown">
                                <ul>                                                                                        
                                    <li><a href="venue.html">Venues</a></li>
                                    <li><a href="flower.html">Flowers & Decor</a></li>
                                    <div class="attire-chr">
                                        <li>Beauty & Attire</li>
                                        <div class="attire-dropdown-chr">
                                            <ul>
                                                <li><a href="beauty.html">Beauty & Health</a></li>
                                                <li><a href="bridal.html">Bridal Wear</a></li>
                                                <li><a href="groom.html">Groom Wear</a></li>
                                            </ul>
                                        </div>
                                    <li><a href="photography.php">Photography</a></li>
                                    <li><a href="catering-nim.php">Catering</a></li>
                                    <li><a href="cake-nim.php">Cake</a></li>
                                    <li><a href="band.html">DJ/Bands</a></li>
                                    <li><a href="#">Transportation</a></li>
                                    <li><a href="stationary-chr.php">Wedding Stationary</a></li>
                                    <li><a href="officiant.html">Officiants</a></li>
                                </ul>
                            </div>
                        </div>
                        <li><a href="gallery.html">GALLERY</a></li>                       
                        <div class="service-chr">
                            <li>SERVICE</li>
                            <div class="service-dropdown-chr">
                                <ul>
                                    <li><a href="overview-chr.php">Overview</a></li>                        
                                    <li><a href="checklist.html">Checklist</a></li>
                                </ul>
                            </div>
                        <div>
                        <li><a href="contact.html">CONTACT</a></li>             
                    </ul>                    
                </div>                
            </nav>
            <div class="search-bar-chr">
                <form method="post">
                    <input type="text" id="search-chr" placeholder="(E.g: Wedding Limos)">
                    <button type="submit"><img src="images/search.png"></button>                    
                </form>
            </div>   
        </section>    
        <div class="content">
			<!--Change ID for every vendor-->  
            <div class="transportation-chr">               
                <div class="transport-table-chr">
                        <div class="display-left">
                                <!--Change images according to your category-->
                                <img id="left-img" src="images/back.jpg">
                                <button onclick="document.getElementById('vendor').style.display='block'" class="myBtn">Read more</button>
                                <div id="vendor" class="category">
                                  <!--Change the class according to your category-->
                                  <div class="transportation-content">
                                    <span onclick="document.getElementById('vendor').style.display='none'" class="close">&times;</span>
                                        <p>Cater me</p>
                                        <h3>Cake</h3>
                                        <p>Rs:3000</p>
                                        <input type="submit" value="+Add">
                                  </div>                                                  
                                </div>
                        </div>                        
                </div>              
            </div>
			
			<div class="transportation-chr">                
                <div class="transport-table-chr">
                        <div class="display-left">
                                <!--Change images according to your category-->
                                <img id="left-img" src="images/back.jpg">
                                <button onclick="document.getElementById('vendor1').style.display='block'" class="myBtn">Read more</button>
                                <div id="vendor1" class="category">
                                  <div class="transportation-content">
                                    <span onclick="document.getElementById('vendor1').style.display='none'" class="close">&times;</span>
                                        <p>Floralx</p>
                                        <h3>Flower</h3>
                                        <p>Rs:5000</p>
                                        <input type="submit" value="+Add">
                                  </div>                                                  
                                </div>
                        </div>                        
                </div>              
            </div>
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
                    <form action="php/subscription.php" method="post">
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
</<html>
