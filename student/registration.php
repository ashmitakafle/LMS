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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style type="text/css">
    input::-webkit-inner-spin-button {
        opacity: 0;
        display: none;
    }
    </style>

</head>

<body>
    <div class="signup__photo ">
        <br />
        <div class="box2">


            <p style="color: white; margin-left: 120px; font-size: 20px;">
                Please fill up the form below:
            </p>


            <form class="registration" name="registration" action="" method="post" enctype="multipart/form-data">
                <input class="form-control" type="text" name="FirstName" placeholder="FirstName" required /><br>
                <input class="form-control" type="text" name="LastName" placeholder="LastName" required /><br>
                <input class="form-control" type="text" name="Username" placeholder="Username" required /><br>
                <input class="form-control" type="password" name="Password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    placeholder="Password" required /><br>

                <input class="form-control"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="2" type="number" name="Rollno" placeholder="RollNo" required /><br>
                <input class="form-control" type="email" name="Email" placeholder="Email" required /><br>
                <input class="form-control"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="10" type="number" name="Contact" placeholder="Contact" required /><br>


                <input class="form-control" type="file" name="file"><br>
                <button style="background-color: white" class="btn btn-default" name="submit"
                    type="submit">SignUp</button>
            </form>
        </div>
    </div>

    <?php
  if (isset($_POST['submit'])) {


    move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $_FILES['file']['name']);

    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $user = $_POST['Username'];
    $pass = $_POST['Password'];

    $roll = $_POST['Rollno'];
    $email = $_POST['Email'];
    $cont = $_POST['Contact'];
    $img = $_FILES['file']['name'];
    $count = 0;
    $q = "SELECT `username` FROM `student`";
    $res = mysqli_query($conn, $q);

    while ($row = mysqli_fetch_assoc($res)) {
      if ($row['username'] == $_POST['Username']) {

        $count = $count + 1;
      }
    }

    $email = $_POST['Email'];

    $result = mysqli_query($conn, "SELECT * FROM `student` where email='" . $email . "';");
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {



      if ($count == 0) {
        $sql = "INSERT INTO `student`(`id`, `firstname`, `lastname`, `username`, `password`, `rollno`, `email`, `status`, `contact`, `pic`) 
          VALUES ('','$fname','$lname','$user','$pass','$roll','$email','0','$cont','$img')";
        $result = mysqli_query($conn, $sql);


        //-----------------------------------------------------------------------FOR OTP CODE-----------------------------------------------//

        $otp = rand(10000, 99999);
        $date = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO `verify`(`username`, `otp`, `re_date`)
           VALUES ('$user','$otp','$date');");

        $message = "Hello " . $user . " your OTP code is: " . $otp . " ";
        $from = "From: ashmitakafle41@gmail.com";
        if (mail($email, "OTP", $message, $from)) {
  ?>
    <script type="text/javascript">
    window.location = "../verify.php";
    </script>


    <?php
        } else {
        ?>
    <script type="text/javascript">
    alert("Please check the otp and try again later.");
    </script>


    <?php
        }


        //----------------------------------------------------------------------------------------------------------------------------------//



      } else {
        ?>
    <script type="text/javascript">
    alert("Username already exists");
    </script>


    <?php
      }
    } else {
      ?>
    <script type="text/javascript">
    alert("Email already exists");
    </script>


    <?php
    }
  }




  ?>
</body>

</html>