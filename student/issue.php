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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
    body {
        font-family: "Lato", sans-serif;
        background-color: #0d2628;
    }

    .approve__form {
        margin-left: 550px;
        color: white;
    }

    .form-control {
        height: 40px;
        width: 400px;
    }

    .name {
        color: white;
        margin-left: 20px;
    }

    .siden {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }


    .siden:hover {
        background-color: #088b34;
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
        margin-top: 70px;
        background-color: black;
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
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <?php
    if (isset($_SESSION['login_username'])) {

      echo "<img style='height:150px;width:150px;border-radius:50%;padding:5px;margin-left:20px;' src='images/" . $_SESSION['image'] . "'>";
    ?>
        <div class="name">
            <?php
        echo "Welcome " . $_SESSION['login_username'];
        ?>
        </div>
        <br>

        <div class="siden"><a href="profile.php">My Profile</a></div>
        <div class="siden"><a href="books.php">Books</a></div>
        <div class="siden"><a href="bookrequest.php">Book Request</a></div>
        <div class="siden"><a href="issue.php">Issue Information</a></div>
        <div class="siden"><a href="expired.php">Expired List</a></div>


        <?php

    } else {
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
        <span style="font-size: 30px; cursor: pointer;color:white;" onclick="openNav()">&#9776;
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

        <div class="issue__container">
            <h2 style="text-align: center; color:white; margin-top:150px;">Information of Borrowed Books</h2>

            <?php
      $c = 0;
      if (isset($_SESSION['login_username'])) {


        //----------------------------TIMER-------------------------------------//
        $ap = "SELECT * FROM `issue_book` WHERE `username`='$_SESSION[login_username]' AND `approve`='Yes' ORDER BY `returns` ASC LIMIT 1";
        $query = mysqli_query($conn, $ap);
        $var4 = mysqli_num_rows($query);
        if ($var4 == 1) {
          $row = mysqli_fetch_assoc($query);
          $t = "SELECT * FROM `timer` WHERE `name`='$_SESSION[login_username]' AND `bid`='$row[bid]'";
          $result = mysqli_query($conn, $t);
          $r = mysqli_fetch_assoc($result);
          $now = strtotime(date("Y-m-d"));
          $returned = strtotime($r['tm']);
          $diffdate = $returned - $now;

          if ($diffdate <= 0) {
            $time = "EXPIRED";
          } else {
            $days = floor($diffdate / (60 * 60 * 24));

            $time = "$days days";
          }





      ?>

            <!--------------------------------------------------TIMER----------------------------------------------------------->
            <script>
            // Set the date we're counting down to
            var countDownDate = new Date("<?php echo $r['tm']; ?>").getTime();

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
                document.getElementById("demo").innerHTML = days + "d" + hours + "h" +
                    minutes + "m" + seconds + "s ";

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
        $sql = "SELECT student.username,rollno, books.bid,name,authors,edition,issue,returns FROM student 
                 INNER JOIN issue_book ON student.username=issue_book.username
                 INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve='YES' AND issue_book.username='$_SESSION[login_username]'
                 ORDER BY issue_book.returns ASC";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) == 0) {
          echo "<h2 style= color:white;font-size:20px;'>";
          echo "There is no pending request.";
          echo "</h2>";
        } else {
          echo "<table class='table table-bordered table-hover' >";
          echo "<tr style='background-color:#6db6b9e6'>";
          echo "<th>";
          echo "Student Username";
          echo "</th>";
          echo "<th>";
          echo "RollNo";
          echo "</th>";
          echo "<th>";
          echo "Book ID";
          echo "</th>";
          echo "<th>";
          echo "Book Name";
          echo "</th>";
          echo "<th>";
          echo "Authors";
          echo "</th>";
          echo "<th>";
          echo "Edition";
          echo "</th>";
          echo "<th>";
          echo "Issue Date";
          echo "</th>";
          echo "<th>";
          echo "Return Date";
          echo "</th>";
          echo "<th>";
          echo "Remaining Days";
          echo "</th>";

          echo "</tr>";
          while ($row = mysqli_fetch_assoc($res)) {
            $d = date("Y-m-d");
            if ($d > $row['returns']) {
              $c = $c + 1;
              $var = '<p style="background-color:red;color:yellow;">EXPIRED</p>';
              $query = "UPDATE `issue_book` SET `approve`='$var' WHERE `returns`='$row[returns]' AND `approve`='Yes' limit $c";
              $result = mysqli_query($conn, $query);
              echo $d . "</br>";
            }
            echo "<tr style='color:white;'>";
            echo "<td>";
            echo $row['username'];
            echo "</td>";
            echo "<td>";
            echo $row['rollno'];
            echo "</td>";
            echo "<td>";
            echo $row['bid'];
            echo "</td>";
            echo "<td>";
            echo $row['name'];
            echo "</td>";
            echo "<td>";
            echo $row['authors'];
            echo "</td>";
            echo "<td>";
            echo $row['edition'];
            echo "</td>";
            echo "<td>";
            echo $row['issue'];
            echo "</td>";
            echo "<td>";
            echo $row['returns'];
            echo "</td>";
            echo "<td style='color:red;'>";
          ?>
            <h6 id="demo"></h6>
            <?php
            echo "</td>";

            echo "</tr>";
          }

          echo "</table>";
        }
      } else {
        ?>
            <script type="text/javascript">
            alert("You must login first");
            </script>
            <?php
      }

      ?>

        </div>

    </div>
</body>

</html>