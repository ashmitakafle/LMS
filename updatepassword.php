<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Password</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>

<style type="text/css">
body
{
    background-color:#0d2628;   
}
.signup__wrapper{
    height:400px;
    width:600px;
    background-color:black;
    margin:80px 450px;
  
    color:white;
    
}
.update__form{
    padding-top:25px;
    
}

.form-control{
    height:40px;
    width:300px;
    text-align:center;
    
}
.update{
    margin-left:150px;
}

</style>

<body>
    <div class="signup__wrapper">
       
     

          <form class="signup" name="signup" action="" method="post">
          <div style="text-align: center;">
            <b><p style="padding: 70px; font-size:25px;font-weight:700; color:yellow">Reset Password For:-</p></b>
            <input style="margin-left: 50px; width:28px;height: 20px;" type="radio" name="user" id="admin" value="admin">
            <label style="font-size: 20px; font-weight:600;color:white;">Admin</label>
            <input style="margin-left: 50px; width:28px;height:20px;" type="radio" name="user" id="student" value="student"checked>
            <label style="font-size: 20px; font-weight:600;color:white;">Student</label> 
       </div> 
               <br><br><br>
             <button style="background-color: white; color:black; height:40px;width:60px;text-align:center;font-weight:700;margin-left:200px;" class="btn btn-default" name="submit" type="submit">OK</button>
            </form>

       
    </div> 

    <?php

    if(isset($_POST['submit']))
    {
      if($_POST['user']=='admin')
      {
         ?>
           <script type="text/javascript">
            window.location="admin/updatepassword.php";
           </script>
         <?php
      }
      else{
        ?>
        <script type="text/javascript">
         window.location="student/updatepassword.php";
        </script>
      <?php
      }
    }
    ?>



</body>
</html>
