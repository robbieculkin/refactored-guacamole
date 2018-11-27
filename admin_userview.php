<?php
		  //Begin session
		  session_start();

		  //Check if logged in
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
								<h1>Admin User Metadata View</h1>
						<a href=\"admin.php\">Listings</a>
						<br>
						<a href=\"admin_userview.php\">User Metadata</a>
					 </div>
		  </div>
";


					 //display user information in cards
					 $ids = get_user_ids();
					 
					 foreach($ids['ID'] as $id){
								echo "<div id=\"busn\" class=\"card w-75 mx-auto\">";
								$user = get_user($id);
								echo "<div class=\"card-body\">";
								echo "<h3 class=\"card-title\">".$user['NAME'][0]."</h3>";
								echo "<p class=\"card-text\">".$user['GRAD_YEAR'][0]."</p>";
								echo "<p class=\"card-text\">".$user['MAJOR'][0]."</p>";
								echo "<p class=\"card-text\">".$user['REASON'][0];
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
