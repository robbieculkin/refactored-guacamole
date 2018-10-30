<!DOCTYPE html>
<html lang="en">
<head>
		  <meta charset="utf-8"/>
		  <title>Alumni Business Directory</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
		  <?php
					 include 'sql_interface.php';

					 //insert_listing(id, $_POST["name"], $_POST["description"]...);
		  ?>

		  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
		  <ul class="navbar-nav">
					 <li class="nav-item">
								<b><a class="nav-link" href="home.php">Alumni Business Directory</a></b>
					 </li>
					 <li class="nav-item active">
								<a class="nav-link disabled" href="new.php">New Submission</a>
					 </li>
					 <li class="nav-item">
								<a class="nav-link" href="admin.php">Admin</a>
					 </li>
		  </ul>
		  </nav>

		  <div class="container">
					 <div class="jumbotron text-center">
								<h1>New Listing</h1>
					 </div>
		  </div>


		  <!--input form-->

		  <form action="<?php echo $_SERVER[PHP_SELF];?>" method="post">
					 <div class="form-group w-75 mx-auto">
								<label class="text-center" for="busName">Business Name</label>
								<input name="name" type="text" class="form-control" id="busName">
					 </div>
					 <div class="form-group w-75 mx-auto">
								<label class="text-center" for="busDesc">Business Description</label>
								<input name="description" type="text" class="form-control" id="busDesc">
					 </div>
					 <!---->
					 <div class="form-group w-75 mx-auto">
								<label class="text-center" for="busType">Business Type</label>
								<select name="type" class="form-control" id="busType">
										  <option>Restaurant</option>
										  <option>Retail</option>
										  <option>Bar</option>
										  <option>Technology</option>
										  <option>Health</option>
								</select>
					 </div>
					 <div class="form-group w-75 mx-auto">
								<label class="text-center" for="busAddr">Address</label>
								<input name="address" type="text" class="form-control" id="busAddr">
					 </div>
					 <div	class="form-group w-75 mx-auto">
								<label for="busCountry">Country</label>
								<select name="country" class="form-control" id="busCountry">
										  <option>USA</option>
										  <option>Canada</option>
										  <option>Australia</option>
								</select>
					 </div>
					 <div	class="form-group w-75 mx-auto">
								<label for="busState">State</label>
								<select name="state" class="form-control" id="busCountry">
										  <option>N/A</option>
										  <option>California</option>
										  <option>Washington</option>
								</select>
					 </div>
					 <!--if ZIP is empty should return ANY-->
					 <div class="form-group w-75 mx-auto">
								<label class="text-center" for="busZip">ZIP Code</label>
								<input name="zip" type="text" class="form-control" id="busZip">
					 </div>
					 <div class="form-group text-center">
								<button type="submit" class="btn btn-primary">Submit</button>
					 </div>
		  </form>

</body>
</html>
