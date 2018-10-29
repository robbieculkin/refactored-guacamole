<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
	include 'sql_interface.php';
	$r = get_ids(1);	

	echo '<p>';
	echo var_dump($r);
	echo '</p>';
 ?> 
 </body>
</html>

