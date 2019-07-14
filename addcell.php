<?php  
include_once("config.php");
include('session.php');
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
						<li class="active"><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
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
	<?php
	if(isset($_POST['Submit'])) { 
		$cellname = $_POST['cell'];
  // echo "string";

		mysqli_query($mysqli,"INSERT INTO cells (cell) VALUES('$cellname')");
		echo  '<div class="alert alert-success col-md-6 col-md-offset-3 text-center" role="alert ">Cell has been added succefully</div>';
	}
	?>
	<div class = "container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel panel-heading text-center">
					ADD NEW CELL
				</div>
				<div class="panel panel-body">
					<form action="addcell.php" method="post">
						<div class = "form-group">
							<div class="row">
								<div class="col-md-6">

									<label>Cell name</label>
									<input type="text" class="form-control" name="cell" placeholder="cell name">
								</div>
								<div class="form-footer">
									<input type="submit" class="btn btn-primary pull-right" name="Submit" value="ADD">
								</div>
							</form>
						</div>


						<!-- <button type="submit" class="btn btn-default" name="Submit">ADD</button> -->
						<nav class="navbar navbar-default navbar-fixed-bottom navbar-center">
							<h5 class="text-center">Noc Habari LTD</h5>
							<p class = "help-block text-center">All rights reserved &copy; <?php echo date("Y"); ?> Habari Node Ltd </p>
						</nav>
					</body>
					</html>