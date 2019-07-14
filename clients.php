<?php
include ("session.php");
include_once("config.php");

?>

<?php
if(isset($_POST['search'])){
   // header("Location:add.php");
 $valueToSearch = $_POST['valueToSearch'];
 echo $valueToSearch; 
 $result = mysqli_query($mysqli, "SELECT * FROM clients JOIN cells ON clients.cell=cells.id JOIN type_of_radio ON clients.radio=type_of_radio.id  WHERE clients.location like'%".$valueToSearch."%' OR cells.cell like '%".$valueToSearch."%' OR clients.client like '%".$valueToSearch."%' OR clients.latitude like '%".$valueToSearch."%' OR clients.longitude like '%".$valueToSearch."%' OR clients.ip like '%".$valueToSearch."%' OR type_of_radio.radio like '%".$valueToSearch."%' OR clients.created_at like '%".$valueToSearch."%'");

}
elseif(isset($_GET['direct'])){
  $valueToSearch = $_GET['cell'];
  echo $valueToSearch;
  // $sql=" SELECT * FROM clients WHERE cell like '%".$valueToSearch."%'";
  // $result = mysqli_query($mysqli,$sql);
  $result = mysqli_query($mysqli, 'SELECT clients.id,clients.location,clients.client,clients.latitude,clients.longitude,clients.ip,type_of_radio.radio,type_of_radio.id,clients.created_at,cells.cell,cells.id FROM clients JOIN cells ON clients.cell=cells.id JOIN type_of_radio ON clients.radio=type_of_radio.id WHERE cells.id ="'.$valueToSearch.'"');

}
else{
  $result = mysqli_query($mysqli, 'SELECT clients.id,clients.location,clients.client,clients.latitude,clients.longitude,clients.ip,type_of_radio.radio,type_of_radio.id, clients.created_at,cells.cell FROM clients JOIN cells ON clients.cell=cells.id JOIN type_of_radio ON clients.cell=type_of_radio.cell_id');

}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Clients</title>

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
            <li><a href="home.php">HOME<span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="clients.php">CLIENTS<span class="sr-only">(current)</span></a></li>
            <li><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
            <li><a href="access_point.php">ACCESS POINT<span class="sr-only">(current)</span></a></li>
            <li><a href="radio_type.php">RADIO TYPE<span class="sr-only">(current)</span></a></li>
            <li><a href="backbone.php">BACKBONE<span class="sr-only">(current)</span></a></li>
          </ul>

          <button class="btn navbar-nav navbar-right">
            <a href="logout.php" class="btn btn-warning">Logout</a>
          </button>

          <form class="navbar-form navbar-right" action="clients.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="valueToSearch" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-primary" name="search">Find</button>
          </form>



        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
  <br>
  <br>
  <br>
  <br>
  <div class = "container">
    <button class="btn  pull-right btn-danger hidden-print" onclick="myFunction()">Print this page</button>

    <script>
      function myFunction() {
        window.print();
      }
    </script>
    <table class = "table table-striped table-hover table-bordered " data-toggle="table">
      <div class="align-center">
        <a class="btn btn-primary hidden-print" href="add.php">Assign New Client</a><hr>
      </div>
      <h2 class="text text-center">LIST OF CLIENTS</h2>
      <tr>
        <th data-field="client" data-sortable="true">Client name</th>
        <th>Location</th>
        <th>Cell location</th>
        <th>Latitude(s)</th>
        <th>Longitude(s)</th>
        <th>IP address</th>
        <th>Radio type</th>
        <th>Created On</th>
        <!-- <th>Updated On</th> -->
        <th class="hidden-print">Actions</th>
      </tr>


      <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
      while($res = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$res['client']."</td>";
        echo "<td>".$res['location']."</td>";
        echo "<td>".$res['cell']."</td>";  
        echo "<td>".$res['latitude']."</td>";
        echo "<td>".$res['longitude']."</td>"; 
        echo "<td>".$res['ip']."</td>";
        echo "<td>".$res['radio']."</td>"; 
        echo "<td>".$res['created_at']."</td>";
      // echo "<td>".$res['updated_at']."</td>";
        echo "<td class='hidden-print'><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";       
      }
      ?>


    </table>
  </div>
  <br>
  <br>
  <nav class="navbar navbar-default navbar-fixed-bottom navbar-center">
   <h5 class="text-center">Noc Habari LTD</h5>
   <p class = "help-block text-center">All rights reserved &copy; <?php echo date("Y"); ?> Habari Node Ltd </p>
 </nav>
</body>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
</html>