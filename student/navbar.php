<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Library Management System</title>
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
    <div class="wrapper">
      <header style="height: 70px">
        <div class="logo">
          <h1
            style="
              color: white;
              font-size: 15px;
              margin-top: 3px;
              line-height: 60px;
            "
          >
            Library Management System
          </h1>
        </div>
        <?php
        if(isset($_SESSION['login_username'])){
          //----------------------------TIMER-------------------------------------//
          $ap="SELECT * FROM `issue_book` WHERE `username`='$_SESSION[login_username]' AND `approve`='Yes' ORDER BY `returns` ASC LIMIT 1";
          $query=mysqli_query($conn,$ap);
         $var4= mysqli_num_rows($query);
         if($var4==1)
         {
          $row=mysqli_fetch_assoc($query);
          $t="SELECT * FROM `timer` WHERE `name`='$_SESSION[login_username]' AND `bid`='$row[bid]'";
          $result=mysqli_query($conn,$t);
          $r=mysqli_fetch_assoc($result);
          
          
          
         

      

          ?>

          <!--------------------------------------------------TIMER----------------------------------------------------------->
                          <script>
                        // Set the date we're counting down to
                        var countDownDate = new Date("<?php  echo $r['tm'];?>").getTime();

                        // Update the count down every 1 second
                        var x = setInterval(function() {

                          // Get today's date and time
                          var now = new Date().getTime();

                          // Find the distance between now and the count down date
                          var distance = countDownDate - now;

                          // Time calculations for days, hours, minutes and seconds
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                          // Display the result in the element with id="demo"
                          document.getElementById("demo").innerHTML = days + "d" + hours + "h"
                          + minutes + "m" + seconds + "s ";

                          // If the count down is finished, write some text
                          if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("demo").innerHTML = "EXPIRED";
                          }
                        }, 1000);
                        </script>


          <!---------------------------------------------------------------------------------------------------------------------->
<?php
          }
          ?>


         <nav style="padding-top:3px;">
         
          <ul>
          
          <li><a style="text-decoration:none;" href="">
          <span style="margin-right:500px;">
          <?php
           echo "<img style='height:60px;width:60px;border-radius:50%;padding:5px;' src='images/".$_SESSION['image']."'>";
            echo $_SESSION['login_username'];
          ?>
           </span>
          </a></li>

          <li><p style="color:#ff1503; " id="demo"> </p></li>
          
         
            <li><a style="text-decoration: none" href="index.php">HOME</a></li>
            <li><a style="text-decoration: none" href="books.php">BOOKS</a></li>
            <li><a style="text-decoration: none" href="logout.php">LOGOUT</a></li>
          
            <li>
              <a style="text-decoration: none" href="feedback.php">FEEDBACK</a>
            </li>
            
          </ul>
          
        </nav>

          <?php   
        }
        else{
          ?>
        <nav style="padding-top:3px;">
          <ul>
            <li><a style="text-decoration: none" href="index.php">HOME</a></li>
            <li><a style="text-decoration: none" href="../books.php">BOOKS</a></li>
            <li><a style="text-decoration: none" href="../login.php">LOGIN</a></li>
            <li>
              <a style="text-decoration: none" href="../registration.php"
                >SIGNUP</a
              >
            </li>
            <li>
              <a style="text-decoration: none" href="feedback.php">FEEDBACK</a>
            </li>
          </ul>
        </nav>

<?php
        }
      ?>
      </header>
        
        <?php
     if(isset($_SESSION['login_username']))
     {

      $day=0;
      $expired='<p style="background-color:red;color:yellow;">EXPIRED</p>';
      $sql="SELECT `returns` FROM `issue_book` WHERE `username`='$_SESSION[login_username]' AND `approve`='$expired'";
      $res=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($res))
      {
         $d=strtotime($row['returns']);
         $c=strtotime(date("Y-m-d"));
         $diff=$c-$d;
         if($diff>=0)
         {
           $day=$day+floor($diff/(60*60*24));
           
           
         }
      }
      $_SESSION['day']=$day;
     
     }
        ?>

      </body>
      </html>