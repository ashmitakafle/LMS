<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Verify email</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>

<style type="text/css">
body
{
    background-color:#0d2628;   
}
.verify__wrapper{
    height:400px;
    width:600px;
    background-color:black;
    margin:80px 450px;
  
    color:white;
    
}
.verify__form{
    padding-top:25px;
    
}

.form-control{
    height:40px;
    width:300px;
    text-align:center;
    
}
.verify{
    margin-left:150px;
    
}

</style>

<body>
    <div class="verify__wrapper">
        <div class="verify__form">
        <h2 style="font-size: 30px;color:white;text-align:center;margin-top:70px;">Enter the OTP:-</h2>
           <br><br>
</div>
          <form class="verify" name="verify" action="" method="post">
              <input class="form-control"
                type="text"
                name="otp"
                placeholder="Enter your OTP....."
                required
              />
              <br>

              <button class="btn btn-default"name="submit_verify"type="submit"
                style="
                  background-color: white;
                  height: 35px;
                  width: 70px;
                  font-size: 18px;padding:0px;"
              >
              Verify
              </button>
             
            </form>

    </div> 

    <?php
    $ver1=0;
        if(isset($_POST['submit_verify'])){
            $ver2=mysqli_query($conn, "SELECT * FROM verify;");
            while($row=mysqli_fetch_assoc($ver2)){
                if($_POST['otp']==$row['otp']){
                    mysqli_query($conn, "UPDATE `student` set status='1' where username='$row[username]';");
                    $ver1=$ver1+1;
             
                }
            } 
            if($ver1==1){
          header("location:login.php");
            }
            else{
              echo "Wrong OTP given..Please enter correct OTP";
            }
        }
    ?>

</body>
</html>
