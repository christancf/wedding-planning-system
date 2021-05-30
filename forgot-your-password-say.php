<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,600;0,700;1,100;1,400&display=swap">
    <link rel="stylesheet" type="text/css" href="styles/forgot-your-password-say.css">
    <title>Forgot your password?</title>
</head>
<body>
    <div class="content">
        <div class="reset-text">
            <p>An email will be sent to you with a link to reset your password</p>
        </div>
        <div>
            <form action="forgot-your-password-code-say.php" method="POST">
                <div class="input">
                    <input type="email" placeholder="Enter your email" name = "email" required>
                </div>
                <div class="input">
                    <center><input class="reset-link-button" type="submit" value="Send reset link" name='reset'></center>
                </div>
            </form>
        </div>
    </div>
</body>
</html>



