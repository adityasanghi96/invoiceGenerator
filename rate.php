<?php 
$con = mysqli_connect('127.0.0.1','root','');  
if(!$con)  
{  
    echo 'not connect to the server';  
}  
if(!mysqli_select_db($con,'invoice'))  
{  
    echo 'database not selected';  
}
  
$sql    = 'SELECT rate FROM gst where id=0';
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$sql2    = 'SELECT name,address FROM company where id=0';
$result2 = mysqli_query($con,$sql2);
$comp = mysqli_fetch_row($result2);
?>
				
				
<!DOCTYPE html>  
<html>  
    <head>  
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.1.1.js"></script>
        <title>  
            Rate of interest
        </title>  
      
</head>  
<body>  
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				 aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Invoice</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li class="active">
						<a href="rate.php">Change Rate
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li>
						<a href="Companyname.php">Change Company Name</a>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" cla ss="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Login</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	
	<div class="well">
		<div id="data3" class="container">
			<h3><?php echo $comp[0]?> </h3>
			<?php echo $comp[1]?>
		</div>
	</div>
	
	<div class="container" id="data2">
    <form action="setRate.php" method="post">  
            <fieldset>  
                <legend>Enter the details below</legend>  
                <label><h4>Rate</h4></label><br><br>  
                <input type="float" placeholder="<?php echo $row[0] ?>" name="Rate">  
                <br><br>  
					
				<input type="submit" class="btn btn-default" value="Update">  
            </fieldset>  
        </form>  
	</div>
    </body>  
</html>  