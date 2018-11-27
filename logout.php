<?php
		  //start the session
		  session_start();

		  //destroy the session
		  session_destroy();

		  //send user back to home
		  header("Location:home.php");
		  exit;
?>
