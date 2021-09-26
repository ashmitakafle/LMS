<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html>
  <head>  
    <title>Edit Profile</title>
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
<style type="text/css">
body{
    font-family: "Lato", sans-serif;
    background-color:#0d2628; 
    height:800px;
  
}

.edit__profile{
 font-size:20px;
 color:white;
 margin-left:600px;
}
.edit{
    color:white;
    margin-left:500px;
   
}
.form-control{
    width:400px;
   
}
</style>

<body>
    
    <h2 style="color:white;margin-left:600px;"><u>Edit Your Profile</u></h2><br>


<?php
$sql="SELECT * FROM admin WHERE username='$_SESSION[login_username]'";
$result=mysqli_query($conn,$sql) or die (mysql_error());
while($row=mysqli_fetch_assoc($result))
{
    $fname=$row['firstname'];
    $lname=$row['lastname'];
    $user=$row['username'];
    $pass=$row['password']; 
    $email=$row['email'];
    $cont=$row['contact'];
    $f=$row['pic'];
  
}
?>
<div class="edit__profile">
<?php
 echo "Welcome " .$_SESSION['login_username'];
?>
</div>
<br>

<div class="edit__container">
  <form class="edit" name="edit" action="" method="post" enctype="multipart/form-data">
      <label>First Name:</label>
      <input class="form-control" type="text" name="firstname" value="<?php echo $fname ?>">

      <label>Last Name:</label>
      <input class="form-control" type="text" name="lastname" value="<?php echo $lname ?>">

      <label>Username:</label>
      <input class="form-control" type="text" name="username" value="<?php echo $user ?>">

      <label>Password:</label>
      <input class="form-control" type="text" name="password" value="<?php echo $pass ?>">



      <label>Email:</label>
      <input class="form-control" type="email" name="email" value="<?php echo $email ?>">

      <label>Contact:</label>
      <input class="form-control" type="number" name="contact" value="<?php echo $cont ?>"><br>
 
      <input class="form-control" type="file" name="file" value="<?php echo $f ?>"><br>
      <button class="btn btn-default" style="background-color:white;color:black;" type="submit" name="submit">Save</button>
</form>

</div>  


<?php
if(isset($_POST['submit'])){
    move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $email=$_POST['email'];
    $cont=$_POST['contact'];
    $pic=$_FILES['file']['name'];

    $q="UPDATE `admin` SET `firstname`='$fname',`lastname`='$lname',`username`='$user',`password`='$pass',
    `email`='$email',`contact`='$cont',`pic`='$pic' WHERE `username`='".$_SESSION['login_username']."'";
    $res=mysqli_query($conn,$q);
    if($res)
    {
        ?>
            <script type="text/javascript">
            alert("Saved Successfully");
            window.location="profile.php";
            </script>
        <?php
    }
}

?>

</body>
</html>