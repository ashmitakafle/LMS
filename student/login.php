<?php

include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />


    

  <body>
        <div class="login__photo">
          <br />
          <div class="box1">
           
            <h1 style="font-size: 35px;color:white;margin-top:10px;">Library Management System</h1>
 
            <h1 style="font-size: 25px;color:white;margin-top:25px;">User Login Form</h1>
           <br>
            <form  class="login" name="login" action="" method="post">
              <input class="form-control"
                type="text"
                name="Username"
                placeholder="Enter your username"
                required
              />
              <br>
              <input class="form-control"
                type="password"
                name="Password"
                placeholder="Enter your password"
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
                Login
              </button>
             
            </form>
            <br>

            <p style="color: white; margin-left: 50px; font-size: 17px">
              <a style="color: dodger blue; text-decoration: none" href="updatepassword.php"
                >Forgot Password?</a
              >
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              New to this Website?&nbsp;<a
                style="color: dodger blue; text-decoration: none"
                href="registration.php"
                >Create Account</a
              >
            </p>
          </div>
        </div>
     
           <?php
           if(isset($_POST['submit'])){
             $username=$_POST['Username'];
             $pass=$_POST['Password'];

             $count=0;
             $sql="SELECT * FROM `student` WHERE `username`='$username' AND `password`='$pass'";
             $res=mysqli_query($conn,$sql);
             $row=mysqli_fetch_assoc($res);
             $count=mysqli_num_rows($res);

             if($count==0){
               ?>
               <script type="text/javascript">
               alert("Username and password doesnot match");
               </script>

               <?php
             }

             else{

               $_SESSION['login_username']= $_POST['Username'];
               $_SESSION['image']=$row['pic'];
               ?>
               <script type="text/javascript">
               window.location="profile.php";
               </script>

               <?php
             }
           }


    ?>
   
  </body>
</html>
