<?php
		  //Begin session
		  session_start();
		  include 'sql_interface.php';
		  
		
		  //Check login and store session variables
		  $username = "admin";
		  $password = get_pw()["PW"][0];
					 if (isset($_POST['user']) && isset($_POST['pass'])){
								if (($_POST['user'] == $username) && hash("md5", $_POST['pass']) == $password){
										  $_SESSION['valid'] = true;
										  $_SESSION['timeout'] = time();
										  $_SESSION['username'] = $username;
										  header("Location:admin.php");
										  exit;
								} else{
										  echo "<div class=\"alert alert-warning w-75 mx-auto\"><strong>Login failed. Please try again.</strong></div>";
								}
					 }
?>
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
		  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
					 <ul class="navbar-nav">
								<li class="nav-item">
										  <b><a class="nav-link" href="home.php">Alumni Business Directory</a></b>
								</li>
								<li class="nav-item">
										  <a class="nav-link" href="new.php">New Submission</a>
								</li>
								<li class="nav-item active">
										  <a class="nav-link disabled" href="login.php">Admin</a>
								</li>
					 </ul>
		  </nav>

		  <div class="container">
					 <div class="jumbotron text-center">
								<h1>Admin Login</h1>
					 </div>
		  </div>

		  <!--Login form-->
		  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
					 <div class="form-group w-25 mx-auto">
								<label for="username">Username</label>
								<input name="user" type="text" class="form-control" required>
					 </div>
					 <div class="form-group w-25 mx-auto">
								<label for="password">Password</label>
								<input name="pass" type="password" class="form-control" required>
					 </div>
					 <div class="form-group text-center">
								<button type="submit" class="btn btn-primary">Login</button>
					 </div>
		  </form>
</body>
</html>
