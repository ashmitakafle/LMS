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
  </head>

  <style type="text/css">
  .scroll{
    height:310px;
    width:100;
    overflow:auto;
  }
  </style>
  <body>
    <div class="feedback__photo">
      <div class="feedback__container">
        <h1>
          If you have any query and suggestions please comment down below.
        </h1>

        <form class="feedback__form" action="" method="post">
          <input
            class="form-control"
            type="text"
            name="comment"
            placeholder="Comment"
          /><br />
          <button
            style="color: black; background-color: white"
            class="btn btn-default"
            type="submit"
            name="submit"
          >
            Submit
</button>
<br/><br/>
         
     
    
<div class="scroll">
<?php
if(isset($_POST['submit'])){
  if(isset($_SESSION['login_username'])){

  
  $comment=$_POST['comment'];
  $q="INSERT INTO `comments`(`id`, `username`, `comment`) VALUES ('','$_SESSION[login_username]','$comment')";
  $qu=mysqli_query($conn,$q);
  if($qu)
  {
    $sql="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC";
    $res=mysqli_query($conn,$sql);
    echo "<table class='table table-bordered' style='color:white;'>";
    while($row=mysqli_fetch_assoc($res))
    {
      echo "<tr>";
      echo "<td>"; echo $row['username']; echo "</td>";
      echo "<td>"; echo $row['comment']; echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
}

else{
  ?>
<script type="text/javascript">
alert("You must login first");
</script>
  <?php
} 
}

else{
  $sql="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC";
    $res=mysqli_query($conn,$sql);
    echo "<table class='table table-bordered' style='color:white;'>";
    while($row=mysqli_fetch_assoc($res))
    {
      echo "<tr style='background-color:blue;'>";
      echo "<td>"; echo $row['username']; echo "</td>";
      echo "<td>"; echo $row['comment']; echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
}
?>
</div>
</div>
</div>
  </body>
</html>
