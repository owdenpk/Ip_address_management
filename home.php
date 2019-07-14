<?php 
include('session.php');
include('config.php');

?>

<?php
if(isset($_POST['search'])){
   // header("Location:add.php");
 $valueToSearch = $_POST['valueToSearch'];
 echo $valueToSearch;
 $sql=" SELECT * FROM cells WHERE cell like '%".$valueToSearch."%'";
 $result = mysqli_query($mysqli,$sql);
   // header("Location:clients.php");
   // $result = mysqli_query($mysqli, $sql);
   // $result = mysqli_query($mysqli, "UPDATE clients SET location='$location',cell='$cell',client='$client',latitude='$latitude',longitude='$longitude',ip='$ip',radio='$radio' WHERE id=$id" );
   // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
}
else{
  $result = mysqli_query($mysqli, "SELECT * FROM cells ORDER BY id DESC");
}
?>


<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>NOC HABARI</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet"> 
  <link href="js/bootstrap.js" rel="javascript">
  <style>
  #logo {
    height: 200%;
    width: 70%;
    margin-top: -7px;
    margin-right: -200px;
  }
</style>


</head>


<body>

  <header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand" href = "#"><img id = "logo" src = "node.png"></a>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">HOME<span class="sr-only">(current)</span></a></li>
            <li><a href="clients.php">CLIENTS<span class="sr-only">(current)</span></a></li>
            <li><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
            <li><a href="access_point.php">ACCESS POINT<span class="sr-only">(current)</span></a></li>
            <li><a href="radio_type.php">RADIO TYPE<span class="sr-only">(current)</span></a></li>
            <li><a href="backbone.php">BACKBONE<span class="sr-only">(current)</span></a></li>



          </ul>
          <button class="btn navbar-nav navbar-right">
            <a href="logout.php" class="btn btn-warning">Logout</a>
          </button>

          <form class="navbar-form navbar-right" action="home.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="valueToSearch" placeholder="Search cell">
            </div>
            <button type="submit" class="btn btn-primary" name="search">Find</button>
          </form>

        </div>
      </div>
    </nav>
  </header>
  <br>
  <br>
  <br>
  <br>
  <div class="container">


   <?php
   $sql="SELECT client FROM clients";

   if ($count=mysqli_query($mysqli,$sql))
   {
          // Return the number of rows in result set
    $rowcount=mysqli_num_rows($count);
          //printf("CLIENTS %d",$rowcount);
    echo ' 
    <div class="col-md-6">
    <div class="panel panel-default">
    <div class="panel panel-heading panel-success text-center ">
    <h3>NUMBER OF CLIENTS:</h3>
    </div>
    <div panel panel-body><h4 class="text text-center" style="color:#45b7d9; font-size:40;"> <b>'.$rowcount.'</b></h4></div>
    </div>
    </div>';
          // Free result set
    mysqli_free_result($count);
  }

  mysqli_close($mysqli);
  ?>
  <?php
  include('config.php');
  if ($result1 = mysqli_query($mysqli, "SELECT cell FROM cells")) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result1);
    echo ' 
    <div class="col-md-6">
    <div class="panel panel-warning">
    <div class="panel panel-heading panel-success text-center ">
    <h3>NUMBER OF CELLS:</h3>
    </div>
    <div panel panel-body><h4 class="text text-center" style="color:#45b7d9; font-size:40;"><b>'.$row_cnt.'</b></h4></div>
    </div></div>';

    /* close result set */
    mysqli_free_result($result1);
  }

  /* close connection */
  mysqli_close($mysqli);
  ?>

</div>

<!-- <button type="submit" class="btn btn-default" name="Submit">ADD</button> -->

</div>
<div class="container">
  <div class="row">

   <?php
   while($res = mysqli_fetch_array($result)) { 

    echo '
    <div class="col-sm-3 col-md-6 col-lg-4"><br>
    <a href="clients.php?cell='.$res['id'].'&direct=" class="btn btn-info btn-group btn-lg btn-block btn-huge" > '. $res['cell'].'</a>
    </div>
    ';
  }
  ?>
</div>
</div>

</div>
<br>
<br>
<nav class="navbar navbar-default navbar-fixed-bottom">
 <h5 class="text-center">Noc Habari LTD</h5>
 <p class = "help-block text-center">All rights reserved&copy; <?php echo date("Y"); ?> Habari Node Ltd </p>
</nav>


</body>
</html>

