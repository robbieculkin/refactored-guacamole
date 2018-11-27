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

			  <!--User data button-->
			  <div>
						 <button name="userbtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#userData">Tell us about yourself!</button>
			  </div>
		  </nav>

		  <!--Modal for user data-->
		  <div class="modal fade" id="userData" tabindex="-1" role="dialog" aria-labelledby="userDataLabel" aria-hidden="true">
					 <div class="modal-dialog" role="document">
								<div class="modal-content">
										  <div class="modal-header">
													 <h5 class="modal-title" id="exampleModalLabel">Tell us about yourself!</h5>
										  </div>
										  <div class="modal-body">
													 <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
																<div class="form-group">
																		  <label for="userName" class="col-form-label">Name (First Last):</label>
																		  <input name="name" type="text" class="form-control" id="userName" value="none">
																</div>
																<div class="form-group">
																		  <label for="gradYear" class="col-form-label">Graduation Year:</label>
																		  <input name="year" type="text" class="form-control" id="gradYear" value="none">
																</div>
																<div class="form-group">
																		  <label for="major" class="col-form-label">Major:</label>
																		  <input name="major" type="text" class="form-control" id="major" value="none">
																</div>
																<div class="form-group">
																		  <label for="reason" class="col-form-label">Why are you here?</label>
																		  <input name="reason" type="text" class="form-control" id="reason" value="none">
																</div>
																<div class="form-group text-center">
																		  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
																		  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																</div>
													 </form>
										  </div>
								</div>
					 </div>
		  </div>


		  <!--Content-->
		  <div class="container">
					 <div class="jumbotron" style="text-align:center">
								<h1>Business Listings</h1>
								<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">Business Name</label>
													 <input name="busname" type="text" class="form-control" id="busName" value="<?php if (isset($_POST['busname'])){echo $_POST['busname'];}else{echo "ANY";}?>">
										  </div>
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
													 <label class="text-center" for="busType">Description (Full phrase)</label>
													 <input name="desc" type="text" class="form-control" id="busDesc" value="<?php if (isset($_POST['desc'])){echo $_POST['desc'];}else{echo "ANY";}?>">
										  </div>
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">Address</label>
													 <input name="addr" type="text" class="form-control" id="busAddr" value="<?php if (isset($_POST['addr'])){echo $_POST['addr'];}else{echo "ANY";}?>">
										  </div>
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">Country</label>
													 <select name="country" class="form-control" id="busCountry">
																<option <?php if (isset($_POST['country']) && $_POST['country']=="ANY"){echo "selected=true";}?>>ANY</option>
																<option <?php if (isset($_POST['country']) && $_POST['country']=="USA"){echo "selected=true";}?>>USA</option>
																<option <?php if (isset($_POST['country']) && $_POST['country']=="Canada"){echo "selected=true";}?>>Canada</option>
																<option <?php if (isset($_POST['country']) && $_POST['country']=="Australia"){echo "selected=true";}?>>Australia</option>
													 </select>
										  </div>
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">State</label>
													 <select name="state" class="form-control" id="busState">
																<option <?php if (isset($_POST['state']) && $_POST['state']=="ANY"){echo "selected=true";}?>>ANY</option>
																<option <?php if (isset($_POST['state']) && $_POST['state']=="N/A"){echo "selected=true";}?>>N/A</option>
																<option <?php if (isset($_POST['state']) && $_POST['state']=="California"){echo "selected=true";}?>>California</option>
																<option <?php if (isset($_POST['state']) && $_POST['state']=="Washington"){echo "selected=true";}?>>Washington</option>
													 </select>
										  </div>
										  <div class="form-group w-25 mx-auto">
													 <label class="text-center" for="busType">ZIP Code</label>
													 <input name="zip" type="text" class="form-control" id="busZip" value="<?php if (isset($_POST['zip'])){echo $_POST['zip'];}else{echo "ANY";}?>">
										  </div>
										  <div class="form-group text-center">
													 <button name="searchsubmit" type="submit" class="btn btn-primary">Filter</button>
										  </div>
								</form>
					 </div>
		  </div>
		  <?php
					 include 'sql_interface.php';

					 //Display the business information in cards
					 if ($_SERVER["REQUEST_METHOD"]=="POST"){
								if (isset($_POST['searchsubmit'])){
										  		$ids = get_ids(1, $_POST['busname'], $_POST['desc'], $_POST['type'], $_POST['addr'], $_POST['country'], $_POST['state'], $_POST['zip'], 'ANY', 'ANY', 'ANY');
								} else{
										  		$ids = get_ids(1);
													insert_user(new_user_id(), $_POST['name'], $_POST['year'], $_POST['major'], $_POST['reason']);
					 			}
					 }else{
								$ids = get_ids(1);
					 }
					 
					 foreach($ids['ID'] as $id){
								echo "<div id=\"busn\" class=\"card w-75 mx-auto\">";
								$listing = get_listing($id, 1);
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
