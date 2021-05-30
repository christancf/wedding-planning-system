<?php
    session_start();
    require 'config.php';
    if(!isset($_SESSION['email']))
    {
        header('location:log-in-say.php');
    }
    $email = $_SESSION['email'];
    $sql = "SELECT * 
                FROM users
                WHERE email = '$email'";

     echo '<h1>Welcome '.$_SESSION['email'].'</h1>';
     echo '<p><a href = "log-out.php">Logout</a></p>';
    if($result = $con->query($sql))
    {   
        if($result->num_rows > 0)
        {
            while($row=$result->fetch_assoc())
            {
                // echo "<h3><a href=test.php?user_id=$row[user_id]'>User Account Page</a></h3>";
                echo "<h3><a href='user-account-say.php?user_id=$row[user_id]'>User Account Page</a></h3>";
                echo "<h3><a href='photography-say.php?user_id=$row[user_id]'>Photography Page</a></h3>";
                // if(!empty($row['user_image']))
                // {
                //     echo '<img src="data:image/image;base64,'.base64_encode($row['user_image']).'">';
                //     // data:image/png;base64
                // }
            }
        }
    }
?>