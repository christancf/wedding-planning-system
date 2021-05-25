<?php
    session_start();
    require 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    if(isset($_POST['reset']))
    {
        $email = $_POST['email'];
        $token = md5(rand());       //generate random number/letters
        $check_email = "SELECT * 
                                    FROM users
                                    WHERE email = '$email' 
                                    LIMIT 1";

        if($check_email_result=$con->query($check_email))
        {
            if($check_email_result->num_rows>0)
            {
                $row = $check_email_result->fetch_assoc();
                $fname = $row['first_name'];
                $dbemail = $row['email'];

                function send_password_reset($fname, $dbemail, $token)
                {
                    $mail = new PHPMailer(true);
            
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                    $mail->SMTPDebug = 0;   //0 = off                       //Enable verbose debug output
            
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->Username = 'cupidsarrowps@gmail.com';                     //SMTP username
                    $mail->Password = 'MLB_01.01_06';                               //SMTP password
            
                    $mail->SMTPSecure = 'tls'; 
                    $mail->Port = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                    $mail->setFrom('cupidsarrowps@gmail.com', "Cupid's Arrow");
                    //Recipients
                    
                    $mail->addAddress($dbemail);     //Add a recipient
            
                    $mail->isHTML(true);
                    $mail->Subject = "Reset Password Notification";
            
                    $email_template = "
                        <h2 style='font-family:Comic Sans MS;'>Hi ".$fname."</h2>
                        <h3 style='font-family:Comic Sans MS;'>We received a password reset request from your account.</h3>
                        <a href='http://localhost/wedding-planning-system/password-change-say.php?token=$token&email=$dbemail' style='font-family:Comic Sans MS;'>Click here to reset your password.</a>
                    ";

                    $mail->Body = $email_template;
                    $mail->send();
                }

                $update_token = "UPDATE users 
                                             SET verify_token='$token'
                                             WHERE email = '$dbemail'
                                             LIMIT 1 ";
                if($con->query($update_token))
                {
                    send_password_reset($fname, $dbemail, $token);

                    $_SESSION['status'] = "A password reset link has been sent. Please check your emails.";
                    header('Location: log-in-say.php');
                    exit(0);
                }
                else
                {
                    $_SESSION['status'] = "Something went wrong. Try again!";
                    header('Location: forgot-your-password-say.php');
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "You are not a registered member, please register with us.";
                header('Location: sign-up-say.php');
                exit(0);
            }
        }
        else
        {
            echo "Error!! ".$con->error;
        }
    }

    if(isset($_POST['resetPassword']))
    {
        $email = $_POST['email'];
        $new_password = $_POST['newPassword'];
        $confirm_password = $_POST['confirmPassword'];

        $token = $_POST['password_token'];

        if(!empty($token))
        {
            //checking whether token is valid
            $check_token = "SELECT verify_token
                                        FROM users
                                        WHERE verify_token = '$token' 
                                        LIMIT 1";

            if($check_token_result=$con->query($check_token))
            {
                if($check_token_result->num_rows>0)
                {
                    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $update_password = "UPDATE users 
                                                        SET user_password='$new_password_hash'
                                                        WHERE verify_token = '$token'
                                                        LIMIT 1 ";
                    if($con->query($update_password))
                    {
                        $new_token = md5(rand());
                        $update_new_token = "UPDATE users 
                                                              SET verify_token='$new_token'
                                                              WHERE verify_token = '$token'
                                                              LIMIT 1 ";
                        $con->query($update_new_token);
                        
                        $_SESSION['status'] = "New password updated successfully!";
                        header('Location: log-in-say.php');
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status'] = "Could not update password. Something went wrong!";
                        header("Location: password-change-say.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['status'] = "Invalid token!";
                    header("Location: password-change-say.php?token=$token&email=$email");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "Error! ".$con->error;
                header('Location: password-change-say.php');
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "No token available!";
            header('Location: password-change-say.php');
            exit(0);
        }
    }

?>
