<?php
// including the database connection file
include_once("config.php");
include('session.php');

if(isset($_POST['update']))
{    

  $id = $_POST['id'];
  $link_name = $_POST['link_name'];
  $cell_location=$_POST['cell_location'];
  $ip=$_POST['ip'];
  $ssid=$_POST['ssid'];
  $radio_type=$_POST['radio_type'];    
    // checking empty fields
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
        //updating the table
    $result = mysqli_query($mysqli, "UPDATE backbone SET link_name='$link_name',cell_loation='$cell_location',ip='$ip', ssid='$ssid',radio_type='$radio_type' WHERE id=$id" );

        //redirectig to the display page. In our case, it is index.php
    header("location: backbone.php");
  }
}
?>
<?php


//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM backbone WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
  $link_name=$res['link_name'];
  $cell_location=$res['cell_location'];
  $ip=$res['ip'];
  $ssid=$res['ssid'];
  $radio_type=$res['radio_type'];     
}
?>

<?php  
include_once("config.php");
$cellresult = mysqli_query($mysqli, "SELECT * FROM cells ");
$cellresult1=mysqli_query($mysqli, "SELECT * FROM type_of_radio");
?>

<html>
<head>    
  <title>Edit Data</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">

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
<div class = "container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-success">
      <div class="panel panel-heading text-center">
        UPDATE BACKBONE CELL
      </div>
      <div class="panel panel-body">
        <form action="backbone_edit.php" method="post"> 
         <div class = "form-group">
          <div class="row">
            <div class="col-md-6">

              <label>Link name</label>
              <input type="text" class="form-control" name="link_name" value="<?php echo $link_name;?>"><br>

              <label>Cell location</label>
              <!--<input type="text" class="form-control" name="cell" value="<?php echo $cell;?>"><br>-->
              <select class = "form-control" name = "cell" value="<?php echo $cell;?>" >
               <?php
               while($res = mysqli_fetch_array($cellresult)) {
                echo "<option value=".$res['id'].">" .$res['cell']. "</option>";
              }
              ?>
            </select><br>

            <label>IP address</label>
            <input type="text" class="form-control" name="ip" value="<?php echo $ip;?>"><br>
          </div>
          <div class="col-md-6">
            <label>SSID</label>
            <input type="text" class="form-control" name="ssid" value="<?php echo $ssid;?>"><br>

            <label>Radio Type</label>
            <select class = "form-control" name = "cell" >
             <?php
             while($res = mysqli_fetch_array($cellresult1)) {
              echo "<option value=".$res['id'].">" .$res['radio']. "</option>";
            }
            ?>
          </select>
          <br>
        </div>

      </div>
      <div class="form-footer">
        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        <input type="submit" class = "btn btn-info btn-lg pull-right" name="update" value="update">

      </div>

    </div>
  </form> 


</div>

</div>

<nav class="navbar navbar-default navbar-fixed-bottom navbar-center">
 <h5 class="text-center">Noc Habari LTD</h5>
 <p class = "help-block text-center">All rights reserved &copy; <?php echo date("Y"); ?> Habari Node Ltd </p>
</nav>
</body>
</html>