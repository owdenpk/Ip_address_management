<?php
session_start();
include('config.php');
if(isset($_POST['login']))
{


  $username=mysqli_real_escape_string($mysqli,$_POST['username']);
  $password=mysqli_real_escape_string($mysqli,$_POST['password']);

  $result = mysqli_query($mysqli,"SELECT * FROM users WHERE username = '$username' AND password = '$password'");
  $c_rows  =  mysqli_num_rows($result);

  if($c_rows>0) { 
    $_SESSION['login_user']=$username;

    header("location:  home.php");
    
  }else{ 
    header("location:  index.php?remark_login=failed");
  }



} 

?>

<html lang="en">
<head>
  <title>Login</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">

</head>
<body>
 <header>
   <nav class="navbar navbar-default">
     <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <h1 class = "navbar-header">WELCOME TO NOC LOGIN PAGE</h1>
        </button>
      </div>
    </div>
  </nav>
</header>

<div class = "container">
  <div class="col-md-8 col-md-offset-4">
    <img src = "node.png">
  </div>
  <div class="col-md-4 col-md-offset-4">



   <div class="panel panel-body" style="background-color: #f2f2ed">
     <?php
     $remarks  =  isset($_GET['remark_login'])  ?  $_GET['remark_login']  :  '';
     if  ($remarks==null  and  $remarks=="")
     {
      echo  '<div class="panel panel-default panel-heading text-center" style="background-color: white"><b>Login  Here</b></div>';
    }
    if  ($remarks=='failed')
    {
      echo  '<div class="panel panel-danger panel-heading text-center" style="background-color: "><b>Login  Failed!,  Invalid  Credentials</b></div>';
    }
    else
     ?>

   <form action="index.php" method="post" name="loginform">
    <label>Username</label><BR>
    <input type="text" class = "form-control" name="username" placeholder="Enter username" field="required"><BR>
    <label>Password</label><BR>
    <input type="password" class = "form-control" name="password" placeholder="Enter password" field="required"><br>
    <input type="submit" class =  "btn btn-info btn-lg btn-primary center-block" value="Login" name="login">
  </form>
</div>

</body>
</html>