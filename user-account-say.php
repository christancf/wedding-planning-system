<?php
    session_start();
    require 'config.php';

    if(!isset($_SESSION['email']))
    {
        header('location:log-in-say.php');
    }

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
    if(isset($_POST['delete_image']))               //delete profile image
    {
        $check_image = "SELECT *
                                    FROM users
                                    WHERE user_ID = '$userID' 
                                    LIMIT 1";
        if($check_image_result=$con->query($check_image))
        {
            if($check_image_result->num_rows>0)
            {
                $row=$check_image_result->fetch_assoc();
                if(!empty($row['user_image']))
                {
                    //removing user profile picture
                    $delete_image = "UPDATE users
                                                 SET user_image = NULL
                                                 WHERE user_id = '$userID' ";
                    if($con->query($delete_image))
                    {
                        $_SESSION['message'] = "Your profile picture was deleted successfully!";
                        header("location: user-account-say.php");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['message'] = "You don't have a profile picture. You can add one! ";
                    header("location: user-account-say.php");
                    exit(0);
                }
            }
        }
    }
    if(isset($_POST['change']))                 //when change details button is pressed
    {
        $firstName = $_POST['newFname'];
        $lastName = $_POST['newLname'];
        $weddingDate = date('Y-m-d', strtotime($_POST['newWdate']));
        $currentDate = date('Y-m-d');
        $email = $_POST['newEmail'];
        $result = 0;

        if(!empty($_FILES))
        {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['change_image']['name']);
            $file_name_to_check_the_ext = $_FILES['change_image']['name'];
            $file_name = addslashes(file_get_contents($_FILES['change_image']['tmp_name']));
            $file_type = $_FILES['change_image']['type'];
            $file_ext = explode('.', $file_name_to_check_the_ext);
            $file_real_ext = strtolower(end($file_ext));
            $file_size = $_FILES['change_image']['size'];

            if(!empty($_FILES['change_image']['name']))
            {
                $allowed_types = array('jpg', 'png', 'jpeg', 'jfif');
                if(in_array($file_real_ext, $allowed_types))
                {
                    if($file_size < 1000000)
                    {
                        if(move_uploaded_file($_FILES['change_image']['tmp_name'], $target_file))
                        {
                            $update_image = "UPDATE users
                                                        SET user_image = '$file_name'
                                                        WHERE user_id = '$userID' ";
                                        
                            if($con->query($update_image))
                            {
                                $result = 5;
                            }
                            else
                            {
                                echo "Error: ".$con->error;
                            }
                        }
                    }
                    else
                    {
                        $_SESSION['message'] = "File too large!";
                        header("location: user-account-say.php");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['message'] = "Sorry! Only JPG, JPEG, PNG, JFIF files are allowed";
                    header("location: user-account-say.php");
                    exit(0);
                }
            }
        }

        if(empty($firstName) && empty($lastName) && $weddingDate ==  '1970-01-01' && empty($email) && empty($file_name_to_check_the_ext))
        {
            $_SESSION['message'] = "Please choose at least one detail to be changed.";
            header("location: user-account-say.php");
            exit(0);
        }
        
        if(!empty($email))
        {
            $check = "SELECT *
                             FROM users
                             WHERE email = '$email'";
            if($result_check = $con->query($check))
            {
                if($result_check ->num_rows > 0)
                {
                    $_SESSION['message'] = "Email is already in use. Please enter a new email.";
                    header("location: user-account-say.php");
                    exit(0);
                }
                else
                {
                    $sql4 = "  UPDATE users 
                                    SET email = '$email'
                                    WHERE user_id = '$userID' ";
                    if($con->query($sql4))
                    {
                        $result = 4;
                    }
                    else
                    {
                        echo "ERROR!! ".$con->error;
                    }
                }
            }
            else
            {
                echo "ERROR!! ".$con->error;
            }
        }
        if ($weddingDate < $currentDate && $weddingDate != '1970-01-01')
        {
            $_SESSION['message'] = "Please choose a date in the future.";
            header("location: user-account-say.php");
            exit(0);
        }
        if(!empty($firstName))
        {
            $sql1 = "   UPDATE users
                            SET first_name = '$firstName'
                            WHERE user_id = '$userID' ";

            if($con->query($sql1))
            {
                $result = 1;
            }
            else
            {
                echo "ERROR!! ".$con->error;
            }
        }
        if(!empty($lastName))
        {
            $sql2 =  " UPDATE users
                            SET last_name = '$lastName'
                            WHERE user_id = '$userID' ";
             if($con->query($sql2))
             {
                $result = 2;
             }
             else
             {
                 echo "ERROR!! ".$con->error;
             }               
        }
        if($weddingDate=='1970-01-01')
        {
            // when date is left empty, it takes the value  '1970-01-01' for some reason.
         }
        if($weddingDate > $currentDate )
        {
            $sql3 =  " UPDATE users 
                            SET wedding_date = '$weddingDate'
                            WHERE user_id = '$userID' ";
            if($con->query($sql3))
            {
                $result = 3;
            }
            else
            {
                echo "ERROR!! ".$con->error;
            }
        }
        if($result = 1  || $result = 2 || $result = 3 || $result = 4 || $result = 5)
        {
            $_SESSION['message'] = "Updated Successfully!";
            header("location: user-account-say.php");
            exit(0);
        }
        $result=0;
    }
    //form 2 - changing password
    if(isset($_POST['changePassword']))
    {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];

        $sql5 = "SELECT *
                      FROM users
                      WHERE user_id = '$userID' ";
        if($result_check_2 = $con->query($sql5))
        {
            if($result_check_2->num_rows>0)
            {
                while($row=$result_check_2->fetch_assoc())
                {
                    if(password_verify($currentPassword, $row['user_password']))
                    {
                        //returns true
                        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $sql6 = "UPDATE users
                                      SET user_password = '$newPasswordHash'
                                      WHERE user_id = '$userID' ";
                        if($con->query($sql6))
                        {
                            echo "<script>alert('Updated Successfully!')</script>"; 
                        }
                        else
                        {
                            echo "Error: ".$con->error;
                        }
                    }
                    else
                    {
                        //returns false
                        echo "<script>alert('Incorrect password entered. Re-enter current password.')</script>";
                    }
                }
            }
        }
    }
    //form 3
    {
        if(isset($_POST['deleteAcc']))
        {
            $currPassword = $_POST['currPassword'];
    
            $sql7 = "SELECT *
                          FROM users
                          WHERE user_id = '$userID' ";
            if($result_check_3 = $con->query($sql7))
            {
                if($result_check_3->num_rows>0)
                {
                    while($row=$result_check_3->fetch_assoc())
                    {
                        if(password_verify($currPassword, $row['user_password']))
                        {
                            //returns true
                            $sql8 = "DELETE
                                          FROM users
                                          WHERE user_id = '$userID' ";
                            if($con->query($sql8))
                            {
                                session_destroy();
                                header('location: sign-up-say.php');
                            }
                            else
                            {
                                echo "Error: ".$con->error;
                            }
                        }
                        else
                        {
                            //returns false
                            echo "<script>alert('Incorrect password entered. Re-enter current password.')</script>";
                        }
                    }
                }
            }
        }
    }
    
    $con->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/user-account-say.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="scripts/user-account-say.js"></script>
        <title>User Account</title>
    </head>
    <body>
        <!--<div id="scrollbar"></div>-->
        <section class="header">
            <div class="topicon">
                <a class="fas fa-shopping-cart" href="cart-chr.php"></a>        
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
            <div class="page-name"><a href="user-account-say.php">User Account Settings</a></div>
        </section>  
        <div class="content">
            <div class="mybody">
                <div class="mycontent">
                    <div class="form1">
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
                                    if(!empty($row['user_image']))
                                    {
                                        echo '<center><img src="data:image/image;base64,'.base64_encode($row['user_image']).'" width="150" height="150" style="border-radius:50%"></center>'; 
                                    }
                                    else
                                    {
                                        ?>
                                        <center> <img src="images/user.png" width="150" height="150"></center>
                                        <?php
                                    }
                                }
                            }
                            $con->close();  
                        ?>
                        <form name="details" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
                            <p class="headings">Change User Details</p>
                            <br>
                            <div class="input">
                                <label for="change_image" class="text">Change your profile picture</label>
                                <input type="file" name="change_image" id="change_image" class="inputfile"> 
                            </div>
                            <div class="input">
                                <input type="text" placeholder="Change First Name" name="newFname" id="newFname">
                            </div>
                            <div class="input">
                                <input type="text" placeholder="Change Last Name" name="newLname">
                            </div>
                            <div class="input">
                                <input type=  "text" placeholder= "MM/DD/YYYY" onfocus= "(this.type='date')" name="newWdate">
                            </div>    
                            <div class="input">
                                <input type="email" placeholder="Change E-mail" name = "newEmail">
                            </div>
                            <div class="input">
                                <input class="change-button" type="submit" value="Change Details" name='change' id="change">
                            </div>
                            <div class="input">
                                <label for="delete_image" class="text">Click here to delete your profile picture</label>
                                <button type="submit" name="delete_image" id="delete_image" class="inputfile" formaction="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> Delete profile picture</button>
                            </div>
                        </form>
                    </div>
                        <div class="form2">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                <p class="headings">Change Password</p>
                                <div class="input">
                                    <input type="password" placeholder="Current Password" name="currentPassword" required>
                                </div>
                                <div class="input">
                                    <input type="password" placeholder="New password" name="newPassword" id="newPassword" title="Password length should be between 8 to 20 characters." minlength=8 maxlength=20 onkeyup="check();" required>
                                    <span id="message" class="text"></span>
                                </div>
                                <div class="input">
                                    <input type= "password" placeholder= "Confirm new password" name="confirmPassword" id="confirmPassword" onkeyup="check();" title="This should match the above password." required>
                                </div>
                                <div class="input">
                                    <input class="change-button" type="submit" value="Change Password" name='changePassword' id="changePassword" disabled>
                                </div>
                            </form>
                        </div>
                        <div class="form3">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                <p class="headings">Delete Account</p>
                                <div class="input">
                                    <input type="password" placeholder="Current Password" name="currPassword" required>
                                </div>
                                <div>
                                    <input type="checkbox" name="deleteBox" id="deleteBox" onclick="enableButton();">
                                    <label class="text">Activate account deletion</label>
                                </div>
                                <br>
                                <div class="input">
                                    <input class="change-button" type="submit" value="Delete Account" name='deleteAcc' id="deleteAcc" disabled>
                                </div>
                            </form>
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
                    <p>Cupid's Arrow is a user-friendly platform built for managing wedding planning tasks, payments and vendors.</p>
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

