<!DOCTYPE html>
<html lang="en">
<head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>Alumni Business Directory</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>
		  <!--Navigation-->
		  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
					 <ul class="navbar-nav">
								<li class="nav-item active">
										  <b><a class="nav-link disabled" href="home.php">Alumni Business Directory</a></b>
								</li>
								<li class="nav-item">
										  <a class="nav-link" href="new.php">New Submission</a>
								</li>
								<li class="nav-item">
										  <a class="nav-link" href="login.php">Admin</a>
								</li>
					 </ul>
		  </nav>

		  <!--Content-->
		  <div class="container">
					 <div class="jumbotron" style="text-align:center">
								<h1>Business Listings</h1>
								<!--
								<input class="form-control" type="text" placeholder="Search" aria-label="Search">
								-->
								<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">Business Type</label>
													 <select name="type" class="form-control" id="busType">
																<option <?php if (isset($_POST['type']) && $_POST['type']=="ANY"){echo "selected=true";}?>>ANY</option>
																<option <?php if (isset($_POST['type']) && $_POST['type']=="Restaurant"){echo "selected=true";}?>>Restaurant</option>
																<option <?php if (isset($_POST['type']) && $_POST['type']=="Bar"){echo "selected=true";}?>>Bar</option>
																<option <?php if (isset($_POST['type']) && $_POST['type']=="Technology"){echo "selected=true";}?>>Technology</option>
																<option <?php if (isset($_POST['type']) && $_POST['type']=="Health"){echo "selected=true";}?>>Health</option>
													 </select>
										  </div>
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">ZIP Code</label>
													 <input name="zip" type="text" class="form-control" id="busZip" value="<?php if (isset($_POST['zip'])){echo $_POST['zip'];}else{echo "ANY";}?>">
										  </div>
										  <div class="form-group text-center">
													 <button name="submit" type="submit" class="btn btn-primary">Filter</button>
										  </div>
								</form>
					 </div>
		  </div>
		  <?php
					 include 'sql_interface.php';

					 if ($_SERVER["REQUEST_METHOD"]=="POST"){
								if (isset($_POST["submit"])){
										  $ids = get_ids(1, $_POST['zip'], $_POST['type']);
								}
					 } else{
								$ids = get_ids(1, 'ANY', 'ANY');
					 }
					 
					 foreach($ids['ID'] as $id){
								echo "<div id=\"busn\" class=\"card w-75 mx-auto\">";
								$listing = get_listing($id);
								echo "<div class=\"card-body\">";
								echo "<h3 class=\"card-title\">".$listing['NAME'][0]."</h3>";
								echo "<p class=\"card-text\">".$listing['DESCRIPTION'][0]."</p>";
								echo "<p class=\"card-text\">".$listing['TYPE'][0]."</p>";
								echo "<p class=\"card-text\">".$listing['ADDRESS'][0].", ";
								echo $listing['COUNTRY'][0].", ";
								echo $listing['STATE'][0].", ";
								echo $listing['ZIP'][0]."</p>";
								echo "</div>";
								echo "</div>";
								echo "<br>";
					 }
		  ?>

</body>
</html>
