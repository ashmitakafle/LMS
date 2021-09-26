<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Student Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />


         <!------------------------Using Bootstrap-------------------------------------------------------------------->  
         <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  </head>
  <body>
        <div class="signup__photo ">
          <br />
          <div class="box2">


            <p style="color: white; margin-left: 120px; font-size: 20px;">
              Please fill up the form below:
            </p>
          

            <form class="registration" name="registration" action="" method="post" enctype="multipart/form-data">
              <input class="form-control"
                type="text"
                name="FirstName"
                placeholder="FirstName"
                required
              /><br>
              <input class="form-control"
                type="text"
                name="LastName"
                placeholder="LastName"
                required
              /><br>
              <input class="form-control"
                type="text"
                name="Username"
                placeholder="Username"
                required
              /><br>
              <input class="form-control"
                type="password"
                name="Password"
                placeholder="Password"
                required
              /><br>
              

              <input class="form-control"
                type="email"
                name="Email"
                placeholder="Email"
                required
              /><br>
              <input class="form-control"
                type="number"
                name="Contact"
                placeholder="Contact"
                required
              /><br>
              <input class="form-control" type="file" name="file"><br>
              <button style="background-color: white" class="btn btn-default" name="submit" type="submit">SignUp</button
              >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button style="background-color: white" class="btn btn-default">
                <a
                  style="text-decoration: none; color: black"
                  href="login.php"
                  >Back</a
                >
              </button>
            </form>
          </div>
        </div>

        <?php
        if(isset($_POST['submit'])){

          move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
          
          $fname=$_POST['FirstName'];
          $lname=$_POST['LastName'];
          $user=$_POST['Username'];
          $pass=$_POST['Password'];
          $email=$_POST['Email'];
          $cont=$_POST['Contact'];
          $img=$_FILES['file']['name'];
          $count=0;
          $q="SELECT `username` FROM `admin`";
          $res=mysqli_query($conn,$q);

          while($row=mysqli_fetch_assoc($res)){
           if($row['username']==$_POST['Username']){
            $count=$count+1;
          }
        }
        
             
         if($count==0){  
          $sql="INSERT INTO `admin`(`id`, `firstname`, `lastname`, `username`, `password`, `email`, `contact`, `pic`) 
          VALUES ('','$fname','$lname','$user','$pass','$email','$cont','$img')";
          $result=mysqli_query($conn,$sql);


         ?>
         <script type ="text/javascript">
          alert("Registered Successfully");
         window.location="../login.php";
         </script>


         <?php
        }

       else{
         ?>
         <script type ="text/javascript">
         alert("Username already exists");
         </script>


         <?php
       }
      }

        ?>
  </body>
</html>
