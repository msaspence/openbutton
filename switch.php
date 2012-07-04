<?php
include("includes/db_functions.php");
db_connect();

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<link rel="stylesheet" type="text/css" href="main.css" />
	
	<title>Fruitworks Coworking Status Switch</title>
</head>
<body>
	<div id="container">
		<?php include("includes/status_switch.php"); ?>
	</div>
</body>
</html>