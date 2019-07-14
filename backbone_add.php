<?php  
include_once("config.php");
include('session.php');
$cellresult = mysqli_query($mysqli, "SELECT * FROM cells ");
$radioresult=mysqli_query($mysqli, "SELECT * FROM type_of_radio");
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add Data</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="js/bootstrap.js" rel="javascript">
  <link href="js/jquery.min.js" rel="javascript">



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
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href = "home.php"><img id = "logo" src = "node.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="home.php">HOME</a></li>
            <li><a href="clients.php">CLIENTS</a></li>
            <li><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
            <li><a href="access_point.php">ACCESS POINT<span class="sr-only">(current)</span></a></li>
            <li><a href="radio_type.php">RADIO TYPE<span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="backbone.php">BACKBONE<span class="sr-only">(current)</span></a></li>
          </ul>

          <button class="btn navbar-nav navbar-right">
            <a href="logout.php" class="btn btn-warning">Logout</a>
          </button>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
  <br>
  <br>
  <br>
  <br>

  <?php
//including the database connection file
  include_once("config.php");

  if(isset($_POST['Submit'])) {    
    $link_name = $_POST['link_name'];
    $cell_location=$_POST['cell'];
    $ip=$_POST['ip'];
    $ssid=$_POST['ssid'];
    $radio_type=$_POST['radio_type']; 

    if(empty($link_name) || empty($ip) || empty($ssid)) {                
      if(empty($link_name)) {
        echo "<font color='red'>Link name field is empty.</font><br/>";
      }

      if(empty($ip)) {
        echo "<font color='red'>ip field is empty.</font><br/>";
      }

      if(empty($ssid)) {
        echo "<font color='red'>SSID field is empty.</font><br/>";
      }

        //link to the previous page
      echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
      $result = mysqli_query($mysqli, "INSERT INTO backbone(link_name,cell_location,ip,ssid,radio_type) VALUES('$link_name','$cell_location','$ip','$ssid','$radio_type')");
      echo  '<div class="alert alert-success col-md-6 col-md-offset-3 text-center" role="alert ">Client has been added succefully</div>';

    }
  }
  ?>

  <div class = "container">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel panel-heading text-center">
          BACKBONE CELL
        </div>
        <div class="panel panel-body">
          <form action="backbone_add.php" method="post"> 
           <div class = "form-group">
            <div class="row">
              <div class="col-md-6">

                <label>Link name</label> 
                <input type = "text" class = "form-control" placeholder="Add name" name = "link_name" required><br>

                <label>Cell location</label>
                <select class = "form-control" name = "cell" >
                 <?php
                 while($res = mysqli_fetch_array($cellresult)) {
                  echo "<option value=".$res['id'].">" .$res['cell']. "</option>";
                }
                ?>
              </select>

              <br>

              <label>IP address</label> 
              <input type = "text" class = "form-control" placeholder="Add IP" name = "ip" required><br>
            </div>
            <div class="col-md-6">
              <label>SSID</label> 
              <input type = "text" class = "form-control" placeholder="Add ssid" name = "ssid" required><br>

              <label>Radio type</label> 
              <select class = "form-control" name = "radio_type" >
               <?php
               while($resradio = mysqli_fetch_array($radioresult)) {
                echo "<option value=".$resradio['id'].">" .$resradio['radio']. "</option>";
              }
              ?>
            </select>

          </div>



        </div>
        <div class="form-footer">
          <input type="submit" class="btn btn-info btn-lg pull-right" name="Submit" value="Add">

        </div>

      </div>
    </form>



  </div>

</div>

</div> 
</div>
<nav class="navbar navbar-default navbar-fixed-bottom navbar-center">
 <h5 class="text-center">Noc Habari LTD</h5>
 <p class = "help-block text-center">All rights reserved &copy; <?php echo date("Y"); ?> Habari Node Ltd </p>
</nav>
</body>
</html>
