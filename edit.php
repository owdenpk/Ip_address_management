<?php
// including the database connection file
include_once("config.php");
include('session.php');

if(isset($_POST['update']))
{    

  $id = $_POST['id'];
  $location = $_POST['location'];
  $cell=$_POST['cell'];
  $client=$_POST['client'];
  $latitude=$_POST['latitude'];
  $longitude=$_POST['longitude']; 
  $ip=$_POST['ip'];
  $radio=$_POST['radio'];    
    // checking empty fields
  if(empty($cell) || empty($client) || empty($ip)) {                
    if(empty($cell)) {
      echo "<font color='red'>Cell Location field is empty.</font><br/>";
    }

    if(empty($client)) {
      echo "<font color='red'>Client name field is empty.</font><br/>";
    }

    if(empty($ip)) {
      echo "<font color='red'>IP address field is empty.</font><br/>";
    }

        //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
  } else {    
        //updating the table
    $result = mysqli_query($mysqli, "UPDATE clients SET location='$location',cell='$cell',client='$client',latitude='$latitude',longitude='$longitude',ip='$ip',radio='$radio' WHERE id=$id" );

        //redirectig to the display page. In our case, it is index.php
    header("location: clients.php");
  }
}
?>
<?php


//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, 'SELECT * FROM clients JOIN cells ON clients.cell=cells.id JOIN type_of_radio ON clients.cell=type_of_radio.cell_id WHERE clients.id= '.$id.'');
// $result = mysqli_query($mysqli, "SELECT * FROM clients WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
  $radioid = $res['id'];
  $location=$res['location'];
  $cell=$res['cell'];
  $cellid = $res['cell_id'];
  $client=$res['client'];
  $latitude=$res['latitude'];
  $longitude=$res['longitude']; 
  $ip=$res['ip'];
  $radio=$res['radio'];  
}
?>

<?php  
include_once("config.php");
$cellresult = mysqli_query($mysqli, "SELECT * FROM cells");
$radioresult=mysqli_query($mysqli, "SELECT * FROM type_of_radio");
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
          <li class="active"><a href="clients.php">CLIENTS</a></li>
          <li><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
          <li><a href="access_point.php">ACCESS POINT<span class="sr-only">(current)</span></a></li>
          <li><a href="radio_type.php">RADIO TYPE<span class="sr-only">(current)</span></a></li>
          <li><a href="backbone.php">BACKBONE<span class="sr-only">(current)</span></a></li>
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
        UPDATE CLIENT
      </div>
      <div class="panel panel-body">
        <form action="edit.php" method="post"> 
         <div class = "form-group">
          <div class="row">
            <div class="col-md-6">

             <label>Client name</label>
             <input type="text" class="form-control" name="client" value="<?php echo $client;?>"><br>

             <label>Location</label>
             <input type="text" class="form-control" name="location" value="<?php echo $location;?>"><br>

             <label>Cell location</label>
             <!--<input type="text" class="form-control" name="cell" value="<?php echo $cell;?>"><br>-->
             <select class = "form-control" name = "cell" value="<?php echo $cell;?>" >
               <?php
               echo "<option value=".$cellid.">" .$cell. "</option>";
               
               while($res = mysqli_fetch_array($cellresult)) {
                if($res['id'] != $cellid) {
                  echo "<option value=".$res['id'].">" .$res['cell']. "</option>";
                }
              }
              ?>
            </select><br>

            <label>Latitude</label>
            <input type="text" class="form-control" name="latitude" value="<?php echo $latitude;?>"><br>
          </div>
          <div class="col-md-6">
            <label>Longitude</label>
            <input type="text" class="form-control" name="longitude" value="<?php echo $longitude;?>"><br>

            <label>IP Address</label>
            <input type="text" class="form-control" name="ip" value="<?php echo $ip;?>"><br>

            <label>Radio Type</label>
            <select class = "form-control" name = "radio" >
             <?php
             echo "<option value=".$radioid.">" .$radio. "</option>";
             while($radiores = mysqli_fetch_array($radioresult)) {
              if($radiores['id'] != $radioid) {
               echo "<option value=".$radiores['id'].">" .$radiores['radio']. "</option>";

             } 
           }
           ?>
         </select>
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