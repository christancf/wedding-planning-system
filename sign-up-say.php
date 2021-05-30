<?php
    require 'config.php';
    session_start();
    if(isset($_SESSION['email']))
    {
        header('location: index.php');
    }
    if(isset($_SESSION['status']))
    {
        ?>
        <script>alert("<?php echo $_SESSION['status']; ?>")</script>
        <?php
        unset($_SESSION['status']);
    }
    if(isset($_POST['create']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $wdate = date('Y-m-d', strtotime($_POST['wdate']));
        $currentDate = date('Y-m-d');
        $upassword = password_hash($_POST['upassword'], PASSWORD_DEFAULT);
        
        if($wdate < $currentDate)
        {
            echo "<script>alert('Please enter a date which is not passed yet.')</script>";
        }
        $check = "SELECT *
                         FROM users
                         WHERE email = '$email'";
        if($result1 = $con->query($check))
        {
            if($result1 ->num_rows > 0)
            {
                echo "<script>alert('Email is already in use. Please enter a new email.')</script>";
            }
        
            else
            {
                if(!empty($_FILES['user_image']['tmp_name']) && file_exists($_FILES['user_image']['tmp_name']))
                {
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES['user_image']['name']);
                    $file_name_to_check_the_ext = $_FILES['user_image']['name'];
                    $file_name = addslashes(file_get_contents($_FILES['user_image']['tmp_name']));
                    $file_type = $_FILES['user_image']['type'];
                    $file_ext = explode('.', $file_name_to_check_the_ext);
                    $file_real_ext = strtolower(end($file_ext));
                    $file_size = $_FILES['user_image']['size'];

                    $allowed_types = array('jpg', 'png', 'jpeg', 'jfif');
                    if(in_array($file_real_ext, $allowed_types))
                    {
                        if($file_size < 10000000)
                        {
                            if(move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file))
                            {
                                $sql1 = "INSERT INTO users(first_name, last_name, email, wedding_date, user_password, user_image)
                                            VALUES('$fname', '$lname', '$email', '$wdate', '$upassword', '$file_name')";
                                if($con->query($sql1))
                                {
                                    $_SESSION['email'] = $email;
                                    $check2 = "SELECT *
                                                    FROM users
                                                    WHERE email = '$email'";
                                    if($result2 = $con->query($check2))
                                    {
                                        if($result2 -> num_rows > 0)
                                        {
                                            while($row=$result2->fetch_assoc())
                                            {
                                                $_SESSION['userID'] = $row['user_id'];
                                                header('location: index.php');           
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    echo "Error: ".$con->error;
                                }
                            }
                        }
                        else
                        {
                            echo "<script>alert('File too large!')</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Sorry! Only JPG, JPEG, PNG, JFIF files are allowed')</script>";
                    }
                }
                else
                {
                    $sql2 = "INSERT INTO users(first_name, last_name, email, wedding_date, user_password)
                                  VALUES('$fname', '$lname', '$email', '$wdate', '$upassword')";
                    if($con->query($sql2))
                    {
                        $_SESSION['email'] = $email;
                        $check2 = "SELECT *
                                           FROM users
                                           WHERE email = '$email'";

                        if($result2 = $con->query($check2))
                        {
                            if($result2 -> num_rows > 0)
                            {
                                while($row=$result2->fetch_assoc())
                                {
                                    $_SESSION['userID'] = $row['user_id'];
                                    header('location: index.php');           
                                }
                            }
                        }
                        else
                        {
                            echo "Error: ".$con->error;
                        }
                    }
                 }
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
    <link rel="stylesheet" href="styles/sign-up-say.css">
    <script type="text/javascript" src="scripts/sign-up-say.js"></script>
    <title>Sign Up</title>
</head>
<body>
<div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="signup" enctype="multipart/form-data">
            <p class="signup-text">Sign Up</p><br>
            <div class="input">
                <label for="user_image" class="profile-picture-text">Click here to choose a profile picture</label>
                <input type="file" name="user_image" id="user_image" class="inputfile"> 
            </div>
            <div class="input">
                <input type="text" placeholder="First Name" name = "fname" required>
            </div>
            <div class="input">
                <input type="text" placeholder="Last Name" name = "lname" required>
            </div>
            <div class="input">
                <input type="email" placeholder="Email" name = "email" required>
            </div>
            <div class="input">
                <input type= "text" name = "wdate" placeholder= "Wedding Date" onfocus= "(this.type='date')" required>
            </div>
            <div class="input">
                <input type="password" placeholder="Password" name="upassword" id="upassword" title="Password length should be between 8 to 20 characters." minlength=8 maxlength=20 required>
                <span id="message" class="text"></span>
            </div>
            <div class="input">
                <input type="password" placeholder="Confirm Password" name="cupassword" id="cupassword" title="This should match the above password." onkeyup="check();" required>
            </div>
            <div class="input">
                <input class="create-button" type="submit" value="Create new account" name="create"' id="create" disabled>
            </div>
            <div class="text">
                <p>Already a member? <a href = "log-in-say.php">Login</a></p>
            </div>
        </form>
    </div>
    <div class="logo">
        <a href="index.php">CUPID's<span>&nbspARROW</span></a>
    </div> 
</body>
</html>