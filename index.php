<?php
  session_start();
  require 'config.php';

  $userID="";
  if(isset($_SESSION['userID']))
  {
      $userID = $_SESSION['userID'];
  }

  if(isset($_POST['btnReview'])){
    if(isset($_SESSION['userID'])){
      header('Location:review-nim.php');
    }
    else{
      $message = 'Please login to leave a comment';
      echo "
        <script>
        alert('$message')
        window.location.replace('log-in-say.php');
        </script>";
    }
  }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cupid's Arrow | Homepage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/common.css">
        <link rel="stylesheet" href="styles/index-nim.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=e560">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap">
        <script src="https://kit.fontawesome.com/37f65abdaa.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/ab07e88f42.js" crossorigin="anonymous"></script>
    </head>
    <body>

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
                        <li><a class="active" href="index.php">HOME</a></li>
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
                        <li><a href="contact-cha.php">CONTACT</a></li>
                    </ul>
                </div>
            </nav>
              <div class="page-desc"><h2>Where CREATIVITY BLENDS with PERFECTION</h2></div>
        </section>
        <div class="content">
          <!-- WELCOME --->
          <section class="section-welcome-nim">
            <div class="welcome-nim">
              <div class="container-nim">
                <div class="heading-nim">
                  <h3>Welcome</h3>
                  <div class="heading-border-nim"><hr></div>
                  <p id="welcome-text-nim">Before two hearts unite in celebration, a lot goes into preparations. Before the love is declared in public, there are many defining moments of choosing and picking.
                    We at Cupid's Arrow, as one of the reputed wedding planners in Sri Lanka will create the dream wedding you have always wished for, without a single detail missing.</p>
                </div>
                  <div class="welcome-content-nim">
                    <div class="welcome-col-l-nim">
                      <img src="images/welcome1-nim.jpg" alt="welcome iamge">
                    </div>
                    <div class="welcome-col-r-nim">
                      <p>It’s not easy turning your dream wedding into a reality. With today’s hectic lifestyle, many couples and their families do not have time for the detailed planning and work a beautiful wedding of their dream.</p><br>
                      <p>We at Cupid's Arrow, as the pioneers in Sri Lanka wedding planning work together with you at any stage of the planning process to ensure that your wedding is planned to a perfect, totally enjoyable, stress free and memorable one. After all, it is your wedding. We are there to help you – and to make your day perfect.</p><br>
                      <p>Our counseling alone would provide you the crème de la crème of the industry specialists within your stipulated options and budget. We will give you the freedom and peace of mind to simply enjoy your magnificent day in complete bliss.</p><br>
                    </div>
                  </div>
              </div>
            </div>
          </section>
          <!-- WHY CHOOSE US -->
          <section class="choose-nim">
            <div class="why-choose-nim">
              <div class="container-nim">
                <div class="heading-nim">
                  <h3>Why Choose Us</h3>
                  <div class="heading-border-nim"><hr></div>
                </div>
                <div class="why-choose-content-nim">
                  <div class="col-1-nim">
                    <div class="row-1-nim">
                      <div class="why-choose-text-1-nim">
                        <h4>Vendor Search</h4>
                        <p>The big day becomes significant with the vendors. Our search tools will assist you in finding the best wedding vendors on this planet.</p>
                      </div>
                      <div class="why-choose-icon-nim">
                        <i class="fas fa-shipping-fast"></i>
                      </div>
                    </div>
                    <div class="row-1-nim">
                      <div class="why-choose-text-1-nim">
                        <h4>Checklist</h4>
                        <p>Keep track of all the tasks leading up to the big day!</p>
                      </div>
                      <div class="why-choose-icon-nim">
                        <i class="fas fa-list-alt"></i>
                      </div>
                    </div>
                    <div class="row-1-nim">
                      <div class="why-choose-text-1-nim">
                        <h4>Customer Service</h4>
                        <p>A dedicated team to provide you the best service.</p>
                      </div>
                      <div class="why-choose-icon-nim">
                        <i class="fas fa-hands-helping"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-1-nim">
                    <div class="why-choose-img-nim">

                      <img src="images/why-choose.jpg" alt="cake">
                    </div>
                  </div>
                  <div class="col-1-nim">
                    <div class="row-1-nim">
                      <div class="why-choose-icon-nim">
                        <i class="fas fa-hotel"></i>
                      </div>
                      <div class="why-choose-text-2-nim">
                        <h4>Venue Organization</h4>
                        <p>Search for the best venues and vendors, record information about them, book your top picks. No hassle for keeping your ceremony organized.</p>
                      </div>
                    </div>
                    <div class="row-1-nim">
                      <div class="why-choose-icon-nim">
                        <i class="fas fa-envelope-open-text"></i>
                      </div>
                      <div class="why-choose-text-2-nim">
                        <h4>Invitations</h4>
                        <p>Delight your guests with gorgeous wedding invitations!</p>
                      </div>
                    </div>
                    <div class="row-1-nim">
                      <div class="why-choose-icon-nim">
                        <i class="fas fa-money-bill-wave"></i>
                      </div>
                      <div class="why-choose-text-2-nim">
                        <h4>Free</h4>
                        <p>We offer free, easy-to-use wedding planning website.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!--  POPULAR SERVICES  -->
          <section class="section-popular-services-nim">
            <div class="popular-services-nim">
              <div class="container-nim">
                <div class="heading-nim">
                  <h3>Popular Services</h3>
                  <div class="heading-border-nim"><hr></div>
                </div>
                <div class="popular-services-content-nim">
                  <div onclick="location.href='venue-mal.php'" class="popular-services-col-nim">
                    <i class="fas fa-hotel"></i>
                    <h4>Venue</h4>
                    <p>Browsing wedding venues is among the very first steps of planning your big day.</p>
                  </div>
                  <div onclick="location.href='catering-nim.php'" class="popular-services-col-nim">
                    <i class="fas fa-concierge-bell"></i>
                    <h4>Catering</h4>
                    <p>Wedding caterers have an important role to play—making sure the food and drink are top notch on your big day!</p>
                  </div>
                  <div onclick="location.href='photography-say.php'" class="popular-services-col-nim">
                    <i class="fas fa-camera"></i>
                    <h4>Photography</h4>
                    <p>Finding a wedding photographer is not only about choosing a pro who takes great pictures.</p>
                  </div>
                  <div onclick="location.href='invitation-chr.php'" class="popular-services-col-nim">
                    <i class="fas fa-envelope-open-text"></i>
                    <h4>Invitation</h4>
                    <p>Your wedding invitation is the first glimpse your guests will see of your wedding’s theme and style—so choose wisely!</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- TESTIMONIALS -->


          <section class="section-testimonials-nim">
            <div class="testimonials-nim">
              <div class="container-nim">
                <div class="heading-nim">
                  <h3>Testimonials</h3>
                  <div class="heading-border-nim"><hr></div>
                  <p id="testimonial-text-nim">When it comes to the long registry of weddings that we helped craft as professional event planners in Sri Lanka, some of them stand out and are a little more extra special than others. It is a mixture of joy that ruled the air and the happiness of seeing a dream coming true that led these proud couples to leave a word behind, as a token of gratitude and a line of assurance to someone else who comes seeking our services.</p>
                </div>
                <div class="testimonials-content-nim">
                  <?php
                      require 'config.php';
                      $feedback = 'SELECT feedback.feedback_content, users.first_name, users.last_name FROM feedback INNER JOIN users ON feedback.user_id = users.user_id LIMIT 2';
                      $f_result = $con->query($feedback);

                    if($f_result !== false && $f_result->num_rows > 0){
                      while($row = $f_result->fetch_assoc()){
                            echo '<div class="testimonials-col-nim">';
                              //echo '<img src="data:image/image;base64,'.base64_encode($row['user_image']).'">';
                              echo '<div class="testimonials-text-nim">';
                                echo '<p>'.$row['feedback_content'].'</p>';
                                echo '<h3>'.$row['first_name'].' '.$row['last_name'].'</h3>';
                              echo '</div>';
                            echo '</div>';
                        }
                      }
                      else{
                        echo "no results";
                      }
                      $con->close();
                  ?>
                </div>
                  <form class="comment" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                      <button name="btnReview" id="btnReview">Leave a comment</button>
                  </form>
              </div>
            </div>
          </section>

          <div class="overlay-nim" id class="active"></div>
              <div class="social">
                  <a id="fb" href="#facebook"><i class="fab fa-facebook"></i></a>
                  <a id="tw" href="#twitter"><i class="fab fa-twitter"></i></a>
                  <a id="pin" href="#pinterest"><i class="fab fa-pinterest"></i></a>
                  <a id="ig" href="#instagram"><i class="fab fa-instagram"></i></a>
              </div>
        </div>

        <!--  FOOTER  -->

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
