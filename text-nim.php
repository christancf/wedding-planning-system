<!DOCTYPE html>
<html>
  <head>
    <title>IWT</title>
  </head>
  <body>
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      Name:<input type="text" name="txtName">
      <input type="submit" name="btnSubmit" value="Submit">
    </form>
    <?php
      if(isset($_POST["btnSubmit"])) {
        echo "<h1>Hi ".$_POST["txtName"]."</h1>";
      }
     ?>

     <h2>Check Box Test TvT</h2>
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
       <input type="checkbox" name="chkList[]" value="Naruto">Naruto<br>
       <input type="checkbox" name="chkList[]" value="Sasuke">Sasuke<br>
       <input type="checkbox" name="chkList[]" value="Kiba">Kiba<br>
       <button type="submit" name="btnCheck">Submit</button>

     </form>
     <?php
     if(isset($_POST['chkList'])) {
       echo "TEST TvT<hr>";
       if(!empty($_POST['chkList'])){
         foreach ($_POST['chkList'] as $check) {
           echo "checked = $check<br>";
         }
       }
       else{
         echo "Check List is empty";
       }
     }


      ?>
  </body>
</html>
