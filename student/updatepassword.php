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
.update__wrapper{
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
    <div class="update__wrapper">
        <div class="update__form">
        <h1 style="font-size: 25px;color:white;text-align:center;">Change Password</h1>
           <br><br>
</div>
          <form class="update" name="update" action="" method="post">
              <input class="form-control"
                type="text"
                name="Username"
                placeholder="Username"
                required
              />
              <br>
              <input class="form-control"
                type="email"
                name="email"
                placeholder="Enter your email"
                required
              />
              <br />
              <input class="form-control"
                type="text"
                name="Password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                placeholder="New Password"
                required
              />
              <br />
              <button class="btn btn-default"name="submit"type="submit"
                style="
                  background-color: white;
                  height: 35px;
                  width: 70px;
                  font-size: 18px;padding:0px;"
              >
                Update
              </button>
             
            </form>

    </div> 

    <?php
if(isset($_POST['submit'])){
    $user=$_POST['Username'];
   
    $email=$_POST['email'];
    $pass=$_POST['Password'];
    $count=0;
    $sql="SELECT * FROM `student` WHERE `username`='$user' AND `email`='$email'";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    $count=mysqli_num_rows($res);
    if($count==0){
        ?>
           <script type="text/javascript">
            alert("Username and email doesnot match");
           </script>
        <?php
    }
    else{




        
        $q="UPDATE `student` SET `password`='$pass' WHERE `username`='$user' AND `email`='$email'";
        $query=mysqli_query($conn,$q);
        


        //--------------------------------------------------------------------------------------------------//
      

        
        $otp=rand(10000,99999);
        $date=date("Y-m-d");
        mysqli_query($conn, "INSERT INTO `verify`(`username`, `otp`, `re_date`)
         VALUES ('$user','$otp','$date');");

         $message="Hello ".$user." your OTP code is: ".$otp." ";
         $from="From: ashmitakafle41@gmail.com";
         if(mail($email, "OTP", $message, $from)){
          ?>
          <script type ="text/javascript">
          window.location="../reset.php";
          </script>
 
 
          <?php
         }
         else{
          ?>
          <script type ="text/javascript">
          alert("Mail not sent");
          </script>
 
 
          <?php
         
        }

       

        //-----------------------------------------------------------------------------------------------------//
        
        ?>
        <script type="text/javascript">
         alert("Updated Successfully");
        </script>
     <?php
    }
}
    ?>

</body>
</html>
