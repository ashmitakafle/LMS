<?php
session_start();
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
              font-size: 25px;
              margin-top: 3px;
              line-height: 60px;
            "
          >
            Library Management System
          </h1>
        </div>
        <?php
        if(isset($_SESSION['login_username'])){
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
         
            <li><a style="text-decoration: none" href="index.php">HOME</a></li>
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
           
            <li><a style="text-decoration: none" href="login.php">LOGIN</a></li>
            <li>
              <a style="text-decoration: none" href="registration.php"
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
      </body>
      </html>