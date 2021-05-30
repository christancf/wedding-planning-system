<?php
    session_start();
    require 'config.php';
    if(!isset($_SESSION['email']))
    {
        header('location:log-in-say.php');
    }
    // after adding to cart
    if(isset($_SESSION['message']))
    {
        ?>
        <script>alert("<?php echo $_SESSION['message']; ?>")</script>
        <?php
        unset($_SESSION['message']);
    }
    $userID = '';
    if(isset($_GET['user_id']))
    {
        $userID = $_GET['user_id'];
    }
   if(isset($_POST['cartbutton']))
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
                // echo "Added successfully!";
                $_SESSION['message'] = "Added to cart successfully";
                header("location: photography-say.php?user_id=$userID");
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
                <a class="fas fa-shopping-cart" href="cart.html"></a>
                <a class="fas fa-question-circle" href="help.html"></a>            
                <div class="login">
                    <ul>
                        <li><a id="user" href="user-account-say.php?user_id=<?php echo $userID;?>"><i class="fas fa-user-circle"></i></a></li>
                        <div class="in">                                                                    
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>                            
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
                            <li><a href="vendor.html">VENDOR</a></li>
                            <div class="dropdown">
                                <ul>                                                    
                                    <li><a href="overview.html">Overview</a></li>
                                    <li><a href="venue.html">Venues</a></li>
                                    <li><a href="flower.html">Flowers & Decor</a></li>
                                    <li><a href="beauty.html">Beauty & Health</a></li>
                                    <li><a href="bridal.html">Bridal Wear</a></li>
                                    <li><a href="groom.html">Groom Wear</a></li>
                                    <li><a class="active" href="photography-say.php?user_id=<?php echo $userID;?>">Photography</a></li>
                                    <li><a href="catering.html">Catering</a></li>
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
            <div class="page-name"><a href="photography-say.php?user_id=<?php echo $userID;?>">Wedding Photography</a></div>
            <div class="search-bar">     
                    <form class="search-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?user_id=".$_GET['user_id'];?>" method="POST">
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
                        $userID = '';
                        if(isset($_GET['user_id']))
                        {
                            $userID = $_GET['user_id'];
                        }
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
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?user_id=".$_GET['user_id'];?>" method="POST">
                                    <?php
                                    echo            '<h2>'.$row['business_name'].'</h2>';
                                    echo            '<img src="data:image/image;base64,'.base64_encode($row['company_image']).'" width="150" height="150"><br>'; 
                                    echo            '<p>'.$row['description'].'</p><br>';  
                                    echo            '<p>Price: Rs. '.$row['price'].'</p><br>';         
                                    echo            '<input type="hidden" value="'.$row['vendor_ID'].'" name="vendorID">'; 
                                    echo            '<input type="submit" value="Add to Cart" name="cartbutton">';
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
</<html>