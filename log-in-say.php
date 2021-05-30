<?php
    require 'config.php';
    session_start();
    if(isset($_SESSION['email']))
    {
        header('location: entry.php');
    }
    if(isset($_SESSION['status']))
    {
        ?>
        <script>alert("<?php echo $_SESSION['status']; ?>")</script>
        <?php
        unset($_SESSION['status']);
    }
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $pword = $_POST['upassword'];

        $sql = "SELECT * 
                    FROM users
                    WHERE email = '$email'";
        if($result = $con->query($sql))
        {
            if($result->num_rows > 0)
            {
                while($row=$result->fetch_assoc())
                {
                    if(password_verify($pword, $row['user_password']))
                    {
                        //returns true;
                        $_SESSION['email'] = $email;
                        $_SESSION['userID'] = $row['user_id'];
                        if(!empty($_POST['rMe']))
                        {
                            $remember_me = $_POST['rMe'];
                            
                            //setting cookie
                            setcookie('email', $email, time() + 60 * 60);
                            setcookie('password', $pword, time() + 60 * 60);
                        }
                        else
                        {
                            //expiring cookie
                            setcookie('email', $email, time() - 60 * 60);
                            setcookie('password', $pword, time() - 60 * 60);
                        }
                        header('location: entry.php?user_id='.$row['user_id']); 
                    }
                    else
                    {
                        //returns false;
                        echo '<script>alert("Invalid password!")</script>';
                    }
                }
            }
            else
            {
                echo '<script>alert("You do not have an account with us. Please register..")</script>';
            }
        }
        
    $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
    <link rel="stylesheet" type="text/css" href="styles/log-in-say.css">
    <title>Login</title>
</head>
<body>
    <div class="logo">
        <a href="index.php">CUPID's<span>&nbspARROW</span></a>
    </div> 
    <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="login">
            <p class="login-text">Login</p><br>
            <div class="input">
                <input type="email" placeholder="Email" name = "email" required value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email'];}?>">
            </div>
            <div class="input">
                <input type="password" placeholder="Password" name="upassword" required value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];}?>">
            </div>
            <div>
                <label class="text">Remember Me </label>
				<input type="checkbox" name="rMe" id="rMe" ><br><br>
            </div>
            <div class="input">
                <input class="login-button" type="submit" value="Login" name='submit'>
            </div>
            <div class="text">
                <a href = "forgot-your-password-say.php">Forgot your password?</a>
                <br><br>
            </div>
            <div class="text">
                <p>Not a member yet? <a href = "sign-up-say.php">Join now!</a></p>
            </div>
        </form>
    </div>
</body>
</html>