<?php
    session_start();
    require("config.php");
    $userID="";
    if(isset($_SESSION["userID"])){
        $userID = $_SESSION["userID"];
    }
    $con->close();           
?>
<!DOCTYPE html>
<html lang="en">
    <head>   
        <title>Overview</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/overview-chr.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>                           
    </head>
    <body>
        <section class="header">
            <div class="topicon">
                <a href="cart-chr.php"><i class="fas fa-shopping-cart"></i></a>        
                <div class="login">
                    <ul>
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
                            <div>
                                <ul class="in">
                                    <li><a href="user-account-say.php">User Account</a></li>
                                    <li><a href="log-out-say.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>    
                </div>    
            </div>                    
            <nav>
                <div class="logo">
                    <a href="index.php">CUPID&apos;s<span>&nbsp;ARROW</span></a>
                </div>                           
                <div class="topnav">
                    <ul>
                        <li><a href="index.php">HOME</a></li>
                        <div class="vendor-cat">
                            <li>VENDOR</li>
                            <div class="dropdown">
                                <ul>                                                    
                                    <li><a href="venue-mal.php">Venues</a></li>
                                    <li><a href="flower-cha.php">Flowers &amp; Decor</a></li>
                                    <li><a href="beauty-cha.php">Beauty &amp; Health</a></li>
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
                        <li><a class="active" href="overview-chr.php">OVERVIEW</a></li>                        
                        <li><a href="checklist-cha.php">CHECKLIST</a></li>
                        <li><a href="contact-cha.php">CONTACT</a></li>             
                    </ul>                    
                </div>                
            </nav>
            <div class="page-name"><a href="#">Overview</a></div>               
        </section>  
        <div class="content">
            <div class="overview">
                <div class="overview_content">                                        
                    <?php
                    require("config.php");
                    $display = "SELECT bride_name, groom_name, guest, budget FROM overview where userID=".$userID;
                    $display_result = $con->query($display);
                    if($display_result !== false && $display_result->num_rows > 0){
                        $row3 = $display_result->fetch_assoc();
                        $readBride = $row3['bride_name'];
                        $readGroom = $row3['groom_name'];
                        $readGuest = $row3['guest'];
                        $readBudget = $row3['budget'];                        
                        echo "Bride Name: ".$readBride."</br>Groom Name: ".$readGroom."</br>";
                        echo "Guest: ".$readGuest."</br>Budget: ".$readBudget;                        
                    }
                    else{
                
                    ?>
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                            <div class="overview_content_in">
                                <h2 class="overview-heading" id="couple">Couple</h2>
                                <input type="text" name="bride" placeholder="Bride's name"></br>
                                <input type="text" name="groom" placeholder="groom's name">
                            </div>
                            <div class="overview_content_in">
                                <h2 class="overview-heading" id="guest">Guest</h2>
                                <input type="number" min="0" name="guest" placeholder="Number of guests">
                            </div>
                            <div class="overview_content_in">
                                <h2 class="overview-heading" id="budget">Budget</h2>                            
                                <input type="number" step="0.01" min="5000" name="budget" placeholder="Your Budget">
                                <input id="confirm1" type="submit" name="confirm1">
                            </div>
                            
                        </form>
                    <?php
                        if(isset($_POST['confirm1'])){
                            $bride = $_POST['bride'];
                            $groom = $_POST['groom'];
                            $guest = $_POST['guest'];
                            $budget = $_POST['budget'];
                            $couple= "INSERT INTO overview(bride_name, groom_name, guest, budget, userID) VALUES('$bride','$groom', '$guest', '$budget', '$userID')";
                            
                    
                            if($con->query($couple)){    
                                echo '<script>
                                            window.location.replace("overview-chr.php")
                                        </script>';
                            }
                            else{
                                echo "Error".$con->error;
                            }
                        }

                    }                                           
                    $con->close();
                    ?>
                </div>
                <div class="overview_content">                                        
                    <h2 class="overview-heading" id="date">Ceremony Date</h2>

                    <?php 
                        require("config.php");
                        $date = "select wedding_date from users where user_id=".$userID;
                        $wedDate = $con->query($date);
                        if($wedDate !== false && $wedDate->num_rows> 0){                
                            $row=$wedDate->fetch_assoc();
                                $weddingDate = $row['wedding_date'];                                
                                echo '<p id="alignwithdate">'.$weddingDate.'</p>';                                                            
                        }
                        $con->close();
                    ?>
                    
                </div>                                                
                <div class="overview_content">                   
                    <div id="selection">
                    <?php                            
                        require("config.php");

                        $display = $con->query("SELECT company_name, category, price FROM cart WHERE user_ID=".$userID);
                        if($display !== false && $display->num_rows > 0){
                           echo '<div class="items">
                                    <h3>List of items you&apos;ve chosen</h3>';
                            while($displayContent = $display->fetch_assoc()){
                                echo "<li>".$displayContent['company_name']." ".$displayContent['category']." ".$displayContent['price']."</li>";
                            }
                            echo '</div>';
                        }
                        else{
                            echo "<p>you haven't selected anything<p>";
                        }
                        $con->close();
                    ?>
                    </div>                    
                </div>
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
                    <p>Cupid&s Arrow is a user-friendly platform built for managing wedding planning tasks, payments and vendors.</p>
                </div>
                <div class="ftlink">
                    <h3>Top links</h3>
                    <ul>
                         <li><a href="user-account-say.php"><i class="fa fa-angle-right"></i>&nbspUser Account</a></li>
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
</html>