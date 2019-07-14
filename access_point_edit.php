<?php
// including the database connection file
include_once("config.php");
include('session.php');

if(isset($_POST['update']))
{    

  $id = $_POST['id'];
  $cell = $_POST['cell'];
  $name=$_POST['name'];    
    // checking empty fields
  if(empty($name)){                
    if(empty($name)) {
      echo "<font color='red'>Cell Location field is empty.</font><br/>";
    }

        //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
  } else {    
        //updating the table
    $result = mysqli_query($mysqli, "UPDATE access_point SET cell_id1='$cell',name='$name', WHERE id=$id" );

        //redirectig to the display page. In our case, it is index.php
    header("location: access_point.php");
  }
}
?>
<?php


//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, 'SELECT * FROM access_point JOIN cells ON access_point.cell_id1=cells.id WHERE access_point.id= '.$id.'');
// $result = mysqli_query($mysqli, "SELECT * FROM clients WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
 $cell=$res['cell'];
 $cellid = $res['cell_id'];
 $name=$res['name'];  
}
?>

<?php  
$cellresult = mysqli_query($mysqli, "SELECT * FROM cells");
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
          <li class="active"><a href="access_point.php">ACCESS POINT<span class="sr-only">(current)</span></a></li>
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
        UPDATE ACCESS POINT
      </div>
      <div class="panel panel-body">
        <form action="access_point_edit.php" method="post"> 
         <div class = "form-group">
          <div class="row">
            <div class="col-md-6">

              <label>Cell Name</label>
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

            <label>Access point name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name;?>"><br>


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