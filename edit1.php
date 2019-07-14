<?php
// including the database connection file
include_once("config.php");
include('session.php');

if(isset($_POST['update']))
{     
	$id = $_POST['id'];
	$cell = $_POST['cell'];   



    // checking empty fields
	if(empty($cell)) {  

		echo "string";    
		echo "<font color='red'>Cell Location field is empty.</font><br/>";
		
        //link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {    
        //updating the table
		$result = mysqli_query($mysqli, "UPDATE cells SET cell='$cell' WHERE id=$id" );

        //redirectig to the display page. In our case, it is index.php
		header("location: cells.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM cells WHERE id=$id");

while($res = mysqli_fetch_array($result))
{ 
	$cell=$res['cell'];   
}
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
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href = "home.php"><img id = "logo" src = "node.png"></a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="home.php">HOME</a></li>
						<li><a href="clients.php">CLIENTS</a></li>
						<li class="active"><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
						<li><a href="#">ACCESS POINT<span class="sr-only">(current)</span></a></li>
						<li><a href="#">RADIO TYPE<span class="sr-only">(current)</span></a></li>
						<li><a href="#">BACKBONE<span class="sr-only">(current)</span></a></li>
					</ul>
					<button class="btn navbar-nav navbar-right">
						<a href="logout.php" class="btn btn-warning">Logout</a>
					</button>

				</div> 
			</div>
		</nav>
	</header>
	<br>
	<br>
	<br>
	<br>
	<div class = "container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-success">
				<div class="panel panel-heading text-center">
					UPDATE CELL NAME
				</div>
				<div class="panel panel-body">
					<form action="edit1.php" method="post">
						<div class = "form-group">
							<div class="row">
								<div class="col-md-6">

									<label>Cell name</label>
									<input type="text" class="form-control" name="cell" value="<?php echo $cell;?>"><br>

								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>

							<input type="submit" class = "btn btn-info btn-lg pull-right" name="update" value="update">

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