<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>  
    <title>Books</title>
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

      .add__form{
             margin-left:550px;
      }

      .form-control{
          height:50px;
          width:400px;

      }
      .btn{
          background-color:white;
          color:black;
      }
      

      .siden:hover{
        background-color:#088b34;
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
         <div class="siden"><a href="addbook.php">Add Books</a></div>
        <div class="siden"><a href="deletebook.php">Delete Books</a></div>
        <div class="siden"><a href="bookrequest.php">Book Request</a></div>
        <div class="siden"><a href="issue.php">Issue Information</a></div>
        <div class="siden"><a href="expired.php">Expired List</a></div>
        <div class="siden"><a href="fine.php">Fines</a></div>
         
         <?php
       
      }

      else{
        ?>
        
        <div class="siden"><a href="profile.php">My Profile</a></div>
        <div class="siden"><a href="addbook.php">Add Books</a></div>
        <div class="siden"><a href="deletebook.php">Delete Books</a></div>
        <div class="siden"><a href="bookrequest.php">Book Request</a></div>
        <div class="siden"><a href="issue.php">Issue Information</a></div>
        <div class="siden"><a href="expired.php">Expired List</a></div>
        <div class="siden"><a href="fine.php">Fines</a></div>
    
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
<div class="add__container">
    <h2 style="text-align:center;color:white;">Add New Books</h2><br>
    <form class="add__form" action="" method="post">
    <input class="form-control" type="text" name="name" placeholder="Book Name" required><br>
    <input class="form-control" type="text" name="authors" placeholder="Authors Name" required><br>
    <input class="form-control" type="text" name="edition" placeholder="Edition" required><br>
    <input class="form-control" type="text" name="status" placeholder="Status" required><br>
    <input class="form-control" type="number" name="quantity" placeholder="Quantity" required><br>
    <input class="form-control" type="text" name="department" placeholder="Department" required><br>
    <button class="btn btn-default" type="submit" name="submit">ADD</button>
    </form>

   </div> 

   <?php
      if(isset($_POST['submit']))
      {
          $name=$_POST['name'];
          $au=$_POST['authors'];
          $ed=$_POST['edition'];
          $st=$_POST['status'];
          $qua=$_POST['quantity'];
          $dep=$_POST['department'];
          if(isset($_SESSION['login_username']))
          {
              $sql="INSERT INTO `books`(`bid`, `name`, `authors`, `edition`, `status`, `quantity`, `department`)
               VALUES ('','$name','$au','$ed','$st','$qua','$dep')";
              $res=mysqli_query($conn,$sql);
              ?>
                 <script type="text/javascript">
                      alert("Book added successfully");
                 </script>
              <?php
          }
          else{
            ?>
            <script type="text/javascript">
                 alert("Please login first");
            </script>
         <?php 
          }
      }
   ?>

    </div>
    </body>
    </html>