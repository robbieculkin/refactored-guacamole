<?php
		  session_start();

		  if(!isset($_SESSION['valid'])){
					 header("Location:home.php");
					 exit;
		  }else{
					 include 'sql_interface.php';
echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
		  <meta charset=\"utf-8\">
		  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
		  <title>Alumni Business Directory</title>
		  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\">
		  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
		  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\"></script>
		  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\"></script>

</head>
<body>
		  <!--Navigation-->
		  <nav class=\"navbar navbar-expand-sm bg-dark navbar-dark sticky-top\">
					 <ul class=\"navbar-nav\">
								<li class=\"nav-item active\">
										  <b><a class=\"nav-link disabled\" href=\"home.php\">Alumni Business Directory</a></b>
								</li>
								<li class=\"nav-item\">
										  <a class=\"nav-link\" href=\"new.php\">New Submission</a>
								</li>
								<li class=\"nav-item\">
										  <a class=\"nav-link\" href=\"logout.php\">Logout</a>
								</li>
					 </ul>
		  </nav>

		  <!--Content-->
		  <div class=\"container\">
					 <div class=\"jumbotron\" style=\"text-align:center\">
								<h1>Admin Listing Verification</h1>
					 </div>
		  </div>
";

					 //include 'sql_interface.php';

					 if ($_SERVER["REQUEST_METHOD"]=="POST"){
								if (isset($_POST['approve'])){
										  approve_listing((int)$_POST['approve']);
								}
								if (isset($_POST['delete'])){
										  delete_listing((int)$_POST['delete']);
								}
					 }

					 $ids = get_ids(0, 'ANY', 'ANY');
					 
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
								echo "<p class=\"card-text\">".$listing['ALUM_NAME'][0]."</p>";
								echo "<p class=\"card-text\">".$listing['GRAD_YEAR'][0]."</p>";
								echo "<p class=\"card-text\">".$listing['MAJOR'][0]."</p>";
								echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\"";
								echo '<div class="form-group text-center"><button name="approve" value="'.$id.'" type="submit" class="btn btn-primary">Approve</button></div>';
								echo '<div class="form-group text-center"><button name="delete" value="'.$id.'" type="submit" class="btn btn-primary">Delete</button></div>';
								echo "</form>";
								echo "</div>";
								echo "</div>";
								echo "<br>";						
					 }

echo "
</body>
</html>
";
}
?>
