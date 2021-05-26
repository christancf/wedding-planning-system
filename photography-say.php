<?php
    session_start();
    require 'config.php';
    if(isset($_SESSION['message']))
    {
        ?>
        <script>alert("<?php echo $_SESSION['message']; ?>")</script>
        <?php
        unset($_SESSION['message']);
    }
    $userID="";
    if(isset($_SESSION['userID']))
    {
        $userID = $_SESSION['userID'];
    }
    // when 'Add to Cart button is pressed
   if(isset($_POST['cartbutton']))
   {
       if(isset($_SESSION['userID']))   //if user has logged in, add items to cart
       {                                                    
            $vendorID = $_POST['vendorID'];
            $category = "Photography";
            $readFromPhotography = "SELECT *
                                                            FROM photography
                                                            WHERE vendor_ID = '$vendorID'
                                                            LIMIT 1";
            if($readFromPhotographyResults=$con->query($readFromPhotography))
            {
                $info = $readFromPhotographyResults->fetch_assoc();
                $companyName = $info['business_name'];
                $price = $info['price'];

                $addToCart = "INSERT INTO cart(user_ID, vendor_ID, company_name, price, category)
                                        VALUES ('$userID', '$vendorID', '$companyName', '$price', '$category')";
                if($con->query($addToCart))
                {
                    $_SESSION['message'] = "Added to cart successfully";
                    header("location: photography-say.php"); 
                    exit(0);
                }
                else
                {
                    echo "ERROR!! ".$con->error;
                }
            }
            else
            {
                echo "ERROR!! ".$con->error;
            }
        }
        else            //if user has not logged in, informs user to login if need to purchase items
        {
            $_SESSION['message'] = "Please login or register to add items to cart";
            header("location: photography-say.php");
            exit(0);
        }
   }
   $con->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wedding Photography</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/photography-say.css">
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
                        <!-- if user has logged in, go to overview page, else, go to login -->
                        <li><a href="<?php if(isset($_SESSION['userID'])) { ?>overview-chr.php<?php } else { ?>log-in-say.php<?php }?>">OVERVIEW</a></li>                        
                        <li><a href="checklist-cha.php">CHECKLIST</a></li>
                        <li><a href="contact-cha.php">CONTACT</a></li>             
                    </ul>                    
                </div>    
            </nav>        
            <div class="page-name"><a href="photography-say.php">Wedding Photography</a></div>
            <div class="search-bar">     
                <form class="search-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <input class="input" type="text" name="search-text" placeholder="Search Photographer Name" size="50px">
                    <input class="search-button" type="submit" name="search-button" value="Search" size="50px">
                </form>                   
            </div>  
        </section>    
        <div class="content">
            <div class="mybody">
                <div class="mycontent">
                    <?php
                        require 'config.php';
                        // ------page content-------
                        // ------- if search button is pressed---------
                        if(isset($_POST['search-button']))
                        {
                            $searchName = $_POST['search-text'];
                            $search="SELECT *
                                            FROM photography
                                            WHERE business_name LIKE '%$searchName%' ";
                            if($search_result=$con->query($search))     //show results of search
                            {
                                if($search_result->num_rows>0)
                                {
                                    while($search_row=$search_result->fetch_assoc())
                                    {
                                        echo '<div class="selections">';
                                        echo    '<div class="selection'.$search_row['vendor_ID'].'">';
                                        echo    '<table>
                                                        <tr>
                                                        <td class="column1">';
                                        echo        '<div class="grid-image"><img src="data:image/image;base64,'.base64_encode($search_row['company_image']).'" width="150" height="150"></div></td>
                                                        <td class="column2">'; 
                                        echo        '<p class="business">'.$search_row['business_name'].'</p>
                                                        <p>Email Address: '.$search_row['email'].'</p>
                                                        <p>Contact Number: '.$search_row['contact_number'].'</p>
                                                        <p>Website: <a href="'.$search_row['website'].'" target="_blank">'.$search_row['website'].'</a></p>
                                                        </td>
                                                        <td class="column3">
                                                        <button><a href="#modal_out'.$search_row['vendor_ID'].'">Read More</a></button>
                                                        </td>';
                                        echo        '</tr>
                                                    </table>
                                                    </div>';
                                        echo '</div>';
                                    }
                                }
                                else    //show all results if there are no results matching the search
                                {
                                    echo '<center><p class="no-vendor">There are no vendors with that name</center></p>';
                                    $selections = "SELECT *
                                                            FROM photography";
                                    if($selections_result=$con->query($selections))
                                    {
                                        if($selections_result->num_rows>0)
                                        {
                                            while($record=$selections_result->fetch_assoc())
                                            {
                                                echo '<div class="selections">';
                                                echo    '<div class="selection'.$record['vendor_ID'].'">';
                                                echo    '<table>
                                                                <tr>
                                                                <td class="column1">';
                                                echo        '<div class="grid-image"><img src="data:image/image;base64,'.base64_encode($record['company_image']).'" width="150" height="150"></div></td>
                                                                <td class="column2">'; 
                                                echo        '<p class="business">'.$record['business_name'].'</p>
                                                                <p>Email Address: '.$record['email'].'</p>
                                                                <p>Contact Number: '.$record['contact_number'].'</p>
                                                                <p>Website: <a href="'.$record['website'].'" target="_blank">'.$record['website'].'</a></p>
                                                                </td>
                                                                <td class="column3">
                                                                <button><a href="#modal_out'.$record['vendor_ID'].'">Read More</a></button>
                                                                </td>';
                                                echo        '</tr>
                                                            </table>';
                                                echo    '</div>';
                                                echo '</div>';
                                            }
                                        }
                                        else
                                        {
                                            echo "No vendors available!";
                                        }
                                    }
                                    else
                                    {
                                        echo "Error!".$con->error;
                                    }
                                }
                            }
                            else
                            {
                                echo "ERROR!! ".$con->error;
                            }
                        }
                        else    //when page is visited, this is the content seen
                        {
                            $selections = "SELECT *
                                                    FROM photography";
                            if($selections_result=$con->query($selections))
                            {
                                if($selections_result->num_rows>0)
                                {
                                    while($record=$selections_result->fetch_assoc())
                                    {
                                        echo '<div class="selections">';
                                                echo    '<div class="selection'.$record['vendor_ID'].'">';
                                                echo    '<table>
                                                                <tr>
                                                                <td class="column1">';
                                                echo        '<div class="grid-image"><img src="data:image/image;base64,'.base64_encode($record['company_image']).'" width="150" height="150"></div></td>
                                                                <td class="column2">'; 
                                                echo        '<p class="business">'.$record['business_name'].'</p>
                                                                <p>Email Address: '.$record['email'].'</p>
                                                                <p>Contact Number: '.$record['contact_number'].'</p>
                                                                <p>Website: <a href="'.$record['website'].'" target="_blank">'.$record['website'].'</a></p>
                                                                </td>
                                                                <td class="column3">
                                                                <button><a href="#modal_out'.$record['vendor_ID'].'">Read More</a></button>
                                                                </td>';
                                                echo        '</tr>
                                                            </table>';
                                                echo    '</div>';
                                                echo '</div>';
                                    }
                                }
                                else
                                {
                                    echo "No vendors available!";
                                }
                            }
                            else
                            {
                                echo "Error!".$con->error;
                            }
                        }
                        //---------modal content--------- 
                        $options = "SELECT *
                                        FROM photography";
                        if($options_result=$con->query($options))
                        {
                            if($options_result->num_rows>0)
                            {
                                while($row=$options_result->fetch_assoc())
                                {
                                    echo '<div class="modal_out" id="modal_out'.$row['vendor_ID'].'">
                                                <div class="modal_in">
                                                    <a href="#" class="modal_close">&times;</a>';
                                    echo        '<div class="vendor'.$row['vendor_ID'].'" id="vendor'.$row['vendor_ID'].'">';?>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                                    <?php
                                    echo            '<h2>'.$row['business_name'].'</h2>';
                                    echo            '<img src="data:image/image;base64,'.base64_encode($row['company_image']).'" width="150" height="150"><br>'; 
                                    echo            '<p>'.$row['description'].'</p><br>';  
                                    echo            '<p>Price: Rs. '.$row['price'].'</p><br>';         
                                    echo            '<input type="hidden" value="'.$row['vendor_ID'].'" name="vendorID">'; 
                                    echo            '<input type="submit" value="Add to Cart" name="cartbutton" title="You need to be a registered member to add to cart">';
                                    ?>
                                                    </form> 
                                    <?php
                                    echo        '</div>';
                                    echo '  </div>
                                            </div>';
                                }
                            }
                            else
                            {
                                echo "No vendors available!";
                            }
                        }
                        else
                        {
                            echo "Error!".$con->error;
                        }
                        $con->close();
                    ?>
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