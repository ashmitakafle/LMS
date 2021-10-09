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

<?php
 
         $sql="SELECT * FROM `issue_book` WHERE `username`='$_SESSION[login_username]' AND `approve`=''";
         $res=mysqli_query($conn,$sql);
         
         if(mysqli_num_rows($res)==0){
           echo "There is no pending request";
         }

         else{
           ?>
               <form action="" method="POST">
           <?php
          echo "<table class='table table-bordered table-hover'>";
          echo "<tr style='background-color:#6db6b9e6'>";
          echo "<th>"; echo "Select"; echo "</th>";
          echo "<th>"; echo "Book ID"; echo "</th>";
          echo "<th>"; echo "Approve Status"; echo "</th>";
          echo "<th>"; echo "Issue Date"; echo "</th>";
          echo "<th>"; echo "Return Date"; echo "</th>";

      
          
          echo "</tr>";
          $i=0;
         while($row=mysqli_fetch_assoc($res)){
          echo "<tr>";
          ?>
         
         <td><input type="checkbox" name="check[]" value="<?php echo $row["bid"]; ?>"></td>
          <?php
          echo "<td>"; echo $row['bid']; echo "</td>";
          echo "<td>"; echo $row['approve']; echo "</td>";
          echo "<td>"; echo $row['issue']; echo "</td>";
          echo "<td>"; echo $row['returns']; echo "</td>";

      
          echo "</tr>";
      $i++;
         }
      
          echo "</table>";

          ?>
          <br>
          
           <button type="submit" name="delete" class="btn btn-success" onclick="location.reload()">Delete</button>
               </form>
          <?php
         }

?>
    </div>

<?php
         if(isset($_POST['delete'])){
          if(isset($_POST['check'])){
          
          	$checkbox = $_POST['check'];
	          for($i=0;$i<count($checkbox);$i++){
	          $del_id = $checkbox[$i];
             
              mysqli_query($conn, "DELETE FROM `issue_book` WHERE `bid`='$del_id' AND `username`='$_SESSION[login_username]' 
              ORDER BY `bid` ASC LIMIT 1;");

            }
          }
          }
        
      
?>
</div>
  </body>
</html>
