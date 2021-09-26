<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>  
    <title>Admin Profile</title>
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

    <style>
      body {
        font-family: "Lato", sans-serif;
        background-color:#0d2628; 
       
      }

     
      .name{
        color:white;
        margin-left:20px;
       
      }
      .siden{
        font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;  
      }
      

      .siden:hover{
        background-color:#088b34;
      }

      .profile__prof{
          height:700px;
          width:550px;
         
          margin-left:450px;
          text-align:center;
      }


  
      

      .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        margin-top:70px;
        background-color:black;
      }

      .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
      }

      .sidenav a:hover {
        color: #f1f1f1;
      }

      .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
      }

      #main {
        transition: margin-left 0.5s;
        padding: 16px;
      }

      @media screen and (max-height: 450px) {
        .sidenav {
          padding-top: 15px;
        }
        .sidenav a {
          font-size: 18px;
        }
      }
    </style>
  </head>
  <body>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
        >&times;</a
      >

      <?php
      if(isset($_SESSION['login_username'])){
        
        echo "<img style='height:150px;width:150px;border-radius:50%;padding:5px;margin-left:20px;' src='images/".$_SESSION['image']."'>";
        ?>
        <div class="name">
          <?php
         echo "Welcome ".$_SESSION['login_username'];
         ?>
         </div>
         <br>
        
      <div class="siden"><a href="profile.php">My Profile</a></div>
     <div class="siden"><a href="books.php">Books</a></div>
     <div class="siden"><a href="bookrequest.php">Book Request</a></div>
     <div class="siden"><a href="issue.php">Issue Information</a></div>
     <div class="siden"><a href="expired.php">Expired List</a></div>
     
     
         
         <?php
       
      }

      else{
        ?>
     <div class="siden"><a href="profile.php">My Profile</a></div>
     <div class="siden"><a href="books.php">Books</a></div>
     <div class="siden"><a href="bookrequest.php">Book Request</a></div>
     <div class="siden"><a href="issue.php">Issue Information</a></div>
     <div class="siden"><a href="expired.php">Expired List</a></div>
     
        <?php
      }

      ?>
    </div>

    <div id="main">
      <span style="font-size: 30px; cursor: pointer;color:white;" onclick="openNav()"
        >&#9776;
      </span>
    

    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
      }
    </script>

    <div class="profile__container">
        <form class="profile" name="profile" action="" method="post">
            <button style="background-color:white;color:black;float:right;margin-right:30px;" class="btn btn-default" type="submit" name="submit">Edit Profile</button>
    </form>
    
 <div class="profile__prof">
 

    <?php
    if(isset($_POST['submit'])){
        ?>
           <script type="text/javascript">
              window.location="edit.php";
           </script>
        <?php
    }
    
      $sql="SELECT * FROM `student` WHERE `username`='$_SESSION[login_username]'";
      $res=mysqli_query($conn,$sql);
     
      ?>
        <h3 style="color:white;font-size:30px;">My Profile </h3>
        <?php
        $row=mysqli_fetch_assoc($res);
        echo "<img style='border-radius:50%;padding:5px;' height=150 width=150 src='images/".$_SESSION['image']."'>";
        ?>
        <div class="name">
          <?php
         echo "Welcome ".$_SESSION['login_username'];
         ?>
         </div>
         <br>
         
 
   <?php
   echo "<b>";
   echo "<table class='table table-bordered' style='color:white;' >";
   echo "<tr>";
   echo "<td>"; echo "ID:"; echo "</td>";
   echo "<td>"; echo $row['id']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "First Name:"; echo "</td>";
   echo "<td>"; echo $row['firstname']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "Last Name:"; echo "</td>";
   echo "<td>"; echo $row['lastname']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "Username:"; echo "</td>";
   echo "<td>"; echo $row['username']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "Password:"; echo "</td>";
   echo "<td>"; echo $row['password']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "RollNo:"; echo "</td>";
   echo "<td>"; echo $row['rollno']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "Email:"; echo "</td>";
   echo "<td>"; echo $row['email']; echo "</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<td>"; echo "Contact:"; echo "</td>";
   echo "<td>"; echo $row['contact']; echo "</td>";
   echo "</tr>";
   echo "</table>";
   echo "</b>";



?>

</div>
    </div>
</div>
  </body>
</html>
