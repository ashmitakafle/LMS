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
           
            <h1 style="font-size: 35px;color:white;margin-top:10px;">Library Management System</h1><br>
 
           
           <br>
            <form  class="login" name="login" action="" method="post">
               <div>
            <b><p style="padding-left: 30px; font-size:25px;font-weight:700; color:yellow">Login As:</p></b><br>
            <input style="margin-left: 50px; width:28px;height: 20px;" type="radio" name="user" id="admin" value="admin">
            <label style="font-size: 20px; font-weight:600;color:white;">Admin</label>
            <input style="margin-left: 50px; width:28px;height:20px;" type="radio" name="user" id="student" value="student"checked>
            <label style="font-size: 20px; font-weight:600;color:white;">Student</label>
               </div>
               <br>
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
            <br><br><br><br><br><br>
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

            if($_POST['user']=='admin')
            {
              $username=$_POST['Username'];
              $pass=$_POST['Password'];
 
              $count=0;
              $sql="SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$pass' AND `status`='yes'";
              $res=mysqli_query($conn,$sql);
              $row=mysqli_fetch_assoc($res);
              $count=mysqli_num_rows($res);
 
              if($count==0){    
                ?>
                <script type="text/javascript">
                alert("Username or password doesnot match");
                </script>
 
                <?php
              }
 
              else{
                $_SESSION['login_username']= $_POST['Username'];
                $_SESSION['image']=$row['pic'];
                ?>
                <script type="text/javascript">
                window.location="admin/profile.php";
                </script>
 
                <?php
              }

            }

            else{
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
               if($row['status']==1){
               $_SESSION['login_username']= $_POST['Username'];
               $_SESSION['image']=$row['pic'];
               ?>
               <script type="text/javascript">
               window.location="student/profile.php";
               </script>

               <?php
               }
               else{
                                ?>
               <script type="text/javascript">
               alert("Please verify your email by OTP before login")
               </script>

               <?php
               }
             }
           }
          }


    ?>
   
  </body>
</html>
