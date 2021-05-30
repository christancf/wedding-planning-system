<?php
    session_start();
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
    <link rel="stylesheet" type="text/css" href="styles/password-change-say.css">
    <script type="text/javascript" src="scripts/password-change-say.js"></script>
    <title>Reset Password</title>
</head>
<body>
    <div class="content">
        <form action="forgot-your-password-code-say.php" method="POST" class="reset">
            <p class="reset-pw-text">Reset Password</p><br>
            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
            <div class="input">
                    <input type="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" name = "email" readonly>
            </div>
            <div class="input">
                    <input type="password" placeholder="New password" name="newPassword" id="newPassword" title="Password length should be between 8 to 20 characters." minlength=8 maxlength=20 onkeyup="check();" required>
                    <span id="message" class="text"></span>
            </div>
            <div class="input">
                    <input type= "password" placeholder= "Confirm new password" name="confirmPassword" id="confirmPassword" onkeyup="check();" title="This should match the above password." required>
            </div>
            <div class="input">
                <input class="reset-pw-button" type="submit" value="Reset Password" name='resetPassword' id="changePassword" disabled>
            </div>
        </form>
    </div>
</body>
</html>