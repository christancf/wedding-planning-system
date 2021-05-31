<?php
    require ("config.php");
    session_start();
    $userID="";
    if(isset($_SESSION["userID"])){
        $userID = $_SESSION["userID"];
    }
    $con->close();
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cupid&apos;s Arrow</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/cart-chr.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>        
    </head>
    <body>
        <section class="header">
            <div class="topicon">
                <a href="#"><i class="fas fa-cart-arrow-down"></i></a>        
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
                                    <li><a class="active" href="photography-say.php">Photography</a></li>
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
                        <li><a href="overview-chr.php">OVERVIEW</a></li>                        
                        <li><a href="checklist-cha.php">CHECKLIST</a></li>
                        <li><a href="contact-cha.php">CONTACT</a></li>             
                    </ul>                    
                </div>                
            </nav>
            <div class="page-name"><a href="#">My Cart</a></div>               
        </section>  
        <div class="content">       
            <div class="cart-chr">                               
                <div class="cart-vendor-chr">
                    <?php 
                        require("config.php");                        

                        $result = $con->query("select * from cart where user_ID=".$userID);
                        $total = 0;
                        $_SESSION['payAmount'] = $total;
                        if($result !== false && $result->num_rows > 0){         
                            echo    '<table border=1>                        
                                        <th>Vendor</th>
                                        <th>Category</th>
                                        <th>Price</th>';                   
                            while($row=$result->fetch_assoc()){
                                echo    '<tr><td>'
                                            .$row["company_name"].
                                        '</td>
                                        <td>'
                                            .$row["category"].
                                        '</td>
                                         <td>'
                                            .$row["price"].
                                         '</td></tr>';
                     ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                    <?php
                                echo    '<tr style=border:none;>
                                            <td>
                                                <input type="hidden" value="'.$row["cart_ID"].'" name="cartID">
                                                <input type="submit" value="Remove" name="remove" onclick="count()"></td></tr>';
                    ?>
                        </form>
                    <?php
                               $total += $row["price"];
                            }
                            echo '</table>';
                        }
                        else{
                            echo '<h4>No Item</h4>';
                        }
                        
                        $budget = $con->query("SELECT budget FROM overview WHERE userID=".$userID);

                        if($budget !== false && $budget->num_rows > 0){
                            $row4 = $budget->fetch_assoc();
                            $Budget = $row4['budget'];
                            if($total == $Budget){
                            ?>
                                <script>alert("You have reached your budget")</script>
                            <?php
                            }
                            else if($total > $Budget){
                            ?>
                                <script>
                                    var a = alert("You have exceeded the budget limit")                                                                                                               
                                </script>
                            <?php
                            }
                        }                              
                        $con->close();
                    ?>
                    <?php
                       require("config.php");                      
                       if(isset($_POST['remove'])){
                           $cart = $_POST["cartID"];
                           $sql = 'delete from cart where cart_ID='.$cart;
                           if ($con->query($sql) === TRUE) {
                               ?><script>window.location.replace('cart-chr.php')</script><?php
                           }                                                    
                       }
                       $con->close();
                    ?>
                    
                </div>                            
                <div class="subtotal-chr">
                    <ul>                        
                        <li>Subtotal:<?php echo " Rs. ".$total ?></li>
                    </ul>                    
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                    <input type="submit" name="checkout" value="Proceed to Checkout">
                    <input type="submit" name="clear" value="Clear Cart">
                    </form>
                    <?php
                        require("config.php");
                        if(isset($_POST['checkout'])){                             
                            if($total === 0){
                    ?>          
                                <script>
                                    alert("Add items to the cart")
                                    window.location.replace('cart-chr.php')
                                </script>
                    <?php
                            }
                                                                                   
                            $category = array("Venue", "Transportation", "Photography", "Officiant", "DJ", "Flower", "Bridal", "Groom", "Beauty", "Invitation", "Cake", "Catering");

                            $i = 0;
                            for($i; $i < 12; ++$i){

                                $categoryCheck = $con->query("SELECT category, COUNT(category) FROM cart WHERE user_ID=".$userID." AND category LIKE '".$category[$i]."%' HAVING COUNT(category) > 1");

                                if($categoryCheck !== false && $categoryCheck->num_rows > 0){
                                    $categoryDisplay = $categoryCheck->fetch_assoc();                                        
                    ?>
                                        <script>
                                            alert("You can select only one item in a specific category")
                                            window.location.replace('cart-chr.php')
                                        </script>
                    <?php                                                                        
                                }                     
                            }

                    ?>
                            <script>window.location.replace('payment-address-nim.php')</script>
                    <?php
                        }
                        if(isset($_POST['clear'])){
                            $clearCart = $con->query("DELETE FROM cart WHERE user_ID=".$userID);
                    ?>      <script>
                                window.location.replace("cart-chr.php")
                            </script>
                    <?php
                        }
                        $con->close();
                    ?>                    
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
                    <p>Cupid&apos;s Arrow is a user-friendly platform built for managing wedding planning tasks, payments and vendors.</p>
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
</<html>

