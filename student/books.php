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
      }

      .books__search{
        
        margin-left:1160px;
        text-align:center;
      }
      .books__request{
        margin-left:1200px;
        text-align:center;
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
      <span style="font-size: 30px; cursor: pointer" onclick="openNav()"
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




    <div class="books__search">
      <form class="navbar-form" action="" method="post" name="form">
      <label for="department"><b>Choose a department:</b></label>
        <select name="department">
          <optgroup label="Engineering">
            <option>BE_IT</option>
            <option>BE_CMP</option>
            <option>BE_ELX</option>
            <option>BE_Civil</option>

          </optgroup>
          <optgroup label="Management">
            <option>BBS</option>
            <option>BBA</option>
            </optgroup>
        </select>
        <br>
        <input style="height:40px;width:200px"  type="text" name="search" type="search" placeholder="Search books...." required></input>
        <button style="height:40px; width:40px;background-color:#6db6b9e6;" class="btn btn-default" name="submit" type="submit">
        <i class="fas fa-search" style="color:white;"></i>
        </button>
    </form>
    </div>
<br>
    <div class="books__request">
      <form class="request" action="" method="post" name="form1">

        <input style="height:40px;width:200px"  type="text" name="bid" type="search" placeholder="Book ID" required></input>
        <button style="height:40px; width:80px;background-color:#6db6b9e6;" class="btn btn-default" name="submit1" type="submit1">
        Request
        </button>
    </form>
    </div>

    <h1 style="text-align: center; color: rgb(8, 0, 0); font-size: 25px">
      List Of Books
    </h1>


    <?php
       if(isset($_POST['submit']))
       {
        
         $q="SELECT * FROM `books` WHERE `name` like '%$_POST[search]%' AND `department`='$_POST[department]'";
         $qu=mysqli_query($conn,$q);
         if(mysqli_num_rows($qu)==0){
           echo "Sorry no books found...Try something new.";
         }

         else{
          echo "<table class='table table-bordered table-hover'>";
          echo "<tr style='background-color:#6db6b9e6'>";
          echo "<th>"; echo "Book ID"; echo "</th>";
          echo "<th>"; echo "Book Name"; echo "</th>";
          echo "<th>"; echo "Authors Name"; echo "</th>";
          echo "<th>"; echo "Edition"; echo "</th>";
          echo "<th>"; echo "Status"; echo "</th>";
          echo "<th>"; echo "Quantity"; echo "</th>";
          echo "<th>"; echo "Department"; echo "</th>";
      
          echo "</tr>";
         while($row=mysqli_fetch_assoc($qu)){
          echo "<tr>";
          echo "<td>"; echo $row['bid']; echo "</td>";
          echo "<td>"; echo $row['name']; echo "</td>";
          echo "<td>"; echo $row['authors']; echo "</td>";
          echo "<td>"; echo $row['edition']; echo "</td>";
          echo "<td>"; echo $row['status']; echo "</td>";
          echo "<td>"; echo $row['quantity']; echo "</td>";
          echo "<td>"; echo $row['department']; echo "</td>";
      
          echo "</tr>";
      
         }
      
          echo "</table>";
         }
       }


else{
    $sql="SELECT * FROM `books` ORDER BY `books`.`name` ASC";
    $res=mysqli_query($conn,$sql);

    echo "<table class='table table-bordered table-hover'>";
    echo "<tr style='background-color:#6db6b9e6'>";
    echo "<th>"; echo "Book ID"; echo "</th>";
    echo "<th>"; echo "Book Name"; echo "</th>";
    echo "<th>"; echo "Authors Name"; echo "</th>";
    echo "<th>"; echo "Edition"; echo "</th>";
    echo "<th>"; echo "Status"; echo "</th>";
    echo "<th>"; echo "Quantity"; echo "</th>";
    echo "<th>"; echo "Department"; echo "</th>";

    echo "</tr>";
   while($row=mysqli_fetch_assoc($res)){
    echo "<tr>";
    echo "<td>"; echo $row['bid']; echo "</td>";
    echo "<td>"; echo $row['name']; echo "</td>";
    echo "<td>"; echo $row['authors']; echo "</td>";
    echo "<td>"; echo $row['edition']; echo "</td>";
    echo "<td>"; echo $row['status']; echo "</td>";
    echo "<td>"; echo $row['quantity']; echo "</td>";
    echo "<td>"; echo $row['department']; echo "</td>";

    echo "</tr>";

   }

    echo "</table>";
  }



  if(isset($_POST['submit1'])){
    $bid=$_POST['bid'];
    if(isset($_SESSION['login_username'])){
     $s="SELECT * FROM `books` WHERE `bid`='$_POST[bid]'";
     $sql1=mysqli_query($conn,$s);
      $row1=mysqli_fetch_assoc($sql1);
      $count1=mysqli_num_rows($sql1);
      if($row1['quantity']==0)
      {
        ?>
        <script type="text/javascript">
            alert("Sorry the book which you requested is not available now....Please try few days later.")
        </script>
       <?php
      }
      else{
      if($count1!=0) {
      $a="INSERT INTO `issue_book`(`username`, `bid`, `approve`, `issue`, `returns`)
       VALUES ('$_SESSION[login_username]','$bid','','','')";
      $b=mysqli_query($conn,$a);
      ?>
      <script type="text/javascript">
     
      window.location="books.php";
      </script>

      <?php
      }
    
           else{
            ?>
            <script type="text/javascript">
            alert("This book is not available in the library...Try something new.")
            </script>
      
            <?php
           }
          }
    }

    else{
      ?>
      <script type="text/javascript">
      alert("Please login first...")
      </script>

      <?php
    }
  }
   

?>
</div>
  </body>
</html>
