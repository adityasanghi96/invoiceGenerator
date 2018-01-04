<?php 
include 'connection.php';  
$sql    = 'SELECT rate FROM gst where id=0';
$result = mysqli_query($con,$sql);
$roi = mysqli_fetch_row($result);

$sql2    = 'SELECT name,address FROM company where id=0';
$result2 = mysqli_query($con,$sql2);
$comp = mysqli_fetch_row($result2);
?>
<html>

<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style type="text/css" media="print">
	@page
	{
		size: landscape;
	};
	
	</style>
	<script src="js/jquery-3.1.1.js"></script>
	<script>
		let subtotal;

		$(document).ready(() => {
			subtotal = 0.00;
			document.getElementById("dt").value ="<?php echo date("Y-m-d")?>";
		});


		let abc = () => {
			let item = document.getElementById("item").value;
			let desc = document.getElementById("desc").value;
			let rate = document.getElementById("rate").value;
			let qty = document.getElementById("qty").value;
			let tot = rate * qty;
			let gstr = <?php echo $roi[0]?>;
			let gst = tot * gstr / 100;
			gst = Math.round(gst * 100) / 100;
			let total = tot + gst;
			total = Math.round(total * 100) / 100;
			subtotal = subtotal + total;
			subtotal = Math.round(subtotal * 100) / 100;
			document.getElementById('total2').value = subtotal;
			let amtpaid = document.getElementById('amtpaid').value;
			let total3 = document.getElementById('total2').value;
			total3 = Math.round(total3 * 100) / 100;
			document.getElementById('balance').value = total3 - amtpaid;
			let a = document.createElement("tr");
			let b = document.createElement("td");
			b.setAttribute('class', 'col-md-1');
			let c = document.createTextNode(item);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'col-md-1');
			c = document.createTextNode(desc);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'text-center');
			c = document.createTextNode(rate);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'text-center');
			c = document.createTextNode(qty);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'text-center');
			c = document.createTextNode(tot);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'text-center');
			c = document.createTextNode(gst);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'text-center');
			c = document.createTextNode(total);
			b.appendChild(c);
			a.appendChild(b);

			b = document.createElement("td");
			b.setAttribute('class', 'text-center');
			
			let del_button = document.createElement("button");
			del_button.setAttribute('class', 'btn btn-default');
			del_button.innerHTML = "Del";
			del_button.addEventListener("click", function () {
				var p = del_button.parentNode.parentNode;
				p.parentNode.removeChild(p);
				subtotal = subtotal - total;
				subtotal = Math.round(subtotal * 100) / 100;
				document.getElementById('total2').value = subtotal;
				amtpaid = document.getElementById('amtpaid').value;
				total3 = document.getElementById('total2').value;
				let totalz = total3 - amtpaid;
				totalz = Math.round(totalz * 100) / 100;
				document.getElementById('balance').value = totalz;

			});
			b.appendChild(del_button);
			a.appendChild(b);


			let z = document.getElementById("tbody");
			z.appendChild(a);

			let frm = document.getElementsByName('form1')[0];
			frm.reset();
		};

		$(document).on('click', '#print', () => {
			document.getElementById('data2').style.display = 'none';
			document.getElementById('print').style.display = 'none';
			document.getElementById('data3').setAttribute('class', 'none');
			document.getElementById('data4').setAttribute('class', 'none');

			var tbl = document.getElementById("tbody");
			if (tbl != null) 
			{					
			for (var i = 0; i < tbl.rows.length; i++) 
			    tbl.rows[i].cells[7].style.display = "none";
			}
			
			window.print();
			
			document.getElementById('data2').style.display = 'block';
			document.getElementById('print').style.display = 'block';
			document.getElementById('data3').setAttribute('class', 'container');
			document.getElementById('data4').setAttribute('class', 'container');
			if (tbl != null) 
			{					
			for (var i = 0; i < tbl.rows.length; i++) 
			    tbl.rows[i].cells[7].style.display = "block";
			}
		});

		$(document).on('blur', '#amtpaid', () => {
			let amtpaid = document.getElementById('amtpaid').value;
			let total3 = document.getElementById('total2').value;
			let totalz = total3 - amtpaid;
			totalz = Math.round(totalz * 100) / 100;
			document.getElementById('balance').value = totalz;
		});

	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
					<li class="active">
						<a href="index.php">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li>
						<a href="rate.php">Change Rate</a>
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

	<div class="container" id="data4">
			<div class="col-md-3 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">Invoice</div>
					<div class="panel-body">
						<form>
							<div class="form-group">
								<label for="invoice">Invoice #:</label>
								<input type="number" class="form-control" id="invoice">
							</div>
							<div class="form-group">
								<label for="dt">Date:</label>
								<input type="date" class="form-control" id="dt">
							</div>
							
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-body">
						<form>
							<div class="form-group">
								<label for="total2">Total amt: Rs.</label>
								<input type="number" class="form-control" id="total2" disabled>
							</div>
							<div class="form-group">
								<label for="amtpaid">Amount paid: Rs.</label>
								<input type="number" class="form-control" id="amtpaid">
							</div>
							<div class="form-group">
								<label for="balance">Balance Due: Rs.</label>
								<input type="number" class="form-control" id="balance" disabled>
							</div>
						</form>
					</div>
				</div>

			</div>
			<div class="col-md-9 col-sm-8">
				<div id="data2">
				<form class="form-inline" name="form1" id="form1">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="item">Item:</label>
								<input type="text" class="form-control" id="item" name="item" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="desc">Description:</label>
								<input type="text" class="form-control" id="desc" name="desc" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="rate">Rate: (in Rs.)</label>
								<input type="number" class="form-control" id="rate" name="rate" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="qty">Quantity:</label>
								<input type="number" class="form-control" id="qty" name="qty" required>
							</div>
						</div>
					</div>
					<div class="row">
						<br>
					</div>
					<div class="row">
						<center>
							<input class="btn btn-default" type="submit" value="Submit" id="submit">
						</center>
					</div>
				</form>
				</div>

				<div>
					<table id="table" class="table table-bordered">
						<thead>
							<th class="text-center">Item:</th>
							<th class="text-center">Description:</th>
							<th class="text-center">Rate: <br>(in Rs.)</th>
							<th class="text-center">Quantity:</th>
							<th class="text-center">Price: <br>(in Rs.)</th>
							<th class="text-center">GST: {<?php echo $roi[0]?>%}<br>(in Rs.) </th>
							<th class="text-center">Total+GST: <br>(in Rs.)</th>
						</thead>

						<tbody id="tbody">
						</tbody>
					</table>
					
					<div class="row">
						<center>
							<button class="btn btn-default" id="print">Print</button>
						</center>
					</div>
				</div>
			</div>

	</div>

	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script>
		$("#form1").validate(
			{
				rules: {
					// no quoting necessary
					item: "required",
					desc: "required",
					rate: "required",
					qty: "required",
					// quoting necessary!
				},
				messages: {
					item: "Item required",
					desc: "Description Required",
					rate: "Rate required",
					qty: "Quantity required",
				},
				success: "valid",
				submitHandler: function() { abc(); }
				
			}
		);
	</script>
</body>

</html>