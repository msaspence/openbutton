<?php
include("includes/db_functions.php");
db_connect();

if (isset($_GET["name"]) && isset($_GET["active"]))
{
	$name = mysql_real_escape_string($_GET["name"]);
	$active = mysql_real_escape_string($_GET["active"]);
	
	update_status($name, $active)
}

if 
?>