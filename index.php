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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-----------------------------------------FOR FONTS----------------------------------------------->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>

  <style type="text/css">
    .fa {
      margin: 10px 5px;
      padding: 5px;
      font-size: 20px;
      height: 30px;
      width: 30px;
      text-align: center;

      border-radius: 70%;
    }
    .fa-facebook {
      background-color: white;
      color: #03405d;
    }
    .fa-whatsapp {
      background-color: #08cc49;
      color: white;
    }
    .fa-twitter {
      background-color: #058192;
      color: white;
    }
    .fa-instagram {
      background-color: #ef2385;
      color: white;
    }
    .fa-youtube-play {
      background-color: white;
      color: red;
    }
  </style>
  <body>
    <div class="wrapper">
      <header>
        <div class="logo">
          <img src="images/logo1.jpg" />
          <h1 style="color: white; font-size: 25px">
            Library Management System
          </h1>
        </div>

      <?php
        if(isset($_SESSION['login_username'])){
          ?>
         <nav>
          <ul>
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
        <nav>
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

      <section>
        <div class="img">
          <br />
          <div class="box">
            <br />
            <h1 style="font-size: 35px; color: yellow">Welcome To Library</h1>

            <h1 style="font-size: 22px">Opens at 10:00 am</h1>

            <h1 style="font-size: 22px">Closes at 5:00 pm</h1>
          </div>
        </div>
      </section>

      <footer>
        <div style="margin: 0px 650px">
          <a style="text-decoration: none" href="#" class="fa fa-facebook"></a>
          <a style="text-decoration: none" href="#" class="fa fa-whatsapp"></a>
          <a style="text-decoration: none" href="#" class="fa fa-twitter"></a>
          <a style="text-decoration: none" href="#" class="fa fa-instagram"></a>
          <a
            style="text-decoration: none"
            href="#"
            class="fa fa-youtube-play"
          ></a>
        </div>

        <p style="color: white; text-align: center; font-size: 13px">
          Email:&nbsp asmisa56@gmail.com <br />
          Contact:&nbsp 9814025010
        </p>
      </footer>
    </div>
  </body>
</html>
