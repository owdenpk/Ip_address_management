<?php
include ("session.php");
include_once("config.php");

?>
<?php
if(isset($_POST['search'])){
   // header("Location:add.php");
	$valueToSearch = $_POST['valueToSearch'];
	echo $valueToSearch;
	$result = mysqli_query($mysqli, "SELECT * FROM backbone JOIN cells ON backbone.cell_location=cells.id JOIN type_of_radio ON backbone.cell_location=type_of_radio.cell_id WHERE backbone.link_name like'%".$valueToSearch."%' OR cells.cell like '%".$valueToSearch."%' OR backbone.cell_location like '%".$valueToSearch."%' OR backbone.ip like '%".$valueToSearch."%' OR backbone.ssid like '%".$valueToSearch."%' OR type_of_radio.radio like '%".$valueToSearch."%'");
}
else{
	$result = mysqli_query($mysqli, 'SELECT backbone.id,backbone.link_name,backbone.ip,backbone.ssid,type_of_radio.radio,type_of_radio.id, cells.cell FROM backbone JOIN cells ON backbone.cell_location=cells.id JOIN type_of_radio ON backbone.radio_type=type_of_radio.id  ORDER BY backbone.id DESC');
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Backbone</title>

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
						<li><a href="home.php">HOME<span class="sr-only">(current)</span></a></li>
						<li><a href="clients.php">CLIENTS<span class="sr-only">(current)</span></a></li>
						<li><a href="cells.php">CELLS<span class="sr-only">(current)</span></a></li>
						<li><a href="access_point.php">ACCESS POINT<span class="sr-only">(current)</span></a></li>
						<li><a href="radio_type.php">RADIO TYPE<span class="sr-only">(current)</span></a></li>
						<li class="active"><a href="backbone.php">BACKBONE<span class="sr-only">(current)</span></a></li>

					</ul>

					<button class="btn navbar-nav navbar-right">
						<a href="logout.php" class="btn btn-warning">Logout</a>
					</button>

					<form class="navbar-form navbar-right" action="backbone.php" method="post">
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
		<div class="align-center">
			<a class="btn btn-primary hidden-print" href="backbone_add.php">Add New Backbone</a><hr>
		</div>
		<table class = "table table-striped table-hover table-bordered">
			<h2 class="text text-center" >BACKBONE LIST</h2>
			<tr>
				<th>Link name</th>
				<th>Cell location</th>
				<th>IP address</th>
				<th>SSID</th>
				<th>Radio Type</th>
				<th class="hidden-print">Actions</th>
			</tr>


			<?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
			while($res = mysqli_fetch_array($result)) {         
				echo "<tr>";
				echo "<td>".$res['link_name']."</td>";
				echo "<td>".$res['cell']."</td>";
				echo "<td>".$res['ip']."</td>";
				echo "<td>".$res['ssid']."</td>";
				echo "<td>".$res['radio']."</td>";
				echo "<td class='hidden-print'><a href=\"backbone_edit.php?id=$res[id]\">Edit</a> | <a href=\"backbone_delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";       
			}
			?>


		</table>
	</div>
	<br>
	<br>
	<br>
	<nav class="navbar navbar-default navbar-fixed-bottom navbar-center">
		<h5 class="text-center">Noc Habari LTD</h5>
		<p class = "help-block text-center">All rights reserved &copy; <?php echo date("Y"); ?> Habari Node Ltd </p>
	</nav>
</body>
</html>